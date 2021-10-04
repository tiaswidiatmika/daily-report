<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Division, Formation, Position, Report, User};
use App\Http\Controllers\ReportController;

class InDuty extends Component
{
    public $users = [];
    public $subDivision;
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
        $this->retrieveUsersWithSameSubDivision(); // get users with same subdivision
        $this->textFields = $this->setTextFieldIds(); // contains text input value
        $this->searchResult = $this->setTextFieldIds(); // contains result of found user aliases
        $this->formationHasBeenSet = $this->hasFormationBeenSet();
        if ( $this->formationHasBeenSet ) {
            $report = ReportController::getReport();
            $this->todaysReport = $report;
            $this->lastFormation( $report->id );
        } else {
            $this->formation = $this->setTextFieldIds();
            $this->setUsersInStaticPosition();
        }
    
    }

    public function retrieveUsersWithSameSubDivision()
    {
        $this->users = loggedUser()->exceptKaunit()->with('roles')->where('active', true)->get();
    }
    public function setTextFieldIds()
    {
        // ! items contains array, so it can be versatile
        // ! even though it contains  string
        return Position::get('id')->mapWithKeys(
            function($item) {
                return [ $item['id'] => [] ];
            }
        )->toArray();
    }

    public function setUsersInStaticPosition()
    {
        $teammates = $this->users;
        
        collect( self::STATIC_POSITIONS )->map(
            function ( $posName ) use ( $teammates) {
                $userInThatPos = $teammates->filter( function( $user ) use ( $posName ) {
                    return $user->hasRole( $posName );
                } )->pluck('alias')->toArray();
                $posId = Position::where('name', $posName)->first()->id;
                $this->formation[$posId] = $userInThatPos;
                $this->haveBeenSelected = array_merge($this->haveBeenSelected, $userInThatPos) ;
            }
        );
    }
    
    public function render()
    {
        return view('livewire.in-duty');
    }

    public function hasFormationBeenSet()
    {
        // if there are report
        $report = ReportController::getReport();

        if ( $report !== null ) {
            $checkLastFormation = Formation::where('report_id', $report->id)->get();
            if ( $checkLastFormation->isNotEmpty() ) {
                return true;
            }
        }
        return false;
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
        $prepareFormation = $this->setTextFieldIds();
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
        // filter alias that contains text field's string value
        // stripos: if not found, it return false
        // if found, returns its position
        $result = $this->users
                    ->filter( function ($user) use ($position) {
                        return stripos($user->name, $this->textFields[$position]) !== false;
                    } )
                    ->pluck('alias')
                    ->take(5)
                    ->toArray();
        $this->searchResult[$position] = array_diff($result, $this->haveBeenSelected); 
        
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
        $this->textFields = collect($this->textFields)->map(
            function( $item ) {
                $item = '';
            }
        )->toArray();
    }
}