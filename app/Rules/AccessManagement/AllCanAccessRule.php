<?php

namespace App\Rules\AccessManagement;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Support\Facades\Log;

class AllCanAccessRule implements ValidationRule, DataAwareRule
{
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->data['user'] != 0) {
            $fail("$attribute can't exist because user field is filled");
        }

        if ($this->data['department'] != 0) {
            $fail("$attribute can't exist because department field is filled");
        }

        if ($this->data['dlevel'] != 0) {
            $fail("$attribute can't exist because department level field is filled");
        }
    }

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}
