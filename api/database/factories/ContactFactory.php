<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => "(02) ". Str::random(10),
            'address' => fake()->name() . " , AB Canada", 
            'company_ids' => null,
        ];
    }
}
