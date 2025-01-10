<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login (LoginRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!filled($user)) {
            return response([
                'error' => true,
                'message' => 'Email ou senha invalidos'
            ], 404);
        }

        if (Hash::check($validatedData['password'], $user->password)) {
            Auth::login($user);

            return response([
                'error' => false,
                'message' => 'Logado com sucesso!'
            ], 200);
        }else {
            return response([
                'error' => true,
                'message' => 'Email ou senha invalidos'
            ], 404);
        }
    }

    public function logout () 
    {
        try {
            Auth::logout();
        } catch (Exception $e) {
            return response([
                'error' => true,
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
