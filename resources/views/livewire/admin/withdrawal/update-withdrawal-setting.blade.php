<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4>إعدادات السحوبات</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="updateWithdrawalSetting">
                <div class="form-group">
                    <label for="minAmount">الحد الأدنى للسحب</label>
                    <input type="text" class="form-control" value="{{ $setting->minimum_withdrawal_amount }}"
                        wire:model.prevent="minimum_withdrawal_amount" placeholder="الحد الأدنى للسحب">
                    @error('minimum_withdrawal_amount')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="maxAmount">الحد الأقصى للسحب</label>
                    <input type="text" class="form-control" wire:model.prevent="maximum_withdrawal_amount"
                        placeholder="الحد الأقصى للسحب">
                    @error('maximum_withdrawal_amount')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="minBalance">الحد الأدنى للرصيد المتبقي في حساب البائع</label>
                    <input type="text" class="form-control" wire:model.prevent="the_lowest_amount_in_the_account"
                        placeholder="الحد الأدنى للرصيد">
                    @error('the_lowest_amount_in_the_account')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">تحديث</button>
            </form>
        </div>
    </div>
</div>
