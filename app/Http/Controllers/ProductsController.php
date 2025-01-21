<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Products\CreateProductRequest;

use App\Http\Requests\Products\CreateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProducts = Product::with('category')->get();

        return $allProducts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {

        $requestValidated = $request->validated();

        $filename = $requestValidated['image']->hashName();

        if(!Storage::disk('public')->put('products/', $requestValidated['image'])){
            return response([
                'error' => true,
                'message' => 'Não foi possivel guardar a imagem'
            ], 503);
        }

        $filepath = 'products/' . $filename;

        $imgUrl = asset(Storage::url($filepath));

        $requestValidated['image'] = $imgUrl;

        try {
            $createdProduct = Product::create($requestValidated);

            return $createdProduct;
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
        $product = Product::find($id);

        if (!filled($product)) {
            return response([
                'error' => true,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(CreateStockMovements $request, string $id)
    // {
    //     $dataForUpdate = $request->validated();

    //     if (!filled($dataForUpdate)) {
    //         return response([
    //             'error' => true,
    //             'message' => 'Não possui dados para atualizar'
    //         ], 404);
    //     }

    //     $stockMovement = StockMovement::find($id);

    //     if (!filled($stockMovement)) {
    //         return response([
    //             'error' => true,
    //             'message' => 'Movimentação do estoque não encontrada'
    //         ], 404);
    //     }

    //     $stockMovement->update($dataForUpdate);

    //     return response([
    //         'error' => false,
    //         'message' => 'Movimentação do estoque atualizada com sucesso'
    //     ], 200);;
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $stockMovement = StockMovement::find($id);

    //     if (!filled($stockMovement)) {
    //         return response([
    //             'error' => true,
    //             'message' => 'Movimentação do estoque não encontrada'
    //         ], 404);
    //     }

    //     $stockMovement->delete();

    //     return response([
    //         'error' => false,
    //         'message' => 'Movimentação do estoque deletada'
    //     ], 200);
    // }
}
