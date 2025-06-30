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
         $rules = [
			##'codigo_producto' => ['required', 'string', Rule::unique('productos', 'codigo_producto')],
			'descripcion_producto' => 'required|string',
            'imagen_producto' => 'nullable|image',
			'cantidad_producto' => 'required',
			'monto_producto_compra' => 'required',
			'monto_producto_venta' => 'required',
			'medida_producto' => 'required|string',
			'id_status_producto' => 'required',
        ];

        // Lógica condicional para las reglas 'unique'
        // El método 'isMethod()' te permite saber qué tipo de petición HTTP es.
        // 'post' para la creación, 'put'/'patch' para la actualización.
        if ($this->isMethod('post')) {
            // Reglas para la creación (método STORE)
            $rules['codigo_producto'] = ['required', 'string', Rule::unique('productos', 'codigo_producto')];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Reglas para la actualización (método UPDATE)
            // Para el DNI: debe ser único, PERO ignorar el DNI del cliente que estamos editando.
            // $this->route('cliente') obtiene la instancia del modelo Cliente inyectada por la ruta.
            // Si tu parámetro de ruta no se llama 'cliente', cámbialo por el nombre correcto (ej. $this->route('id') si pasas solo el ID).
            $rules['dni'] = ['required', 'string', Rule::unique('productos', 'codigo_producto')->ignore($this->route('producto'))];

        }

         return $rules;
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
