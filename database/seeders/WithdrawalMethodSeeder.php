<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WithdrawalMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WithdrawalMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['فودافون كاش' , 'اتصالات كاش' , 'باي بال' , 'فيزا' , 'اورنج كاش'];
        foreach($data as $item){

            WithdrawalMethod::create([
                'name'=>$item,
                'description'=>'وسيله دفع الكتروني',
                'status'=>'available',
            ]);

        }
    }
}
