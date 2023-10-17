<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarUrlRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'nullable|string',
            'apellidos' => 'nullable|string',
            'telefono' => 'nullable|regex:/^[0-9]*$/|min:10',
            'correo' => 'nullable|email',
            'imagen' => 'nullable|url',
        ];
    }
}
