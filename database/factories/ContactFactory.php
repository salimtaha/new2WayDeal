<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name'=>User::inRandomOrder()->first()->name,
            'email'=>User::inRandomOrder()->first()->email,
            'subject'=>$this->faker->title(),
            'message'=>$this->faker->address,
            'status'=>$this->faker->randomElement(['pending' , 'completed']),
        ];
    }
}
