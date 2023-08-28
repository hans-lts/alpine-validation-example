<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\DispatchesValidation;
use Livewire\Component;

class InputComponent extends Component
{
    public $message;
    public User $user;
    public $age;

    protected $rules = [
        'age' => 'numeric|required',
        'user.first_name' => 'string|required|max:255',
        'user.last_name' => 'string|required|max:255'
    ];

    public function save()
    {
        // Reset the message
        $this->message = null;

        $this->validate();

        // Report back to the user
        $this->message = "{$this->user->first_name} {$this->user->last_name} is {$this->age} years old!";
    }

    public function mount()
    {
        $this->user = new User();
    }

    public function render()
    {
        return view('livewire.input-component');
    }
}
