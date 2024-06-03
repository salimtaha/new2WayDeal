<?php

namespace App\Http\Livewire\Admin\Withdrawal;

use App\Models\WithdrawalSetting;
use Livewire\Component;

class UpdateWithdrawalSetting extends Component
{

    public $minimum_withdrawal_amount , $maximum_withdrawal_amount,$the_lowest_amount_in_the_account;


    public function render()
    {
        $setting = WithdrawalSetting::first();
        return view('livewire.admin.withdrawal.update-withdrawal-setting' , compact('setting'));
    }

    public function updateWithdrawalSetting()
    {
        $this->validate($this->filter());
        $setting = WithdrawalSetting::first();
        $setting->update([
            'minimum_withdrawal_amount'=>$this->minimum_withdrawal_amount,
            'maximum_withdrawal_amount'=>$this->maximum_withdrawal_amount,
            'the_lowest_amount_in_the_account'=>$this->the_lowest_amount_in_the_account,

        ]);

        $this->minimum_withdrawal_amount = "";
        $this->maximum_withdrawal_amount = "";
        $this->the_lowest_amount_in_the_account = "";

        $this->emit('updateSetting');
    }

    public function filter()
    {
        return [
            'minimum_withdrawal_amount'=>'required|numeric',
            'maximum_withdrawal_amount'=>'required|numeric',
            'the_lowest_amount_in_the_account'=>'required|numeric',
        ];
    }
}
