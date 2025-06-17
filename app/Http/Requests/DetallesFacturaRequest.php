<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetallesFacturaRequest extends FormRequest
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
            // Validación para el ID de la factura principal (desde <input name="idFactura">)
            'idFactura' => 'required|integer|exists:facturas,id', // Asegúrate que 'facturas' es el nombre de tu tabla de facturas
            'tipoFactura' => 'required|integer|exists:facturas,id_tipo_factura', // Asegúrate que 'facturas' es el nombre de tu tabla de facturas
            // Validación para el array de detalles
            'detalles_factura' => 'required|array|min:1', // El array de detalles debe existir y no estar vacío
            'detalles_factura.*.id_producto' => 'required|integer|exists:productos,id', // ID del producto
            'detalles_factura.*.id_status_producto_factura' => 'required|integer|exists:status_producto_facturas,id', // ID del estado del producto
            'detalles_factura.*.cantidad_producto_factura' => 'required|integer|min:1', // Cantidad
            'detalles_factura.*.monto_producto_factura' => 'required|numeric|min:0', // Monto unitario

            // Si tienes otros campos como nombre/código del producto desde JS (no en fillable, pero útil)
            // 'detalles_factura.*.codigo_producto' => 'nullable|string|max:255',
            // 'detalles_factura.*.descripcion_producto' => 'nullable|string|max:255',
        ];
        /*
        return [
			'id_factura' => 'required',
			'id_producto' => 'required',
			'id_status_producto_factura' => 'required',
			'cantidad_producto_factura' => 'required',
			'monto_producto_factura' => 'required',
        ];*/
    }

    /**
     * Custom error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'detalles_factura.required' => 'Debe agregar al menos un producto a la lista.',
            'detalles_factura.array' => 'Los detalles del producto deben ser un formato de lista válido.',
            'detalles_factura.min' => 'Debe agregar al menos un producto a la lista.',

            'detalles_factura.*.id_producto.required' => 'El ID del producto es requerido.',
            'detalles_factura.*.id_producto.integer' => 'El ID del producto debe ser un número entero.',
            'detalles_factura.*.id_producto.exists' => 'El producto seleccionado no es válido.',

            'detalles_factura.*.id_status_producto_factura.required' => 'El ID de status del producto es requerido.',
            'detalles_factura.*.id_status_producto_factura.integer' => 'El ID de status del producto debe ser un número entero.',
            'detalles_factura.*.id_status_producto_factura.exists' => 'El status del producto seleccionado no es válido.',

            'detalles_factura.*.cantidad_producto_factura.required' => 'La cantidad del producto es requerida.',
            'detalles_factura.*.cantidad_producto_factura.integer' => 'La cantidad del producto debe ser un número entero.',
            'detalles_factura.*.cantidad_producto_factura.min' => 'La cantidad del producto debe ser al menos 1.',

            'detalles_factura.*.monto_producto_factura.required' => 'El monto del producto es requerido.',
            'detalles_factura.*.monto_producto_factura.numeric' => 'El monto del producto debe ser un valor numérico.',
            'detalles_factura.*.monto_producto_factura.min' => 'El monto del producto no puede ser negativo.',

            'idFactura.required' => 'El ID de la factura principal es requerido.',
            'idFactura.exists' => 'La factura principal no existe.',
        ];
    }
}
