<?php

namespace App\Http\Livewire\Admin\Withdrawal;

use App\Models\WithdrawalSetting as ModelsWithdrawalSetting;
use Livewire\Component;


class WithdrawalSetting extends Component
{
    protected $listeners = ['updateSetting' => '$refresh'];

    public function render()
    {
        $withdrawal_setting = ModelsWithdrawalSetting::first();

        return view('livewire.admin.withdrawal.withdrawal-setting', compact('withdrawal_setting'));
    }


}
