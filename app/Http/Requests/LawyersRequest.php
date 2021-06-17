<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LawyersRequest extends FormRequest
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
            'lawyer_first_name' =>  'required',
            'lawyer_last_name'  =>  'required',
            'charge'            =>  'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'lawyer_rut'           =>  'required|unique:lawyers,lawyer_rut',
            ];
        } else {
            $rules += ['lawyer_rut'    =>  'required|unique:lawyers,lawyer_rut,' . $this->lawyer->id];
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            'lawyer_rut'        =>  'RUT',
            'lawyer_first_name' =>  'Nombre',
            'lawyer_last_name'  =>  'Apellido',
            'charge'            =>  'Cargo'
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
            'lawyer_rut.required'          => 'Indique el :attribute del abogado',
            'lawyer_rut.unique'            => 'El :attribute ingresado, ya se encuentra registrado',
            'lawyer_first_name.required'   => 'Ingrese el :attribute del abogado.',
            'lawyer_last_name.required'    => 'Ingrese el :attribute del abogado.',
            'charge.required'              => 'Ingrese la :attribute de Residencia.',
        ];
    }
}
