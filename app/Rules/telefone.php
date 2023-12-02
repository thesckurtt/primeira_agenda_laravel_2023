<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Cliente;

class telefone implements Rule
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
        $regex = '/[(][0-9]{2}[)][\s][0-9]{5}[-][0-9]{4}/';
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
