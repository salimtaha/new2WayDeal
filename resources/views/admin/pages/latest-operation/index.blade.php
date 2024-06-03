@extends('admin.layouts.app')

@section('title', 'اخر العمليات علي النظام')

@section('body')
    <div class="container">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 style="color: rgb(236, 73, 73)"> اخر العمليات
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.welcome') }}">
                                    <i data-feather="home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">اخر العمليات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
        <div class="row">
            <div class="col-xl-8 mb-30">
                <div class="d-block w-100">
                    <h5 style="font-family: 'Cairo', sans-serif" class="card-title">اخر العمليات علي النظام</h5>
                </div>
            </div>
            <div class="col-xl-4 mb-30">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-target=".etab-p1, .etabi-img1"
                            data-toggle="tab">المستخدمين</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-target=".etab-p2, .etabi-img2"
                            data-toggle="tab">المتاجر</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-target=".etab-p3, .etabi-img3"
                            data-toggle="tab">المؤسسات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-4" data-target=".etab-p4, .etabi-img4"
                            data-toggle="tab">المبيعات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tab-5" data-target=".etab-p5, .etabi-img5"
                            data-toggle="tab">السحب</a></li>
                </ul>
            </div>
        </div>

        <div class="row parent">
            <div style="height: 400px;" class="col-xl-12 mb-30">
                <div class="tab-content">

                    <div class="tab-pane fade show active etab-p1">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                    <tr class="table-primary text-primary col-12">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>الحاله</th>
                                        <th>المحافظه</th>
                                        <th>المدينه </th>
                                        <th>الصوره</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\User::latest()->take(5)->get() as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> <a
                                                    href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="badge badge-pill"
                                                style="background:{{ $user->status == 'active' ? 'green' : 'red' }};margin-top: 20px;color:white">
                                                {{ $user->status }}</td>
                                            <td>{{ $user->governorate->name }}</td>
                                            <td>{{ $user->city->name }}</td>
                                            <td><img width="70px" class="img-thumbnail  img-fluid"
                                                    src="{{ asset($user->image) }}"></td>
                                            <td>
                                                <div class="btn-group">

                                                    <button type="button"
                                                        class="btn btn-danger dropdown-toggle btn-sm btn-air-light"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        العمليات
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.users.show', $user->id) }}">عرض<i
                                                                class="fa fa-eye"></i></a>
                                                        <form action="{{ route('admin.users.delete') }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id"
                                                                value="{{ $user->id }}">
                                                            <button type="submit" class="dropdown-item">حذف<i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>

                                                        <div class="dropdown-divider"></div>

                                                        @if ($user->status == 'blocked')
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.users.blocked.retrieve', $user->id) }}">فك
                                                                الحظر<i class="fa fa-undo" aria-hidden="true"></i></a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.users.blocked.block', $user->id) }}">بلوك<i
                                                                    class="fa fa-stop"></i></a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="tab-pane fade etab-p2">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                    <tr class="table-info text-danger col-12">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>الحاله </th>
                                        <th>المحافظه</th>
                                        <th>وثيقه الصحه</th>
                                        <th>الوثيقه التجاريه</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\Store::latest()->take(5)->get() as $store)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> <a
                                                    href="{{ route('admin.stores.show', $store->id) }}">{{ $store->name }}</a>
                                            </td>
                                            <td>{{ $store->email }}</td>
                                            <td class="badge badge-pill"
                                                style="background:{{ $store->status == 'approved' ? 'green' : 'red' }};margin-top: 20px;color:white">
                                                {{ $store->status }}</td>
                                            <td>{{ $store->governorate->name }}</td>
                                            <td><img width="70px" class="img-thumbnail  img-fluid"
                                                    src="{{ asset($store->health_approval_certificate) }}"></td>
                                            <td><img width="70px" class="img-thumbnail  img-fluid"
                                                    src="{{ asset($store->commercial_resturant_license) }}"></td>
                                            <td>
                                                <div class="btn-group">

                                                    <button type="button"
                                                        class="btn btn-danger dropdown-toggle btn-sm btn-air-light"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        العمليات
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.stores.show', $store->id) }}">عرض<i
                                                                class="fa fa-eye"></i></a>
                                                        <form action="{{ route('admin.stores.destroy') }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id"
                                                                value="{{ $store->id }}">
                                                            <button type="submit" class="dropdown-item">حذف<i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>

                                                        <div class="dropdown-divider"></div>

                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.stores.block', $store->id) }}">تقييد<i
                                                                class="fa fa-stop"></i></a>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade etab-p3">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                    <tr class="table-info text-danger col-12">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الالكتروني</th>
                                        <th>الحاله </th>
                                        <th>المحافظه</th>
                                        <th>المدينه</th>
                                        <th>الترخيص</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\Charity::latest()->take(5)->get() as $charity)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> <a
                                                    href="{{ route('admin.charities.show', $charity->id) }}">{{ $charity->name }}</a>
                                            </td>
                                            <td>{{ $charity->email }}</td>
                                            <td class="badge badge-pill"
                                                style="background:{{ $charity->status == 'approved' ? 'green' : 'red' }};margin-top: 20px;color:white">
                                                {{ $charity->status }}</td>
                                            <td>{{ $charity->governorate->name }}</td>
                                            <td>{{ $charity->city->name }}</td>
                                            <td><img width="70px" class="img-thumbnail  img-fluid"
                                                    src="{{ asset($charity->health_certificate) }}"></td>

                                            <td>
                                                <div class="btn-group">

                                                    <button type="button"
                                                        class="btn btn-danger dropdown-toggle btn-sm btn-air-light"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        العمليات
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.charities.show', $charity->id) }}">عرض<i
                                                                class="fa fa-eye"></i></a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.charities.destroy', $charity->id) }}">حذف<i
                                                                class="fa fa-trash"></i></a>
                                                        <div class="dropdown-divider"></div>
                                                        @if($charity->status =="blocked")
                                                        <a class="dropdown-item"
                                                        href="{{ route('admin.charities.active', $charity->id) }}">فك التقييد<i class="fa fa-undo" aria-hidden="true"></i></a>
                                                        @else
                                                        <a class="dropdown-item"
                                                        href="{{ route('admin.charities.block', $charity->id) }}">تقييد<i
                                                            class="fa fa-stop"></i></a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade etab-p4">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                    <tr class="table-info text-danger col-12">
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>المحافظه</th>
                                        <th>المدينه </th>
                                        <th>الحاله</th>
                                        <th>طريقه الدفع</th>
                                        <th>السعر</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\Order::latest()->take(5)->get() as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> {{ $order->name }}</td>
                                            <td>{{ $order->governorate->name }}</td>
                                            <td>{{ $order->city->name }}</td>
                                            <td class="badge badge-pill"
                                                style="background:{{ $order->status == 'paid' ? 'green' : 'red' }};margin-top: 20px;color:white">
                                                {{ $order->status == 'paid' ? 'مدفوع' : 'غير مدفوع' }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->total_price }}</td>

                                            <td>
                                                <a href="{{ route('admin.users.orders.detail', $order->id) }}">
                                                    عرض
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade etab-p5">
                        <div class="table-responsive mt-15">
                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                <thead>
                                    <tr class="table-info text-danger col-12">
                                        <th>#</th>
                                        <th>اسم المتجر</th>
                                        <th>المبلغ</th>
                                        <th>وسيله السحب </th>
                                        <th>حاله السحب</th>
                                        <th>تاريخ السحب </th>
                                        <th>عرض</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (\App\Models\Withdrawal::latest()->take(5)->get() as $withdrawal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td> {{ $withdrawal->store->name ?? 'المتجر محذوف'}}</td>
                                            <td>{{ $withdrawal->amount }}</td>
                                            <td>{{ $withdrawal->method->name }}</td>
                                            <td class="badge badge-pill"
                                                style="background:{{ $withdrawal->status == 'accepted' ? 'green' : 'red' }};margin-top: 20px;color:white">
                                                @if ($withdrawal->status == 'accepted')
                                                    'مقبول'
                                                @elseif($withdrawal->status == 'pending')
                                                    انتظار المراجعه
                                                @else
                                                    مرفوض
                                                @endif
                                            </td>
                                            <td>{{ $withdrawal->created_at->format('Y-m-d h:m:s') }}</td>

                                            <td>
                                                <a href="{{ route('admin.withdrawal.show', $withdrawal->id) }}">
                                                    عرض
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <td class="alert-danger" colspan="8">لاتوجد بيانات</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#myTab a').click(function() {
                var href = $(this).attr('href');
                if (href == "[href^='tab-']") {
                    $('.tab-pane').css('display', 'none');
                    $("[class^='etab-'][class^='etabi-']").removeClass('show');
                    $("[class^='etab-'][class^='etabi-']").css('display', 'block');
                    $("[class^='etab-'][class^='etabi-']").addClass('show');
                }
            });
        });
    </script>
@endpush

@push('css')
    <style>
        .container {
            background: white;
        }
    </style>
@endpush
