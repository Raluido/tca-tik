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
            'name' => 'required|max:50|unique:categories,name,' . $id,
            'description' => 'required|max:500',
            'prefix' => 'required|between:1,3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Has de añadir un nombre para el artículo.',
            'name.max' => 'El nombre de la categoría no debe contener más de 50 caracteres.',
            'name.unique' => 'Ya existe una categoría con ese nombre.',
            'description.required' => 'Has de añadir una descripción de la categoría.',
            'description.max' => 'La descripción del artículo no debe contener más de 500 caracteres.',
            'prefix.required' => 'Has de añadir un prefijo para la categoría.',
            'prefix.between' => 'El prefijo de contener entre 1 y 3 caracteres.',

        ];
    }
}
