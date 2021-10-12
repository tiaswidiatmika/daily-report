<?php

namespace App\Http\Livewire\Shift;

use App\Models\Shift as ModelShift;
use Livewire\Component;

class Index extends Component
{
    public $shifts;
    protected $listeners = [
        'refreshComponents' => '$refresh'
    ];
    public function mount()
    {
        $this->shifts = ModelShift::all();
    }
    public function render()
    {
        return view('livewire.shift.index');
    }
}
