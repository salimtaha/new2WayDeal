<?php

namespace Database\Factories;

use App\Models\Charity;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'store_id'=>Store::inRandomOrder()->first()->id,
            'meals'=>$this->faker->paragraph(2),
            'status'=>$this->faker->randomElement(['pending' , 'accept' , 'canceld']),
            'created_at'=>$this->faker->dateTimeBetween('-1 year' , now()),

        ];
    }
}
