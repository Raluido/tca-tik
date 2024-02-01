<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|between:3,25|unique:categories,name,' . $id,
            'description' => 'required|between:5,100',
            'prefix' => 'required|between:2,3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el artículo.',
            'name.between' => 'El nombre de la categoría debe de estar entre los 3 y los 25 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'description.required' => 'Has de añadir una descripción de la categoría.',
            'description.between' => 'La descripción del artículo debe de estar entre los 5 y los 100 caracteres.',
            'prefix.required' => 'Has de añadir un prefijo para la categoría.',
            'prefix.between' => 'El prefijo de contener entre 2 y 3 caracteres.',

        ];
    }
}
