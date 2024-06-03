<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WithdrawalSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WithdrawalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WithdrawalSetting::create([
            'minimum_withdrawal_amount'=>100,
            'maximum_withdrawal_amount'=>15000,
            'the_lowest_amount_in_the_account'=>500,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
