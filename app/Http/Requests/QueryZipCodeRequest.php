<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QueryZipCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cep' => ['required', 'regex:/^\d{8}$|^\d{5}-\d{3}$/']
        ];
    }
}
