<?php

namespace App\Rules\AccessManagement;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class DLevelRule implements ValidationRule, DataAwareRule
{
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            !array_key_exists('all-can-access', $this->data)
            && $this->data['user'] == 0
            && $this->data['department'] == 0
        ) {
            if ($value == 0) {
                $fail("$attribute can only be empty if user, department, and all can access is empty");
            }
        }

        if ($value != 0) {
            if (array_key_exists('all-can-access', $this->data)) {
                $fail("$attribute can't exist because all can access is toggled");
            }
    
            if ($this->data['user'] != 0) {
                $fail("$attribute can't exist because user field is filled");
            }
    
            if ($this->data['department'] != 0) {
                $fail("$attribute can't exist because department field is filled");
            }
        }
        
    }

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}
