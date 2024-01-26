<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStorehouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'name' => 'required|max:25|unique:storehouses,name,' . $id,
            'description' => 'required|between:5,100',
            'address' => 'required|between:5,100'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el almacén.',
            'name.unique' => 'El nombre seleccionado ya lo tiene otro almacén.',
            'name.max' => 'El nombre del almacén no debe exceder los 25 caracteres.',
            'description.required' => 'Has de añadir una descriptión del almacén.',
            'description.between' => 'La descripción del almacén debe de estar entre los 5 y los 100 caracteres.',
            'address.required' => 'Has de añadir una dirección del almacén.',
            'address.between' => 'La dirección del almacén debe de estar entre los 5 y los 100 caracteres.',

        ];
    }
}
