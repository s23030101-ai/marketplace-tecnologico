<?php

namespace Database\Factories;

use App\Models\Inventario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'seller']),
            'store_name' => 'Tienda de' . fake()->firstName(),
            'bio' => fake()->sentence(),
            'contact_phone' => fake()->phoneNumber(),
            'social_link' => 'https://instagram.com/' . fake()->userName(),
        ];
    }
}
