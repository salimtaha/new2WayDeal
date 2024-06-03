
    <div class="card">
        <div class="card-header">
            <h4>قائمة طرق الدفع {{ App\Models\WithdrawalMethod::count() }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الطريقة</th>
                            <th> الحاله</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($methods as $method)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $method->name }}</td>
                            <td class="badge badge-pill"
                                            style="background:{{ $method->status == 'available' ? 'green' : 'red' }};margin-top: 20px;color:white">
                                            {{ $method->status == 'available' ? 'فعال' : 'غير فعال' }}</td>
                            <td>
                                <div class="btn-group">

                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle btn-air-light"
                                        data-toggle="dropdown" aria-expanded="false">
                                        العمليات
                                    </button>

                                    <div class="dropdown-menu">
                                        <button class="dropdown-item"
                                            wire:click="delete({{ $method->id }})">حذف<i
                                                class="fa fa-trash"></i></button>

                                        <div class="dropdown-divider"></div>

                                        @if($method->status =="disabled")
                                        <button class="dropdown-item"
                                        wire:click="enable({{ $method->id }})">تفعيل<i class="fa fa-refresh" aria-hidden="true"></i></i></button>
                                        @else
                                        <button class="dropdown-item"
                                        wire:click="disabled({{ $method->id }})">تعطيل<i
                                                class="fa fa-stop"></i></button>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Add more rows for payment methods -->
                    </tbody>
                </table>
                {{ $methods->links() }}
            </div>
        </div>
    </div>
