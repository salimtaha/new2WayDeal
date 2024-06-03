<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::create([
            'name'=>'Admin',
            'user_name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('salimsalim'),
            'created_at'=>date('Y-m-d h:m:s'),
            'updated_at'=>date('Y-m-d h:m:s'),
        ]);
    }
}
