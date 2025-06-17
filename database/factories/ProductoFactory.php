<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    protected $model = Producto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion_producto' => $this->faker->sentence(2),
            'codigo_producto' => $this->faker->bothify('???-###'),
            'monto_producto_compra' => $this->faker->randomFloat(2, 10, 100),
            'monto_producto_venta' => $this->faker->randomFloat(2, 10, 100),
            'cantidad_producto' => $this->faker->numberBetween(0, 100),
            'imagen_producto' => $this->faker->imageUrl(640, 480, 'productos', true),
            'id_status_producto' => $this->faker->numberBetween(1, 2),
            'medida_producto' => $this->faker->numerify('##'), 
        ];
    }
}
