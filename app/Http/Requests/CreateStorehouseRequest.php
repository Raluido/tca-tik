<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CreateStorehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id;

        return [
            'name' => 'required|max:50|unique:storehouses,name,' . $id,
            'description' => 'max:500',
            'address' => 'required|max:500',
            'prefix' => 'required|between:1,4'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el almacén.',
            'name.unique' => 'El nombre seleccionado ya lo tiene otro almacén.',
            'name.max' => 'El nombre del almacén no debe contener más de 50 caracteres.',
            'description.between' => 'La descripción del almacén no debe contener más de 500 caracteres.',
            'address.required' => 'Has de añadir una dirección del almacén.',
            'address.between' => 'La dirección del almacén no debe contener más de 500 caracteres.',
            'prefix.required' => 'Has de añadir un identificador del almacén.',
            'prefix.between' => 'El identificador del almacén debe de estar entre los 1 y los 4 caracteres.',

        ];
    }
}
