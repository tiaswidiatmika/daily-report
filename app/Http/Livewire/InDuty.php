<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;
use App\Models\Position;
use App\Models\{User, Formation};
use App\Http\Controllers\ReportController;

class InDuty extends Component
{
    public $users;
    public $input;
    public $textFields;
    public $searchResult;
    public $formation;
    public $formationHasBeenSet = false;
    public $haveBeenSelected = [];
    public $todaysReport;
    const STATIC_POSITIONS = ['spv', 'asisten_spv', 'honorer'];
    public function mount()
    {
        $this->users = User::all();
        $this->textFields = $this->setTextFieldIds(); // contains text input value
        $this->searchResult = $this->setTextFieldIds(); // contains result of found user aliases
        $this->formationHasBeenSet = $this->hasFormationBeenSet();
        if ( $this->formationHasBeenSet ) {
            $report = ReportController::getReport();
            $this->todaysReport = $report;
            $this->lastFormation( $report->id );
        } else {
            $this->formation = $this->setTextFieldIds()->toArray();
            $this->setUsersInStaticPosition();
        }
    }
    public function setTextFieldIds()
    {
        $textFields = Position::get('id')->mapWithKeys(
            function($item) {
                return [ $item['id'] => [] ];
            }
        );
        return $textFields;
    }

    public function setUsersInStaticPosition()
    {
        collect( self::STATIC_POSITIONS )->map(
            function ( $posName ) {
                return $this->formation[
                    Position::where('name', $posName)
                    ->first()->id] = User::ofRole($posName)->pluck('alias');
            }
        );
    }
    
    public function render()
    {
        // check for today's report availability
        // dd($this->formation);        
        return view('livewire.in-duty');
    }

    public function hasFormationBeenSet()
    {
        // if there are report
        $report = ReportController::getReport();
        // $currentFormationIsExist = Formation::where('report_id', $report->id)->get();
        if ( $report !== null ) {
            $checkLastFormation = Formation::where('report_id', $report->id)->get();
            if ( $checkLastFormation->isNotEmpty() ) {
                // $this->lastFormation( $report->id );
                return true;
            }
        }
    }
    public function lastFormation( $reportId  )
    {
        // else, get today's formation
        $currentFormation = Formation::where('report_id', $reportId)
            ->get()
            ->groupBy('position_id')
            ->toArray();
        
            foreach ($currentFormation as $positionId => $values) {
                foreach ($values as $key => $element) {
                    $currentFormation[$positionId][$key] = User::find($element['user_id'])->alias;
                }
            }
        
        ksort($currentFormation);
        $prepareFormation = $this->setTextFieldIds()->toArray();
        // store last formation to new formation, based on their key
        foreach ($prepareFormation as $formationKey => $formationValue) {
            foreach ($currentFormation as $currentFormationKey => $currentFormationValue) {
                if ($currentFormationKey === $formationKey) {
                    $prepareFormation[$currentFormationKey] = $currentFormationValue;
                    // e.g. $currentFormationValue = array:2 [▼ 0 => "Banawi", 1 => "Fitriani"]
                    foreach ($currentFormationValue as $alias) {
                        // push to has been selected
                        $this->haveBeenSelected[] = $alias;
                    }
                }
            }
        }
        $this->formation = $prepareFormation;
    }

    public function submit()
    {
        // check if there are any formation for today
        if ( $this->hasFormationBeenSet() ) {
            $this->destroyPreviousFormation();
        }

        // check last report build status
        // check for todays report availability, if not exist, create one
        $report = ReportController::firstOrCreate();
        // if there is formation for today delete the
        $arrangeFormation = $this->formation;
        foreach ($arrangeFormation as $key => $values) {
            foreach ($values as $value) {
                Formation::create([
                    'report_id' => $report->id,
                    'position_id' => $key,
                    'user_id' => User::where('alias', $value)->first()->id
                ]);
            }
        }
        
        session()->flash( 'formation-built', 'current formation has successfully been assembled' );  
        return redirect()->to('/');
    }

    public function destroyPreviousFormation()
    {
        $report = $this->todaysReport;
        $formationIds = Formation::where('report_id', $report->id)->get()->pluck('id');
        // e.g. $formationIds is a collection of [8,9,10,11]
        Formation::destroy( $formationIds );
    }

    public function search( $position )
    {
        if (empty($this->textFields[$position])) {
            $this->searchResult[$position] = [];
            return;
        }
        $builder = User::ofRole('exceptKaunit')->where('alias', 'like', "%{$this->textFields[$position]}%");
        $this->searchResult[$position] = $builder->take(10)
                ->whereNotIn('alias', $this->haveBeenSelected)
                ->get()
                ->pluck('alias');
    }

    public function select( $fieldId, $alias )
    {
        // push one new item on array to respective field name
        $this->formation[$fieldId][] = $alias;
        // clears input field, search result
        $this->textFields[$fieldId] = '';
        $this->searchResult[$fieldId] = '';

        // push new item to $this->haveBeenSelected to prevent duplicate entry
        array_push( $this->haveBeenSelected, $alias );
    }

    public function remove( $fieldName, $needle )
    {
        $hayStack = $this->formation[$fieldName];
        $this->formation[$fieldName] = array_diff( $hayStack, [$needle] );
        $this->haveBeenSelected = array_diff( $this->haveBeenSelected, [$needle] );
    }
    
    public function clearResults()
    {
        $this->textFields = $this->textFields->map(
            function( $item ) {
                $item = '';
            }
        );
    }
}