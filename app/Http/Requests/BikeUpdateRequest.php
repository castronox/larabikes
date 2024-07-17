<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;


class BikeUpdateRequest extends BikeRequest
{
    /**
     * No redefiniré al método authorize(), ya me que me va bien el definido en la clase padre
     * 
     * 
     * 
     * 
    */


    public function authorize(){
        #Retorna true solamente si el usuario tiene permiso para actualizar
        return $this->user()->can('update', $this->bike);
    }

    protected function failedAuthorization(){
        throw new AuthorizationException('No puedes editar una moto que no es tuya');
    }
    /*
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
                
        # Si usamos el implicit binding, se mapea automáticamente una instancia 
        # del modelo a modo de propiedad de la request
        $id = $this->bike->id;

        # También se puede recuperar así : $id = $this->route('bike');
        # Retorna la regla de matrícula modificada y las reglas del padre.
        return [
            'matricula' => "required_if:matriculada,1|
            nullable|
            regex:/^\d{4}[B-Z]{3}$/i|
            unique:bikes,matricula,$id"
        ]+parent::rules();
}

}