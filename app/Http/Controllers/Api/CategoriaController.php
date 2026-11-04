<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return CategoriaResource::collection($categorias);
    }

    public function store(StoreCategoriaRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $categoria = Categoria::create($data);

        return response()->json([
            'mensaje' => 'Categoría creada con éxito',
            'datos' => new CategoriaResource($categoria)
        ], 201);
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return new CategoriaResource($categoria);
    }

    public function update(UpdateCategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $data = $request->validated();

        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $categoria->update($data);

        return response()->json([
            'mensaje' => 'Categoría actualizada con éxito',
            'datos' => new CategoriaResource($categoria)
        ], 200);
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return response()->json([
            'mensaje' => 'Categoría eliminada con éxito'
        ], 200);
    }
}