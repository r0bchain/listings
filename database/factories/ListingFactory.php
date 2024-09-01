<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Faker\ThaiCitiesProvider;
use Illuminate\Support\Collection;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $this->faker->addProvider(new ThaiCitiesProvider($this->faker));

        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'beds' => $this->faker->numberBetween(1, 7),
            'baths' => $this->faker->numberBetween(1, 7),
            'area' => $this->faker->numberBetween(30, 400),
            'city' => $this->faker->thaiCity(),
            'code' => $this->faker->postcode(),
            'street' => $this->faker->streetName(),
            'street_nr' => $this->faker->numberBetween(10, 200),
            'price' => $this->faker->numberBetween(50_000, 2_000_000),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}