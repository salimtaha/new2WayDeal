<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $governorate = Governorate::inRandomOrder()->first();

        $city = City::where('governorate_id', $governorate->id)->inRandomOrder()->first();
        if (!$city) {
            $city = City::factory()->create([
                'governorate_id' => $governorate->id,
                'name'=>$this->faker->name,
            ]);
        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone'=>$this->faker->randomElement(['01222554545' ,'01235774547' ,'01222553222' , '01222789000']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'governorate_id' =>$governorate->id,
            'city_id' =>$city->id,
            'created_at'=>$this->faker->dateTimeBetween('-1 year' , now()),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
