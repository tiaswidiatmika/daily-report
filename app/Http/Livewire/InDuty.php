<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Division, Formation, Position, Report, User};
use App\Http\Controllers\ReportController;

class InDuty extends Component
{
    public $report;
    public $users = [];
    public $textFields;
    public $searchResult;
    public $formation;
    public $formationHasBeenSet = false;
    public $haveBeenSelected = [];
    const STATIC_POSITIONS = ['spv', 'asisten_spv', 'honorer'];
    public function mount()
    {
        $this->retrieveUsersWithSameSubDivision(); // get users with same subdivision
        $this->textFields = $this->setTextFieldIds(); // contains text input value
        $this->searchResult = $this->setTextFieldIds(); // contains result of found user aliases
        $this->formationHasBeenSet = $this->hasFormationBeenSet();
        if ( $this->formationHasBeenSet ) {
            $this->report = ReportController::getReport();
            $this->lastFormation();
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
                $usersInThatPos = $teammates->filter( function( $user ) use ( $posName ) {
                    return $user->hasRole( $posName );
                } )->toArray();
                $posId = Position::where('name', $posName)->first()->id;
                $this->formation[$posId] = $usersInThatPos;
                $this->haveBeenSelected = array_merge($this->haveBeenSelected, $usersInThatPos) ;
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
        if ( $report !== null ) return $report->formations()->get()->isNotEmpty() ;
        return false;
    }
    public function lastFormation()
    {
        // else, get today's formation
        $formations = $this->report->formations()->get()->groupBy('position_id');
        // prepare formation
        $this->formation = $this->setTextFieldIds();

        $formations->each( function( $formationPerPosition, $positionId ) {
            $formationPerPosition->map( function( $formation ) use ( $positionId ) {
                $user = $formation->user()->first();
                $this->formation[$positionId] = array_merge( $this->formation[$positionId], [$user] );
                $this->haveBeenSelected = array_merge($this->haveBeenSelected, [$user]) ;
            } );
        });
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
        
        foreach ($this->formation as $positionId => $formationItems) {
            foreach ($formationItems as $user) {
                $report->formations()->create([
                    'position_id' => $positionId,
                    'user_id' => $user['id'],
                ]);
            }
        }
        
        session()->flash( 'formation-built', 'current formation has successfully been assembled' );  
        return redirect()->to('/');
    }

    public function destroyPreviousFormation()
    {
        $this->report->formations()->delete();
    }

    public function search( $position )
    {
        if (empty($this->textFields[$position])) {
            $this->searchResult[$position] = [];
            return;
        }

        $selectedUsersId = collect($this->haveBeenSelected)->groupBy('id')->keys()->toArray();
        // filter alias that contains text field's string value
        // stripos: if not found, it return false
        // if found, returns its position
        $result = $this->users
                    ->filter( function ($user) use ($position) {
                        return stripos($user->name, $this->textFields[$position]) !== false;
                    } )->take(5);
        $this->searchResult[$position] = rejectUsersInCollection( $result, 'id', $selectedUsersId );
        
    }

    public function select( $fieldId, $userId )
    {
        $user = User::find($userId);
        // push one new item on array to respective field name
        $this->formation[$fieldId][] = $user;
        // clears input field, search result
        $this->textFields[$fieldId] = '';
        $this->searchResult[$fieldId] = '';
        // push new item to $this->haveBeenSelected to prevent duplicate entry
        array_push( $this->haveBeenSelected, $user );
    }

    public function remove( $fieldName, $userId )
    {
        $hayStack = collect( $this->formation[$fieldName] );
        
        $this->formation[$fieldName] = rejectUsersInCollection( $hayStack, 'id', [$userId] );
        $this->haveBeenSelected = rejectUsersInCollection( collect($this->haveBeenSelected), 'id', [$userId] );
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