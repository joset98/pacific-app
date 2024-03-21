<?php

namespace App\Http\Requests\Sale;

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
            'price' => "required",
            'num_order' => "required",
            // 'document' => "required",
            'machine_detail' => "required",
            'adition' => "required",
            'machine_id' => "required",
            'model' => "required",
            'desc' => "required",
            'provider_id' => "required",
            // 'client' => "required",
        ];
    }

    public function messages()
    {
      return [
        // 'name.required' => 'Campo nombre es requerido',
        // 'desc.required' => 'Campo descripcion es requerido',
      ];
    }

}
