<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Http\Resources\CategoriaCollection;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function index(): CategoriaCollection
    {
        return new CategoriaCollection(Categoria::all());
    }

    public function store(StoreCategoriaRequest $request): CategoriaResource
    {
        $categoria = Categoria::create($request->validated());
        return new CategoriaResource($categoria);
    }

    public function show(Categoria $categoria): CategoriaResource
    {
        return new CategoriaResource($categoria);
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): CategoriaResource
    {
        $categoria->update($request->validated());
        return new CategoriaResource($categoria);
    }

    public function destroy(Categoria $categoria): JsonResponse
    {
        $categoria->delete();
        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ], 200);
    }
}