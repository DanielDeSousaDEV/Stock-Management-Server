<?php

namespace App\Http\Requests\StockMovements;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateStockMovements extends FormRequest
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
            'quantity' => 'required|integer',
            'type' => 'required|string|in:entry,output,adjustment',
            'reason' => 'nullable|string',
            'product_id' => 'required|integer',
            'location_id' => 'required|integer',
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
            'quantity.required' => 'A quantidade é obrigatoria',
            'quantity.integer' => 'A quantidade deve ser um número inteiro',
            'type.required' => 'O tipo é obrigatorio',
            'type.string' => 'O tipo deve ser um texto',
            'type.in' => 'O tipo não é valido',
            'reason.string' => 'A razão deve ser um texto',
            'product_id.required' => 'O produto é obrigatoria',
            'product_id.integer' => 'O produto deve ser um número inteiro',
            'location_id.required' => 'A localização é obrigatoria',
            'location_id.integer' => 'A localização deve ser um número inteiro',
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
