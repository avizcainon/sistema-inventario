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
         $rules = [
			##'dni' => ['required', 'string', Rule::unique('clientes', 'dni')],
			'nombre' => 'required|string',
			'apellido' => 'required|string',
			'telefono' => 'required|string',
			'correo' => 'required|string',
        ];

        // Lógica condicional para las reglas 'unique'
        // El método 'isMethod()' te permite saber qué tipo de petición HTTP es.
        // 'post' para la creación, 'put'/'patch' para la actualización.
        if ($this->isMethod('post')) {
            // Reglas para la creación (método STORE)
            $rules['dni'] = ['required', 'string', Rule::unique('clientes', 'dni')];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Reglas para la actualización (método UPDATE)
            // Para el DNI: debe ser único, PERO ignorar el DNI del cliente que estamos editando.
            // $this->route('cliente') obtiene la instancia del modelo Cliente inyectada por la ruta.
            // Si tu parámetro de ruta no se llama 'cliente', cámbialo por el nombre correcto (ej. $this->route('id') si pasas solo el ID).
            $rules['dni'] = ['required', 'string', Rule::unique('clientes', 'dni')->ignore($this->route('cliente'))];

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
            'dni.unique' => 'El DNI ingresado ya está registrado. Por favor, utilice uno diferente.',
           
        ];
    }
}
