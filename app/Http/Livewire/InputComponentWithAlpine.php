<?php

namespace App\Http\Livewire;

use App\Traits\DispatchesValidation;
use Illuminate\Contracts\Validation\Validator;
use Livewire\Component;

class InputComponentWithAlpine extends Component
{
    public $message;
    public $age;

    protected $rules = [
        'age' => 'numeric|required'
    ];

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
