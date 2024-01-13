<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClientPagarMeRequest extends FormRequest
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
            "name" => [
                "required", "min:3", "max:64"
            ],
            "email" => [
                "email", "required", "unique:clients,email"
            ],
            "document" => [
                "required", "min:11", "max:11"
            ],
            "document_type" => [
                "required"
            ],
            "gender" => [
                "required"
            ],
            "country" => ["required"],
            "state" => ["required"],
            "city" => ["required"],
            "zip_code" => ["required"],
            "line" => ["required"],
            "country_code" => ["required"],
            "number" => ["required"],
            "area_code" => ["required"]

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'error' => 'Erro de validação',
            'messages' => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres',

            'email.email' => 'O formato do email é inválido',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'Já existe um cliente vinculado a este email',

            'document.required' => 'O campo documento é obrigatório',
            'document.min' => 'O campo documento deve ter exatamente :min caracteres',
            'document.max' => 'O campo documento deve ter exatamente :max caracteres',

            'document_type.required' => 'O campo tipo de documento é obrigatório',

            'gender.required' => 'O campo gênero é obrigatório',

            'country.required' => 'O campo país é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'zip_code.required' => 'O campo código postal é obrigatório',
            'line.required' => 'O campo endereço é obrigatório',

            'number.required' => 'O campo número é obrigatório',

            'country_code.required' => 'O campo código do país é obrigatório',
            'area_code.required' => 'O campo código de área é obrigatório',
        ];
    }
}
