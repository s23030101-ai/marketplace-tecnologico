<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->name,
            'slug' => $this->slug,
            'descripcion' => $this->description,
            'creado_el' => $this->created_at->toDateTimeString(),
        ];
    }
}