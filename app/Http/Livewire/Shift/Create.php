<?php

namespace App\Http\Livewire\Shift;

use App\Models\Shift;
use Livewire\Component;
use App\Http\Livewire\Traits\ModalHasAbilities;

class Create extends Component
{
    use ModalHasAbilities;

    public $show = false;
    public $shift = [
        'name' => '',
        'range' => ''
    ];
    
    protected $rules = [
        'shift.name' => 'required',
        'shift.range' => 'required'
    ];

    public function submit()
    {
        $this->validate();
        Shift::create([
            'name' => $this->shift['name'],
            'range' => $this->shift['range'],
        ]);
        return redirect('shift');
    }
    public function render()
    {
        return view('livewire.shift.create');
    }
}
