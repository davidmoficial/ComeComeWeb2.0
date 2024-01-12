<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                "email", "required", "unique:users,email"
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
            "telephone_number" => ["required"]

        ];
    }
}
