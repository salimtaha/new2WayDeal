<?php

namespace Database\Factories;

use App\Models\Charity;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CharityMember>
 */
class CharityMemberFactory extends Factory
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
            'phone'=>'01222223333',
            'governorate_id'=> $governorate->id,
            'city_id'=> $city->id,
            'address'=>$this->faker->streetAddress,
            'living_standard'=>$this->faker->randomElement(['low' , 'medium']),
            'created_at'=>$this->faker->dateTimeBetween('-1 year' , 'now'),
        ];
    }
}
