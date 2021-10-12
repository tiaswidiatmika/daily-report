<?php

namespace App\Http\Livewire\Shift;

// use App\Http\Livewire\Traits\ModalHasAbilities;
use App\Models\Shift;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Http\Livewire\Traits\ModalHasAbilities;

class Edit extends Component
{
    use ModalHasAbilities;

    public $update;
    public $show = false;
    public Shift $shift;
    public $listeners = [
        'refresh' => '$refresh',
        'refreshComponents' => 'render'
    ];
    protected $rules = [
        'shift.name' => 'required',
        'shift.range' => 'required'
    ];

    public function submit()
    {
        $this->validate();
        $this->shift->save();
        return redirect('shift');
    }
    public function refreshComponent() {
        $this->update = !$this->update;
    }
    public function render()
    {
        return view('livewire.shift.edit');
    }
    
    
}
