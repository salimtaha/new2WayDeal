<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        $governorate = Governorate::inRandomOrder()->first();

        $city = City::where('governorate_id', $governorate->id)->inRandomOrder()->first();
        if (!$city) {
            $city = City::factory()->create([
                'governorate_id' => $governorate->id,
                'name'=>$this->faker->name,
            ]);
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'user_name' => $this->faker->userName(),
            'password' => bcrypt('salimsalim'),
            'phone' => $this->faker->phoneNumber,
            'city_id' => $city->id,
            'governorate_id' => $governorate->id,
            'street' => $this->faker->address,
            'status' => $this->faker->randomElement(['approved', 'pending', 'blocked']),
            'created_at'=>$createdAt,

        ];
    }
}
