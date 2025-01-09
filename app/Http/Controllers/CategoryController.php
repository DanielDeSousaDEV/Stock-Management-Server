<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCategories = Category::all();

        return $allCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)  
    {   
        try {
            $createdCategory = Category::create($request->validated());

            return $createdCategory;
        }catch (Exception $e) {
            return response([
                'error' => true,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);

        if (!filled($category)) {
            return response([
                'error' => true,
                'message' => 'Categoria não encontrada'
            ], 404);
        }

        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $dataForUpdate = $request->validated();

        if (!filled($dataForUpdate)) {
            return response([
                'error' => true,
                'message' => 'Não possui dados para atualizar'
            ], 404);
        }

        $category = Category::find($id);

        if (!filled($category)) {
            return response([
                'error' => true,
                'message' => 'Categoria não encontrada'
            ], 404);
        }

        $category->update($dataForUpdate);

        return response([
            'error' => false,
            'message' => 'Categoria atualizada com sucesso'
        ], 200);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!filled($category)) {
            return response([
                'error' => true,
                'message' => 'Categoria não encontrada'
            ], 404);
        }

        $category->delete();

        return response([
            'error' => false,
            'message' => 'Categoria deletada'
        ], 200);
    }
}
