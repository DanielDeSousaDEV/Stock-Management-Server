<?php

namespace App\Http\Requests\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateProductRequest extends FormRequest
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
            'description' => 'required|string',
            'price' => 'required|number',
            'quantity' => 'required|integer',
            'minimum_quantity' => 'required|integer',
            'category_id' => 'required|integer',
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
            'description.required' => 'A descrição é obrigatorio',
            'description.string' => 'A descrição deve ser um texto',
            'price.required' => 'O preço é obrigatorio',
            'price.number' => 'O preço deve ser um número',
            'quantity.required' => 'A quantidade é obrigatorio',
            'quantity.integer' => 'A quantidade deve ser um número inteiro',
            'minimum_quantity.required' => 'A quantidade minima é obrigatorio',
            'minimum_quantity.integer' => 'A quantidade minima deve ser um número inteiro',
            'category_id.required' => 'A categoria é obrigatorio',
            'category_id.integer' => 'A  deve ser um número inteiro',
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
