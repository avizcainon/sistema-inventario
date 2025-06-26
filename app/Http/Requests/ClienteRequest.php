<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteRequest extends FormRequest
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
			'dni' => ['required', 'string', Rule::unique('clientes', 'dni')],
			'nombre' => 'required|string',
			'apellido' => 'required|string',
			'telefono' => 'required|string',
			'correo' => 'required|string',
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
            'dni.unique' => 'El DNI ingresado ya está registrado. Por favor, utilice uno diferente.',
           
        ];
    }
}
