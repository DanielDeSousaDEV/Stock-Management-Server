<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatorio',
            'name.string' => 'O nome deve ser um texto',
            'email.required' => 'O email é obrigatorio',
            'email.string' => 'O email deve ser um texto',
            'email.email' => 'O email não possui um formato valido',
            'email.unique' => 'O email já esta sendo usado no site',
            'password.required' => 'A senha é obrigatorio',
            'password.string' => 'A senha deve ser um texto',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        // Personaliza a resposta JSON para erros de validação
        throw new ValidationException($validator, response()->json([
            'error' => true,
            'message' => 'Erro de validação',
            'errors' => $validator->errors(), // Mensagens de erro
        ], 422));
    }
}
