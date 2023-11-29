<?php

namespace App\Livewire;

use App\Traits\DispatchesValidation;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Attributes\Rule;
use Livewire\Component;

class InputComponentWithAlpine extends Component
{
    public $message;
    #[Rule('required|numeric|min:4')]
    public $age;

    public function save()
    {
        // Reset the message
        $this->message = null;

        $this->validate();

        // Report back to the user
        $this->message = "You are {$this->age} years old!";
    }

    public function render()
    {
        return view('livewire.input-component-with-alpine');
    }
}
