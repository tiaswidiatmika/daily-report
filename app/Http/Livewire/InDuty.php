<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;
use App\Models\Position;
use App\Models\{User, Formation};

class InDuty extends Component
{
    public $users;
    public $input;
    public $textFields;
    public $searchResult;
    public $formation;
    public $haveBeenSelected = [];

    public function mount()
    {
        $this->users = User::all();
        $this->textFields = $this->setTextFieldIds(); // contains text input value
        $this->searchResult = $this->setTextFieldIds(); // contains result of found user aliases
        if ( $this->checkIfThereAreLastFormation() ) {
            $report = Report::where('date', todayIs()->date)->first();
            $this->lastFormation( $report->id );
        } else {
            $this->formation = $this->setTextFieldIds()->toArray(); // contains selected aliases
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
    
    public function render()
    {
        // check for today's report availability

        
        return view('livewire.in-duty');
    }

    public function checkIfThereAreLastFormation()
    {
        // if there are report
        $report = Report::where('date', todayIs()->date)->first();
        // $currentFormationIsExist = Formation::where('report_id', $report->id)->get();
        if ( $report !== null ) {
            $checkLastFormation = Formation::where('report_id', $report->id)->get();
            if ( $checkLastFormation->isNotEmpty() ) {
                // $this->lastFormation( $report->id );
                return true;
            }
        }
    }
    public function lastFormation($reportId  )
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
        foreach ($prepareFormation as $formationKey => $formationValue) {
            foreach ($currentFormation as $currentFormationkey => $currentFormationvalue) {
                if ($currentFormationkey === $formationKey) {
                    $prepareFormation[$currentFormationkey] = $currentFormationvalue;
                }
            }
        }
        $this->formation = $prepareFormation;
    }

    public function submit()
    {
        // check for todays report availability, if not exist, create one
        $report = Report::firstOrCreate( ['date' => todayIs()->date] );
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
        // $currentFormation = Formation::where('report_id', $report->id)->get()->groupBy('position_id');
        // return redirect()->route('show-newly-created-formation', ['data' => json_encode( $currentFormation )]);
        // return redirect()->route('show-newly-created-formation')->with( compact('currentFormation') );
        session()->flash( 'formation-built', 'current formation has successfully been assembled' );  
        return redirect()->to('/');
    }

    public function search( $position )
    {
        if (empty($this->textFields[$position])) {
            $this->searchResult[$position] = [];
            return;
        }
        $builder = User::ofRole('staff')->where('alias', 'like', "%{$this->textFields[$position]}%");
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
    
}