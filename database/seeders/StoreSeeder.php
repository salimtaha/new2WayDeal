<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\StoreRate;
use App\Models\AccountBalance;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $stores = Store::factory(10)->create();

        $stores->each(function ($store) {
            AccountBalance::factory()->create([
                'store_id' => $store->id,

            ]);

            StoreRate::factory(5)->create([
                'store_id' => $store->id,
                'user_id'=>random_int(1,10),
            ]);
        });


    }
}
