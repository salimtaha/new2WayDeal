<?php

namespace Database\Seeders;

use App\Models\Mediator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MediatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meditors = ['mediator1' , 'mediator2','mediator3','mediator4','mediator5','mediator6','mediator7','mediator8'];
        foreach($meditors as $meditor){
            Mediator::create([
                'name'=>$meditor,
                'email'=>$meditor.'@gmail.com',
                'user_name'=>$meditor.'user name',
                'password'=>bcrypt('salimsalim'),
                'image'=>'default.jpg',
            ]);

        }
    }
}
