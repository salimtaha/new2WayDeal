<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        $available_for = $this->faker->dateTimeBetween($createdAt , 'now');
        $expire_date = $this->faker->dateTimeBetween($available_for , 'now');

        $price = $this->faker->randomFloat(2 , 50 , 1000);
        $descount = $this->faker->randomFloat(2 , 40 , $price);

        return [
            'category_id'=>Category::inRandomOrder()->first()->id,
            'store_id'=>Store::inRandomOrder()->first()->id,
            'name'=>$this->faker->firstName,
            'description'=>$this->faker->paragraph(1),
            'available_for'=>$available_for,
            'expire_date'=>$expire_date,
            'price'=>$price,
            'descount'=>$descount,
            'quantity'=>random_int(10,300),
            'created_at'=>$createdAt,
        ];

    }
}
