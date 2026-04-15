<?php

namespace App\Http\Requests;

/*
✅ validaciones
✅ autorización
✅ lógica previa al controller
👉 Sirve para sacar la validación del controller y dejarlo limpio. */

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fecha' => 'required|date',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
            'user_id' => 'required|integer',
         ];
    }
}
