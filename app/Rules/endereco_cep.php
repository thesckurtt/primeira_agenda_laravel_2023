<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class endereco_cep implements Rule
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
        $regex = '/[0-9]{5}[0-9]{3}/'; // Regex cep { 00000000 }
        if(!preg_match($regex, $value)){
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
