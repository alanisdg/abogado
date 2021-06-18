<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'rut'           =>  'required',
            'rol'           =>  'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += [
                'email'         =>  'required|unique:users,email',
                'rut'           =>  'required|unique:users,rut',
                'password'      =>  'required',
            ];
        } else {
            $rules += ['email'  =>  'required|unique:users,email,' . $this->user->id];
            $rules += ['rut'    =>  'required|unique:users,rut,' . $this->user->id];
        }

        return $rules;
    }
    public function attributes()
    {
        return [
            'first_name'    =>  'Nombre',
            'last_name'     =>  'Apellido',
            'rut'           =>  'RUT',
            'email'         =>  'Correo Electrónico',
            'rol'           =>  'Cargo',
            'password'      =>  'Contraseña'
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
            'first_name.required'   => 'Ingrese el :attribute del usuario.',
            'last_name.required'    => 'Ingrese el :attribute del usuario.',
            'rut.required'          => 'Indique el :attribute del usuario',
            'rut.unique'            => 'El :attribute ingresado, ya se encuentra registrado',
            'email.required'        => 'Ingrese el :attribute del usuario.',
            'email.unique'          => 'El :attribute ingresado, ya se encuentra registrado.',
            'rol.required'          => 'Seleccione el :attribute del usuario.',
            'password.required'     => 'Ingrese la :attribute del usuario.',
        ];
    }
}
