<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allUsers = User::all();

        return $allUsers;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $createdUser = User::create($request->validated());

            return $createdUser;
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
        $user = User::find($id);

        if (!filled($user)) {
            return response([
                'error' => true,
                'message' => 'usuario não encontrada'
            ], 404);
        }

        return $user;
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
