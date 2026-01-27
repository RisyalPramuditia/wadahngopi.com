<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['coffee', 'non-coffee', 'food']);
        
        $images = [
            'coffee' => [
                'https://images.unsplash.com/photo-1541167760496-1628856ab752?auto=format&fit=crop&q=80&w=800', // Latte
                'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&q=80&w=800', // Espresso
                'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=800', // Latte Art
                'https://images.unsplash.com/photo-1511920170033-f83969a4c348?auto=format&fit=crop&q=80&w=800', // Pour over
            ],
            'non-coffee' => [
                'https://images.unsplash.com/photo-1544145945-f904253db0ad?auto=format&fit=crop&q=80&w=800', // Matcha
                'https://images.unsplash.com/photo-1623934199716-dc28818a6ec7?auto=format&fit=crop&q=80&w=800', // Choco
                'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&q=80&w=800', // Soda
            ],
            'food' => [
                'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&q=80&w=800', // Burger
                'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?auto=format&fit=crop&q=80&w=800', // Pizza
                'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&q=80&w=800', // Croissant
                'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?auto=format&fit=crop&q=80&w=800', // Toast
            ]
        ];

        return [
            'cafe_id' => \App\Models\Cafe::factory(),
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(8), // Add random description
            'price' => fake()->numberBetween(18000, 65000),
            'type' => $type,
            'image_path' => fake()->randomElement($images[$type]),
        ];
    }
}
