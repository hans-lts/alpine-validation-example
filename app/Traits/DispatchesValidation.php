<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;

trait DispatchesValidation
{
    public function validateOnly($field, $rules = null, $messages = [], $attributes = [])
    {
        $this->prepareValidatorCallback();
        parent::validateOnly($field, $rules, $messages, $attributes);
    }

    public function validate($rules = null, $messages = [], $attributes = []): void
    {
        $this->prepareValidatorCallback();
        parent::validate($rules, $messages, $attributes);
    }

    protected function prepareValidatorCallback()
    {
        $this->withValidator(function(Validator $data){
            $data->after(function(Validator $validator) {
                $this->dispatchBrowserEvent('validation-error', $validator->errors());
            });
        });
    }
}
