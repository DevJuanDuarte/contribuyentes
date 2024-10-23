<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contribuyentes>
 */
class ContribuyentesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombres = fake()->firstName(); // Generar un nombre
        $apellidos = fake()->lastName(); // Generar un apellido
    
        return [
            "tipo_documento" => "CC",
            "documento" => fake()->numberBetween(1095948273,1198273728),
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "nombre_completo" => "{$nombres} {$apellidos}", // Concatenar nombres y apellidos
            "direccion" => fake()->address(),
            "telefono" => fake()->phoneNumber(),
            "celular" => fake()->phoneNumber(),
            "email" => fake()->email(),
            "usuario_id" => 1,
        ];
    }
}
