<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use App\Models\Governorate;
use App\Models\Order;
use App\Models\WithdrawalMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    public function definition()
    {
        $governorate = Governorate::inRandomOrder()->first();

        $city = City::where('governorate_id', $governorate->id)->inRandomOrder()->first();
        if (!$city) {
            $city = City::factory()->create([
                'governorate_id' => $governorate->id,
                'name' => $this->faker->name,
            ]);
        }

        $user = User::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'status' => $this->faker->randomElement(['completed', 'paid', 'pending']),
            'governorate_id' => $governorate->id,
            'city_id' => $city->id,
            'address' => $this->faker->address,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email,
            'total_price' => 0,
            'shipping_price' => rand(30, 100),
            'payment_method' => WithdrawalMethod::inRandomOrder()->first()->name,
            'created_at' => $this->faker->dateTimeBetween('-1 year' , 'now'),


        ];
    }
}
