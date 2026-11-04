<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'vendedor_id' => $this->user_id,
            'categoria_id' => $this->category_id,
            'nombre' => $this->name,
            'descripcion' => $this->description,
            'precio' => (float) $this->price,
            'stock' => (int) $this->stock,
            'activo' => (bool) $this->is_active,
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
        ];
    }
}