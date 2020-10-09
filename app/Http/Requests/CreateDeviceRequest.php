<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeviceRequest extends FormRequest
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
            'prefix' => 'required|integer|min:1|max:99|exists:type_devices,prefix',
            'id' => 'required|integer|min:10000|max:9999999999999999999|unique:devices,id',
            'name' => 'required|string|max:25',
            'description' => 'max:50'
        ];
    }

    public function messages()
    {
        return [
            'prefix.required' => 'El prefijo del ID es requerido.',
            'prefix.integer' => 'El prefijo del ID es invalido.',
            'prefix.min' => 'El prefijo del ID es invalido.',
            'prefix.max' => 'El prefijo del ID es invalido.',
            'prefix.exists' => 'El prefijo del ID es invalido.',
            'id.required' => 'El ID del dispositivo es requerido.',
            'id.integer' => 'El ID del dispositivo es invalido.',
            'id.min' => 'El ID del dispositivo es invalido.',
            'id.max' => 'El ID del dispositivo es invalido.',
            'id.unique' => 'El ID del dispositivo es invalido. Contacte al personal de soporte.',
            'name.required' => 'Un nombre para el dispositivo es requerido.',
            'name.max' => 'El nombre es demasiado largo.',
            'description.max' => 'La descripcion es demasiado larga.',
        ];
    }
}
