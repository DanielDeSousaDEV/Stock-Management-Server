<?php

namespace App\Http\Requests\Locations;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class CreateLocationRequest extends FormRequest
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
            'description' => 'nullable|string',
            'street_name' => 'required|string',
            'number' => 'required|integer',
            'complement' => 'required|string',
            'neighborhood' => 'required|string',
            // 'state' => 'required|string',
            'city' => 'required|string',
            'CEP' => 'required|string|formato_cep',
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
            'description.string' => 'A descrição deve ser um texto',
            'street_name.required' => 'O nome da rua é obrigatorio',
            'street_name.string' => 'O nome da rua deve ser um texto',
            'number.required' => 'O número da casa é obrigatoria',
            'number.integer' => 'O número da casa deve ser um número inteiro',
            'complement.required' => 'O complemento é obrigatorio',
            'complement.string' => 'O complemento deve ser um texto',
            'neighborhood.required' => 'O bairro da rua é obrigatorio',
            'neighborhood.string' => 'O bairro da rua deve ser um texto',
            'city.required' => 'O nome da cidade é obrigatoria',
            'city.string' => 'O nome da cidade deve ser um texto',
            'CEP.required' => 'O CEP é obrigatoria',
            'CEP.string' => 'O CEP deve ser um texto',
            'CEP.formato_cep' => 'O CEP não possui um formato valido',
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
