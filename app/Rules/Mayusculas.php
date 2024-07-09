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
        return[

            'precio.numeric'=>'El precio debe ser un numero',
            'precio.min'=>'El precio debe ser mayor o igual a cero',
            'kms.numeric'=>'Los kilometros der 0 o más',
            'matricula.required_if'=>'La matrícula es obligatoria si la moto está matriculada',
            'matricula.unique'=>'Ya existe una moto con la misma matrícula.',
            'matricula.regex'=>'La matrícula debe contener 4 dígitos y 3 letras',
            'matricula.conmfirmed'=>'La confirmación de matrícula no coincide',
            'color.regex'=>'El color debe estar en formato RGB HEX comenzando por #',
            'imagen.image'=>'El fichero debe ser una imagen',
            'imagen.mimes'=>'La imagen debe ser de tipo jpg, png, gif o webp',            
        ];
    }
}
