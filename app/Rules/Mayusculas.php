<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Mayusculas implements Rule
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
        #Retorna true si el valor está en mayúsculas
        return $value == strtoupper($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        # Mensaje en caso de que no pase
        return 'El campo :ttributte debe estar en mayusculas.';
    }
}
