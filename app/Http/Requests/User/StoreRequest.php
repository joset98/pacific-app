<?php

namespace App\Http\Requests\User;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
      return [
          'name' => "required|string",
          'last_name' => "required|string",
          // 'username' => "required|string|unique:users",
          'email' => "required|unique:users|email",
          'password' => "required|string|min:4|max:48"
      ];
    }

    public function messages()
    {
      return [
        'password.required' => 'La contraseña es requerida',
        'username.unique' => 'El nombre usuario ya esta en uso',
        'name.required' => 'El nombre es requerido',
        'last_name.required' => 'El apellido es requerido',
        'email.unique' => 'El correo electronico ya esta en uso',
        'email.email' => 'El correo electronico esta mal construido',
        'email.required' => 'El correo es requerido',
      ];
    }

    /**
    * Devolucion de los errores correspondientes
    *
    * @return HttpResponseException
    */

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()->all(), 422));
    }
}
