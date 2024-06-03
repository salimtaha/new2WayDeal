<?php

namespace Database\Factories;

use App\Models\Mediator;
use App\Models\Store;
use App\Models\WithdrawalMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Withdrawal>
 */
class WithdrawalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        // Ensure updated_at is always after created_at
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'mediator_id' => Mediator::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
            'withdrawal_method' => WithdrawalMethod::inRandomOrder()->first()->id,
            'number' => $this->faker->randomElement(['01222554545', '01235774547', '01222553222', '01222789000']),
            'amount' => random_int(500, 2000),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            'status' => $this->faker->randomElement(['pending' , 'accepted' , 'rejected']),

        ];
    }

}
