<?php

namespace Database\Seeders;

use App\Models\Charity;
use App\Models\CharityMember;
use App\Models\Donation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charities = Charity::factory()->count(20)->create();

        $charities->each(function($charity){
            Donation::factory(6)->create([
                'charity_id'=>$charity->id,
            ]);
            CharityMember::factory(10)->create([
                'charity_id'=>$charity->id,
            ]);
        });
    }
}
