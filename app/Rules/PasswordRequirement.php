<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordRequirement implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool)preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password must contain at least one uppercase letter, one lowercase letter and one number.';
    }
}
