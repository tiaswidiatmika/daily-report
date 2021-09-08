<?php

namespace App\Http\Livewire;

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
        $this->textFields = $this->setTextFieldName(); // contains text input value
        $this->searchResult = $this->setTextFieldName(); // contains result of found user aliases
        $this->formation = $this->setTextFieldName()->toArray(); // contains selected aliases
    }
    public function setTextFieldName()
    {
        $textFields = Position::get('name')->mapWithKeys(
            function($item) {
                return [ $item['name'] => [] ];
            }
        );
        return $textFields;
    }
    
    public function render()
    {
        return view('livewire.in-duty');
    }

    public function submit()
    {
        
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

    public function select( $fieldName, $alias )
    {
        // push one new item on array to respective field name
        array_push( $this->formation[$fieldName], $alias );
        // clears input field, search result
        $this->textFields[$fieldName] = '';
        $this->searchResult[$fieldName] = '';

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