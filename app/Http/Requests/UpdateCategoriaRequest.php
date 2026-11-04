<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoriaId = $this->route('categoria')->id ?? $this->route('categoria');

        return [
            'nombre' => ['required', 'string', 'max:255', 'unique:categorias,nombre,' . $categoriaId],
            'descripcion' => ['nullable', 'string'],
        ];
    }
}