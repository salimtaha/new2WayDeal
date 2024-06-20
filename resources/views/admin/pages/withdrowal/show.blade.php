@extends('admin.layouts.app')
@section('title', 'تفاصيل الحسب')

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="color: rgb(236, 73, 73)">تفاصيل عمليه السحب
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.withdrawal.index') }}">السحوبات الماليه </a>
                        </li>
                        <li class="breadcrumb-item active"><a href="">عمليه سحب : {{ $store->name }}
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="card shadow">

        <div class="row" action="" method="post">
            @csrf
            <div class="col-md-3 border-right">


                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="{{ asset($store->image) }}"><br>
                    <span class="badge badge-pill {{ $store->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                        @if ($store->status == 'approved')
                            المتجر موثق
                        @elseif ($store->status == 'pending')
                            انتظار الموافقه
                        @elseif($store->status == 'blocked')
                            المتجر محظور
                        @else
                            بيانات الاعتماد مرفوضه
                        @endif
                    </span>
                    <br>
                    <span class="font-weight-bold">{{ $store->name }}</span><span
                        class="text-black-50">{{ $store->email }}</span><br>

                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="{{ route('admin.stores.show',$store->id) }}"
                            class="btn btn-lg btn-print">
                            عرض المتجر
                        </a>

                    </div>
                </div>

            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">بيانات المتجر </h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">الاسم</label><input type="text"
                                class="form-control"readonly value="{{ $store->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">رقم الجوال </label><input type="text"
                                class="form-control" readonly value="{{ $store->phone }}"></div>
                        <div class="col-md-12"><label class="labels">البريد الالكتروني </label><input type="email"
                                readonly class="form-control" value="{{ $store->email }}"></div>
                        <div class="col-md-12"><label class="labels">تاريخ الانضمام </label><input type="email" readonly
                                class="form-control" value="{{ $store->created_at->format('Y-m-d') }}"></div><br><br>



                    </div>



                </div>
            </div>
            <div class="col-md-4 ">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span
                            style="color: @if ($store->status == 'approved') green @else red @endif ;margin-right: 20px">{{ $store->status == 'approved' ? 'الحساب نشط' : ' غير نشط' }}</span>
                    </div><br>
                    <div class="col-md-12"><label class="labels">المحافظه</label><input class="form-control"
                            value="{{ $store->governorate->name }}" readonly></div> <br>
                    <div class="col-md-12"><label class="labels"> المدينه</label><input value="{{ $store->city->name }}"
                            class="form-control" readonly>

                    </div>
                    <div class="col-md-12"><label class="labels">العنوان التفصيلي</label><input class="form-control"
                            value="{{ $store->street }}" readonly>
                    </div>
                    <div class="col-md-12"><label class="labels"> رصيد الحساب</label><input class="form-control"
                            value="{{ $store->account->value }} جنيه" readonly>
                    </div>
                    <br>



                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 product-details">
                <!-- Product Details Box -->
                <div style="background: white">
                    <hr>
                    <h2>عمليات السحب </h2>
                    <table id="withdrawal-table">
                        <thead>
                            <tr>
                                <th> رقم العمليه</th>
                                <th>المبلغ</th>
                                <th>وسيله السحب</th>
                                <th> الحاله</th>
                                <th> تاريخ العمليه </th>
                                <th> مسئول السحب </th>
                                <th> الفتوره </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_withdrawal as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->method->name }}</td>
                                    <td class="badge badge-pill"
                                        style="background: @if ($item->status == 'accepted') green @elseif($item->status == 'pending') navy @else red @endif ;margin-top: 20px;color:white">
                                        @if ($item->status == 'accepted')
                                            مقبول
                                        @elseif($item->status == 'pending')
                                            انتظار
                                        @else
                                            مرفوض
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $item->mediator->name }}</td>
                                    <td>
                                        <div class="invoice-btn-section clearfix d-print-none">
                                            <a href="{{ route('admin.invoices.show', $item->id) }}"
                                                class="btn btn-lg btn-print">
                                                عرض<i class="fa fa-eye"></i>
                                            </a>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{ $all_withdrawal->links() }}
                    <br>


                </div>

            </div>
        </div>

    </div>




@endsection


@push('css')
    <style>
        h1 {
            color: #333;
            text-align: center;
        }

        .card {
            background: white;
        }

        .product-details h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #555;
            font-size: 24px;
            text-align: center;
        }

        .order-details ul {
            list-style: none;
            padding: 0;
        }

        .order-details ul li {
            margin-bottom: 10px;
            color: #666;
        }

        .product-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-details th,
        .product-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-details th {
            background-color: #f0f0f0;
            color: #333;
        }

        .product-details td {
            color: #666;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
        }

        .buttons .print-button {
            background-color: #4CAF50;
        }

        .buttons .complete-button {
            background-color: #008CBA;
        }


        h1 {
            color: #333;
            text-align: center;
        }

        .order-details {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;

        }

        .order-details h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        .order-details ul {
            list-style: none;
            padding: 0;
        }

        .order-details ul li {
            margin-bottom: 10px;
            color: #666;
            background-color: #e6e6e6;
            padding: 10px;
            border-radius: 4px;
        }

        .order-details ul li strong {
            display: inline-block;
            width: 150px;
            /* Adjust width as needed */
            font-weight: bold;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
        }

        .buttons .print-button {
            background-color: #93cf95;
        }

        .buttons .complete-button {
            background-color: #008CBA;
        }
    </style>
@endpush


@push('css')
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/admin/invoces/bootstrab.main.css') }}">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">


    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/admin/invoces/style.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/invoces/jquery.main.js') }}"></script>
    <script src="{{ asset('assets/admin/invoces/app.js') }}"></script>
@endpush
