<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductoRequest extends FormRequest
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
			'codigo_producto' => ['required', 'string', Rule::unique('productos', 'codigo_producto')],
			'descripcion_producto' => 'required|string',
            'imagen_producto' => 'nullable|image',
			'cantidad_producto' => 'required',
			'monto_producto_compra' => 'required',
			'monto_producto_venta' => 'required',
			'medida_producto' => 'required|string',
			'id_status_producto' => 'required',
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
            'codigo_producto.unique' => 'El código ingresado ya está registrado. Por favor, utilice uno diferente.',
           
        ];
    }
}
