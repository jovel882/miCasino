<?php

namespace App\Http\Requests;

use App\Helpers\UploadHelper;
use Illuminate\Foundation\Http\FormRequest;

class ValidateUrlGenerateRequest extends FormRequest
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
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'telefono' => 'required|regex:/^[0-9]{10,}$/',
            'correo' => 'required|email',
            'imagen' => 'required|image|max:' . (UploadHelper::maxUploadSize() * 1000),
        ];
    }
}
