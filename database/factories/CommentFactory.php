<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id'=>\App\Models\Customer::get()->random()->id,
            'blogdetail_id'=>\App\Models\BlogDetail::get()->random()->id,
            'comment'=>$this->faker->paragraph(1)

        ];
    }
}
