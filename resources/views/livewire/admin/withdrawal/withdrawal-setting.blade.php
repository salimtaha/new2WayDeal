



    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>البيانات الحالية</h4>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">الحد الأدنى للسحب  : <span id="currentMinAmount">{{ $withdrawal_setting->minimum_withdrawal_amount }}</span></li>
                    <li class="list-group-item">الحد الأقصى للسحب  :  <span id="currentMaxAmount">{{ $withdrawal_setting->maximum_withdrawal_amount }}</span></li>
                    <li class="list-group-item">الحد الأدنى للرصيد المتبقي  : <span id="currentMinBalance">{{ $withdrawal_setting->the_lowest_amount_in_the_account }}</span></li>
                    <li class="list-group-item">  اخر تحديث  : <span id="currentPaymentMethod">{{ $withdrawal_setting->updated_at->format('Y-m-d h:m')}}</span></li>

                </ul>
            </div>
        </div>
    </div>


