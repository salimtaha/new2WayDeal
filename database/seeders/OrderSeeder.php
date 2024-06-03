<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $orders = Order::factory()->count(10)->create();

        $orders->each(function ($order) {

            $orderDetails = OrderDetail::factory(8)->create([
                'order_id' => $order->id,
            ]);

            $totalPrice = $orderDetails->sum(function ($orderDetail) {
                return $orderDetail->product_quantity * $orderDetail->product_price;
            });

            // Update the total price of the order
            $order->update(['total_price' => $totalPrice]);
            $order->save();

            // create invoce to order
            Invoice::factory()->count(1)->create([
                'order_id'=>$order->id,
            ]);
        });
    }
}
