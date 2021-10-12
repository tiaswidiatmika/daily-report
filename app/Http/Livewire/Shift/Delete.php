<?php

namespace App\Http\Livewire\Shift;

use App\Models\Shift;
use Livewire\Component;
use App\Http\Livewire\Traits\ModalHasAbilities;

class Delete extends Component
{
    use ModalHasAbilities;

    public Shift $shift;
    public $show = false;

    protected $rules = [
        'shift.name' => 'required',
        'shift.range' => 'required'
    ];

    public function delete()
    {
        $this->shift->delete();
        return redirect('shift');
    }
    public function render()
    {
        return view('livewire.shift.delete');
    }
}
