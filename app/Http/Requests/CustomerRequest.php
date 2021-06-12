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
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'civil_status'  =>  'required',
            'profession'    =>  'required',
            'nationality'   =>  'required',
            'commune'       =>  'required',
            'region'        =>  'required',
            'address'       =>  'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'email'         =>  'required|unique:customers,email',
                'phone'         =>  'required|unique:customers,phone',
                'rut'           =>  'required|unique:customers,rut',
            ];
        } else {
            $rules += ['email'  =>  'required|unique:customers,email,' . $this->customer->id];
            $rules += ['phone'  =>  'required|unique:customers,phone,' . $this->customer->id];
            $rules += ['rut'    =>  'required|unique:customers,rut,' . $this->customer->id];
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            'rut'           =>  'RUT',
            'first_name'    =>  'Nombre',
            'last_name'     =>  'Apellido',
            'civil_staus'   =>  'Estado Civil',
            'profession'    =>  'Profesión',
            'nationality'   =>  'Nacionalidad',
            'commune'       =>  'Comuna',
            'region'        =>  'Región',
            'address'       =>  'Dirección',
            'email'         =>  'Correo Electrónico',
            'phone'         =>  'Número de Teléfono',
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
            'rut.required'          => 'Indique el :attribute del cliente',
            'rut.unique'            => 'El :attribute ingrsado, ya se encuentra registrado',
            'first_name.required'   => 'Ingrese el :attribute del Cliente.',
            'last_name.required'    => 'Ingrese el :attribute del Cliente.',
            'civil_status.required' => 'Ingrese el :attribute del Cliente.',
            'profession.required'   => 'Describa la :attribute del Cliente.',
            'nationality.required'  => 'Ingrese la :attribute del Cliente.',
            'commune.required'      => 'Indique la :attribute del Cliente.',
            'region.required'       => 'Especifique la :attribute del Cliente.',
            'email.required'        => 'Ingrese el :attribute del Cliente.',
            'email.unique'          => 'El :attribute ingresado, ya se encuentra registrado.',
            'phone.required'        => 'Ingrese un :attribute del Cliente.',
            'phone.unique'          => 'El :attribute ingresado, ya se encuentra registrado.',
            'address.required'      => 'Ingrese la :attribute de Residencia.',
        ];
    }
}
