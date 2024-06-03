<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        return [
            'product_id'=>$product->id,
            'product_name'=>$product->name,
            'product_price'=>$product->price,
            'product_quantity'=>rand(1,5),
            'expire_date'=>$product->expire_date,
        ];
    }
}
