@extends('admin.layouts.app')
@section('title' , 'عرض الفاتوره')
@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="color: rgb(236, 73, 73)"> عرض الفاتوره
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.invoices.index') }}"> الفواتير </a>
                        </li>
                        <li class="breadcrumb-item active"><a href=""> عرض الفاتوره</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->


<!-- Invoice 6 start -->
<div class="invoice-6 invoice-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="invoice-inner clearfix">
                    <div class="invoice-info clearfix" id="invoice_wrapper">
                        <div class="invoice-headar">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="invoice-logo">
                                        <!-- logo started -->
                                        <div class="logo">
                                            <img width="200px" height="60px" src="{{ asset('login.png') }}" alt="logo">
                                        </div>
                                        <!-- logo ended -->
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="invoice-contact-us">
                                        <h1>تواصل معنا</h1>
                                        <ul class="link">
                                            <li>
                                                <i class="fa fa-map-marker"></i> {{ $setting->address?? 'مصر البحيره ابوحمص' }}
                                            </li>
                                            <li>
                                                <i class="fa fa-envelope"></i> <a href="mailto:sales@hotelempire.com">{{ $setting->support_email }}</a>
                                            </li><br>
                                            <li>
                                                <i class="fa fa-phone"></i> <a href="tel:{{ $setting->phone[0] }}">{{ $setting->phone[0] }} </a>
                                            </li>
                                            <li>
                                                <i class="fa fa-phone"></i> <a href="tel:{{ $setting->phone[1] }}">{{ $setting->phone[1] }} </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-contant">
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h1 class="invoice-name">الفاتوره</h1>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="invoice-number-inner">
                                            <h2 class="name"> رقم الفاتوره : #1000{{ $invoice->id }}</h2>
                                            <h2 class="name"> رقم الاوردر : #1000{{ $invoice->order->id }}</h2>

                                            <h2 class="name">  حاله الفاتوره : {{ $invoice->status =="paid"? 'مدفوعه' :'غير مدفوعه' }}</h2>

                                            <p class="mb-0">تاريخ الفتوره: <span>{{ $invoice->created_at->format('Y-m-d h:m') }}</span></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="invoice-number">
                                            <h4 class="inv-title-1"> بيانات العميل</h4>
                                            <h2 class="name mb-10">{{ $invoice->order->user->name ?? 'المستخدم محذوف'}}</h2>
                                            <p class="invo-addr-1 mb-0">
                                                  <br/>
                                                  البريد : {{$invoice->order->user->email ?? 'المستخدم محذوف'  }} <br/>
                                                   الجوال : {{$invoice->order->user->phone ?? 'المستخدم محذوف' }} <br/>
                                                 العنوان :  {{ $invoice->order->user->governorate->name ?? 'المستخدم محذوف'}}, {{ $invoice->order->user->city->name ?? 'المستخدم محذوف'}}, {{ $invoice->order->user->address ?? 'المستخدم محذوف'}} <br/>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="invoice-number">
                                            <div class="invoice-number-inner">
                                                <h4 class="inv-title-1">بيانات الشحن </h4>
                                                <h2 class="name mb-10">{{ $invoice->order->name }}</h2>
                                                <p class="invo-addr-1 mb-0">

                                                    البريد :  {{  $invoice->order->email }} <br/>
                                                    الجوال :  {{  $invoice->order->phone}} <br/>
                                                   العنوان :  {{ $invoice->order->governorate->name }}, {{ $invoice->order->city->name }}, {{ $invoice->order->address }} <br/>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="order-summary">
                                    <div class="table-outer">
                                        <table class="default-table invoice-table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم المنتج</th>
                                                <th> السعر</th>
                                                <th>الكميه</th>
                                                <th>تاريخ الانتهاء</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($invoice->order->orderDetails as $item )
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ $item->product_price }}</td>
                                                    <td>{{ $item->product_quantity }}</td>
                                                    <td>{{ $item->expire_date }}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7">
                                        <div class="terms-conditions mb-30">
                                            <h3 class="inv-title-1 mb-10">القيود & والشروط</h3>
                                            هذه البيانات هي مسؤولية العميل في تقديم معلومات صحيحة ودقيقة.

                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <div class="payment-method mb-30">
                                            <h3 class="inv-title-1 mb-10">الدفع الالكتروني</h3>
                                            <ul class="payment-method-list-1 text-14">
                                                <li><strong>وسيله الدفع :</strong> {{$invoice->order->payment_method  }}</li>
                                                <li><strong> مصاريف الشحن :</strong> {{round($invoice->order->shipping_price) }} </li>
                                                <li><strong>المبلغ الاجمالي :</strong>{{round($invoice->order->total_price)  }} </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            طباعه الفاتوره<i class="fa fa-print"></i>
                        </a>
                        <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                            تحميل الفاتوره PDF  <i class="fa fa-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Invoice 6 end -->

@push('css')
<link type="text/css" rel="stylesheet" href="{{ asset('assets/admin/invoces/bootstrab.main.css') }}">
<link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

<!-- Favicon icon -->
<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" >

<!-- Google fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Custom Stylesheet -->
<link type="text/css" rel="stylesheet" href="{{ asset('assets/admin/invoces/style.css') }}">
@endpush

@push('js')
<script src="{{ asset('assets/admin/invoces/jquery.main.js') }}"></script>
<script src="{{ asset('assets/admin/invoces/jspdf.main.js') }}"></script>
<script src="{{ asset('assets/admin/invoces/app.js') }}"></script>
@endpush


@endsection

