<?php

namespace App\Http\Requests\SellState;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'name' => "required|string",
            'desc' => "required|string",
        ];
    }

    public function messages()
    {
      return [
        'name.required' => 'Campo nombre es requerido',
        'desc.required' => 'Campo descripcion es requerido',
      ];
    }

}
