<?php
namespace App\Http\Livewire\Traits;

trait ModalHasAbilities
{
    public function open()
    {
        return $this->show = true;
    }

    public function dismiss()
    {
        return $this->show = false;
    }

}