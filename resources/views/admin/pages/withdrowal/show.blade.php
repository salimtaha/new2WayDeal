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

        <div class="container-fluid ">
            <div class="page-body ">
                <div class="row card">
                    <div class="col-md-12" style="background: white">
                        <!-- Order Details Box -->
                        <div class="order-details card" style="background: white">
                            <h2> معلومات المتجر</h2>
                            <ul>
                                <li><strong> اسم المتجر </strong> {{ $store->name }}</li>
                                <li><strong>المعرف : </strong>{{ $store->user_name }}</li>
                                <li><strong>رقم الجوال : </strong>{{ $store->phone }}</li>
                                <li><strong>البريد الالكتروني : </strong> {{ $store->email }}</li>
                                <li><strong>المحافظه : </strong> {{ $store->governorate->name }}</li>
                                <li><strong>المدينه : </strong> {{ $store->city->name }}</li>

                                <li><strong>رصيد الحساب :</strong> {{ $store->account->value }}</li>
                                <li><strong>تاريخ الانضمام :</strong> {{ $store->created_at->format('Y-m-d') }}</li>
                            </ul>

                            <div class="buttons">
                                <a href="{{ route('admin.stores.show' , $store->id) }}" class="btn btn-secondary btn-sm">عرض  <i class="fa fa-user" aria-hidden="true"></i>
                                </a>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">
                        <!-- Product Details Box -->
                        <div class="product-details" style="background: white">
                            <h2>عمليات السحب </h2>
                            <table id="withdrawal-table">
                                <thead>
                                    <tr>
                                        <th> رقم العمليه</th>
                                        <th>المبلغ</th>
                                        <th>وسيله السحب</th>
                                        <th> الحاله</th>
                                        <th> تاريخ العمليه </th>
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
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $all_withdrawal->links() }}
                            <div class="buttons">
                                <button class="btn btn-danger btn-sm" onclick="window.print()"> <i class="fa fa-print" aria-hidden="true"></i></button>

                            </div>
                            <br>
                        </div>

                    </div>
                </div>
            </div>
        </div>




@endsection


@push('css')
 <style>
    @media print {
    body * {
        visibility: hidden;
    }

    #withdrawal-table, #withdrawal-table * {
        visibility: visible;
    }

    #withdrawal-table {
        position: absolute;
        left: 0;
        top: 0;
    }
}
 </style>
    <style>

        h1 {
            color: #333;
            text-align: center;
        }

.card{
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
