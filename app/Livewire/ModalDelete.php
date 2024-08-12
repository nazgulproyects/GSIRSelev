<?php

namespace App\Livewire;

use Livewire\Component;

class ModalDelete extends Component
{
    public $mostrarModal = false;

    public function abrirModal()
    {
        $this->mostrarModal = true;
    }


    public function render()
    {
        return view('mylivewire.modal-delete');
    }
}
