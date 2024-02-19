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
        return [
            'name' => 'required|max:50|unique:products,name,' . $this->id,
            'product_has_category' => 'required',
            'price' => 'required|numeric|between:0,9999.99',
            'tax' => 'required|numeric|between:0,99.99',
            'prefix' => 'required|between:1,3',
            'observations' => 'max:500',
            'description' => 'max:500',
            'images.*' => 'mimes:jpg,jpeg,png',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el artículo.',
            'name.max' => 'El número de caracteres máximo es de 50.',
            'product_has_category.required' => 'Tienes que indicar una categoría para el artículo.',
            'price.required' => 'Tienes que indicar un precio para el artículo.',
            'price.numeric' => 'Tienes que indicar un valor numerico.',
            'price.between' => 'La cuantía del precio no puede superar las 4 cifras.',
            'tax.required' => 'Tienes que indicar un inpuesto para el artículo.',
            'tax.numeric' => 'Tienes que indicar un valor numerico.',
            'tax.between' => 'La cuantía del inpuesto no puede superar las 2 cifras.',
            'prefix.required' => 'Tienes que indicar una referencia para el artículo.',
            'observations.max' => 'El número de caracteres máximo es de 500.',
            'description.max' => 'El número de caracteres máximo es de 500.',
            'mimes' => 'Las imágenes deben tener el formato jpg, jpeg o png.'
        ];
    }
}
