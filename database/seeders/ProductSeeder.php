<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $products = Product::factory()->count(20)->create();

         $products->each(function($product){
            ProductImage::factory(2)->create([
                'product_id'=>$product->id,
            ]);

            ProductReview::factory(4)->create([
                'product_id'=>$product->id,
            ]);
         });
    }
}
