<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|between:3,25|unique:products,name,' . $id,
            'product_has_category' => 'required',
            'price' => 'required|numeric|between:0,9999.99',
            'prefix' => 'required|between:1,3',
            'observations' => 'max:100',
            'description' => 'max:500'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el artículo.',
            'name.between' => 'El nombre del artículo no debe exceder los 25 caracteres y superior a 3.',
            'product_has_category.required' => 'Tienes que indicar una categoría para el artículo.',
            'price.required' => 'Tienes que indicar un precio para el artículo.',
            'price.numeric' => 'Tienes que indicar un valor numerico.',
            'price.between' => 'La cuantía del precio no puede superar las 4 cifras.',
            'prefix.required' => 'Tienes que indicar una referencia para el artículo.',
            'observations.required' => 'El número de caracteres máximo es de 100.',
            'description.required' => 'El número de caracteres máximo es de 500.',
        ];
    }
}
