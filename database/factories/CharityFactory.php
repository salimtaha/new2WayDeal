<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charity>
 */
class CharityFactory extends Factory
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
            'name'=>$this->faker->name(),
            'email'=>$this->faker->unique()->email(),
            'email_verified_at'=>now(),
            'password'=>bcrypt('salimsalim'),
            'description'=>$this->faker->paragraph(1),
            'phone'=>$this->faker->phoneNumber,
            'image'=>'default.jpg',
            'governorate_id'=>$governorate->id,
            'address'=>$this->faker->address,
            'city_id'=>$city->id,
            'status'=>$this->faker->randomElement(['approved' ,'pending']),
            'created_at'=>$this->faker->dateTimeBetween('-1 year' , now()),

        ];
    }
}
