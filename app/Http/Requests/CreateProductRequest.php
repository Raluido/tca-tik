<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|max:25|unique:products,name,' . $id,
            'product_has_category' => 'required',
            'price' => 'required|decimal:2|between:1,10'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el artículo.',
            'name.max' => 'El nombre del artículo no debe exceder los 25 caracteres.',
            'product_has_category.required' => 'Tienes que indicar una categoría para el artículo.',
            'price.required' => 'Tienes que indicar un precio para el artículo.',
            'price-decimal' => 'Tienes que indicar dos decimales al precio.',
            'price.between' => 'La cuantía del precio no puede superar las 10 cifras.',
        ];
    }
}
