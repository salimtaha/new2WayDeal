@extends('admin.layouts.app')
@section('title', 'تفاصيل الطلب')

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="color: rgb(236, 73, 73)"> تفاصيل طلب :{{ $order->user->name ?? 'المستخدم محذوف' }}
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">المستخدمين </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">الطلبات </a>
                        </li>
                        @if ($order->user)
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('admin.users.show', $order->user->id) }}">{{ $order->user->name }}
                                </a>
                            </li>
                        @else
                        <li class="breadcrumb-item active"><a
                            href="">المستخدم محذوف
                        </a>
                    </li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <center>
        <div class="parent">
            <!-- Order Details Box -->
            <div class="order-details">
                <h2>تفاصيل الطلب !</h2>
                <ul>
                    <li><strong>الاسم:</strong> {{ $order->name }}</li>
                    <li><strong>الحاله:</strong>
                        @if ($order->status == 'paid')
                            مدفوع
                        @elseif($order->status == 'completed')
                            مستلم
                        @elseif ($order->status == 'pending')
                            انتظار
                        @elseif($order->status == 'not_recevied')
                            غير مستلم
                        @else
                            ملغي
                        @endif
                    </li>
                    <li><strong>السعر الكلي:</strong>{{ $order->total_price }}</li>
                    <li><strong>رقم الجوال:</strong>{{ $order->phone }}</li>
                    <li><strong>البريد الالكتروني:</strong> {{ $order->email }}</li>
                    <li><strong>المحافظه:</strong> {{ $order->governorate->name }}</li>
                    <li><strong>المدينه:</strong> {{ $order->city->name }}</li>

                    <li><strong>العنوان التفصيلي:</strong> {{ $order->address }}</li>
                    <li><strong>مصاريف الشحن:</strong> {{ $order->shipping_price }}</li>
                    <li><strong>الملاحظه:</strong>{{ $order->notice }}</li>
                    <li><strong>وقت انشاء :</strong> {{ $order->created_at }}</li>
                </ul>
            </div>

            <!-- Product Details Box -->
            <div class="product-details">
                <h2> عناصر الاوردر</h2>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>الكميه</th>
                            <th>سعر النوع الواحد</th>
                            <th>سعر الكميه</th>
                            <th> تاريخ الانتهاء</th>
                            <th>  عرض المنتج</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->product_quantity }}</td>
                                <td>{{ $item->product_price }} (ج)</td>
                                <td>{{ $item->product_price*$item->product_quantity }} (ج)</td>
                                <td>{{ $item->expire_date }}</td>
                                @if($item->product->id)
                                <td><a class="btn btn-info" href="{{ route('admin.products.show' , $item->product->id) }}">عرض  <i class="fa fa-eye"></i> </a>
                                </td>
                                @else
                                <td > غير متوفر
                                </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Buttons -->
            <div class="buttons">
                <a class="btn btn-danger" href="{{ route('admin.users.orders.delete', $order->id) }}"
                    style="background: rgb(143, 136, 136)"> حذف <i class="fa fa-trash" aria-hidden="true"></i> </a>
                <a href="{{ route('admin.invoices.show', $order->id) }}" class="btn btn-info btn-sm"><strong
                        style="color: rgb(255, 254, 252);font-size:16px">الفاتوره <i class="fa fa-file-text-o"
                            aria-hidden="true"></i> </strong></a>
                <br><br>
            </div>
        </div>
    </center>
@endsection


@push('css')
    <style>
        .parent {
            justify-content: center;

            width: 1100px;
            text-align: center;
            align-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* margin-right: 60px; */

        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }



        h1 {
            color: #333;
            text-align: center;
        }

        .order-details,
        .product-details {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-details h2,
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

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
