<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'dni'     =>  'required|unique:customers,dni',
            'name'    =>  'required',
            'surname' =>  'required',
            'email'   =>  'required|unique:customers,email',
            'phone'   =>  'required',
            'address' =>  'required',
        ];

        return $rules;
    }
    public function attributes()
    {
        return [
            'dni'      =>  'DNI',
            'name'     =>  'Nombre',
            'surname'  =>  'Apellido',
            'email'    =>  'Correo Electrónico',
            'pnone'    =>  'Teléfono',
            'address'  =>  'Dirección',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'dni.required'     => 'Indique su :attribute',
            'dni.unique'       => 'Su :attribute ya se encuentra registrado',
            'name.required'    => 'Ingrese su :attribute.',
            'surname.required' => 'Ingrese su :attribute.',
            'email.required'   => 'Ingrese el :attribute.',
            'email.unique'     => 'El :attribute ingresado, ya se encuentra registrado.',
            'phone.required'   => 'Ingrese un Número de :attribute.',
            'address.required' => 'Ingrese su :attribute de Residencia.',
        ];
    }
}
