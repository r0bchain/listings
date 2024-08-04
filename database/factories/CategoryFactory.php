<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Factories\Providers\CategoryFakerProvider;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new CategoryFakerProvider($this->faker));
       
        return [
            'name' => $this->faker->category(),
            'description' => $this->faker->sentence(),
            'cover_image' => $this->faker->imageUrl(),
        ];
    }
}