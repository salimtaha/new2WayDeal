@extends('admin.layouts.app')

@section('title', 'عرض المتجر')
@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="color: rgb(236, 73, 73)"> عرض : {{ $store->name }}
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.stores.index') }}">المتاجر </a>
                        </li>
                        <li class="breadcrumb-item active"><a href=""> : {{ $store->name }} </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xxl-3 col-md-6 xl-50">
            <div class="card o-hidden widget-cards">
                <div class="primary-box card-body">
                    <div class="media static-top-widget align-items-center">
                        <div class="icons-widgets">
                            <div class="align-self-center text-center">
                                <i data-feather="shopping-cart" class="font-warning"></i>
                            </div>
                        </div>
                        <div class="media-body media-doller"> <span class="m-0">عدد المنتجات </span>

                            <h3 class="mb-0"> <span class="counter">{{ $store->products->count() }}</span><small>
                                    المنتجات الحاليه الخاصه بالمتجر
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-3 col-md-6 xl-50">
            <div class="card o-hidden widget-cards">
                <div class="secondary-box card-body">
                    <div class="media static-top-widget align-items-center">
                        <div class="icons-widgets">
                            <div class="align-self-center text-center">
                                <i data-feather="archive" class="font-secondary"></i>
                            </div>
                        </div>
                        <div class="media-body media-doller">
                            <span class="m-0">التبرعات</span>
                            <h3 class="mb-0"> <span class="counter">{{ $store->donations->count() }}</span><small>
                                    عدد تبرعات المتجر
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- User Orders Table -->
    <div class="card mt-4 shadow rtl">
        <div class="card-body" style="background: #fff">
            <center>
                <h5 class="card-title rtl">*مرفقات المتجر*</h5>
            </center><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>صوره المتجر</th>
                        <th>وثيقة الترخيص </th>
                        <th>وثيقه الصحه</th>
                    </tr>
                    <tr>
                        <th> <a href="{{ asset($store->image) }}" download="image" class="btn btn-air-danger ">
                                تحميل <i class="fa fa-download" aria-hidden="true"></i>
                            </a></th>
                        <th> <a href="{{ asset($store->commercial_resturant_license) }}" download="image"
                                class="btn btn-air-danger ">تحميل <i class="fa fa-download" aria-hidden="true"> </a></th>
                        <th> <a href="{{ asset($store->health_approval_certificate) }}" download="image"
                                class="btn btn-air-danger ">تحميل <i class="fa fa-download" aria-hidden="true"> </a></th>
                    </tr>
                </thead>
                <tbody>



                    <tr>

                        <td><img width="300px" src="{{ asset($store->image) }}"class="img-thumbnail img-fluid"></td>
                        <td><img width="300px"
                                src="{{ asset($store->commercial_resturant_license) }}"class="img-thumbnail img-fluid">
                        </td>
                        <td><img width="300px"
                                src="{{ asset($store->health_approval_certificate) }}"class="img-thumbnail img-fluid">
                        </td>


                    </tr>


                </tbody>
            </table>
        </div>
    </div>



    <!--  Store data table -->
    <div class="card table mt-4 shadow">
        <div class="card-body " style="background: rgb(248, 248, 248)">
            <center>
                <h5 class="card-title rtl">*بيانات المتجر*</h5>
            </center><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>الاسم : </th>
                        <th></th>
                        <td>{{ $store->name }}</td>
                        <th><i class="fa fa-user"></i></th>

                    </tr>
                    <tr>
                        <th> البريد الالكتروني : </th>
                        <th></th>
                        <td>{{ $store->email }}</td>
                        <th><i class="fa fa-envelope-open" aria-hidden="true"></i></th>

                    </tr>
                    <tr>
                        <th>رقم الجوال : </th>
                        <th></th>
                        <td>{{ $store->phone }}</td>
                        <th><i class="fa fa-phone"></i></th>
                    </tr>
                    <tr>
                        <th>رصيد الحساب : </th>
                        <th></th>
                        <td>{{ $store->account->value }}</td>
                        <td><i class="fa fa-money" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <th>التقييم : </th>
                        <th></th>
                        <td>
                            <i class="fa @if ($store->rate >= 1) fa-star @else fa-star-o @endif"
                                aria-hidden="true"></i>
                            <i class="fa @if ($store->rate >= 2) fa-star @else fa-star-o @endif"
                                aria-hidden="true"></i>
                            <i class="fa @if ($store->rate >= 3) fa-star @else fa-star-o @endif"
                                aria-hidden="true"></i>
                            <i class="fa @if ($store->rate >= 4) fa-star @else fa-star-o @endif"
                                aria-hidden="true"></i>
                            <i class="fa @if ($store->rate >= 5) fa-star @else fa-star-o @endif"
                                aria-hidden="true"></i>




                        </td>
                        <th><i class="fa fa-user"></i></th>
                    </tr>
                    <tr>
                        <th>العنوان : </th>
                        <th></th>
                        <td>{{ $store->street }}</td>
                        <th><i class="fa fa-home" aria-hidden="true"></i></th>
                    </tr>
                    <tr>
                        <th>المحافظه : </th>
                        <th></th>
                        <td>{{ $store->governorate->name }}</td>
                        <th><i class="fa fa-map-marker"></i></th>

                    </tr>
                    <tr>
                        <th>المدينه : </th>
                        <th></th>
                        <td>{{ $store->city->name }}</td>
                        <th><i class="fa fa-map-marker"></i></th>

                    </tr>
                    <tr>
                        <th>الحاله : </th>
                        <th></th>
                        <td><strong class="badge badge-pill"
                                style="background-color:@if ($store->status == 'pending') red @elseif($store->status == 'approved')blue @else red @endif">
                                @if ($store->status == 'pending')
                                    انتظار الموافقه
                                @elseif($store->status == 'blocked')
                                    محظور
                                @elseif($store->status == 'approved')
                                    موثق
                                @endif
                            </strong>
                            @if ($store->deleted_at != null)
                                <strong class="badge badge-pill" style="background-color:red">
                                    في الارشيف
                                </strong>
                            @endif
                        </td>
                        <th><i class="fa fa-info-circle"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>العمليات :</strong></td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    العمليات
                                </button>
                                <div class="dropdown-menu ">


                                    @if ($store->status == 'pending')
                                        <a class="dropdown-item btn-secondry"
                                            href="{{ route('admin.stores.accept', $store->id) }}">قبول المتجر <i
                                                class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                    @elseif($store->status == 'blocked')
                                        <a class="dropdown-item" href="{{ route('admin.stores.active', $store->id) }}">فك
                                            تقيد الحساب <i class="fa fa-unlock" aria-hidden="true"></i></a>
                                    @elseif ($store->status == 'approved')
                                        <a class="dropdown-item " href="{{ route('admin.stores.block', $store->id) }}">
                                            تقييد الحساب <i class="fa fa-lock" aria-hidden="true"></i></a>
                                    @endif
                                    @if ($store->status == "approved")
                                        <a class="dropdown-item " href="{{ route('admin.stores.alerts.show' , $store->id) }}">اخطار المتجر<i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
                                    @endif

                                    @if ($store->deleted_at != null)
                                        <a class="dropdown-item "
                                            href="{{ Route('admin.stores.restore', $store->id) }}">استرجاع <i
                                                class="fa fa-undo" aria-hidden="true"></i></a>
                                        <a class="dropdown-item "
                                            href="{{ Route('admin.stores.forcedelete', $store->id) }}">حذف نهائي <i
                                                class="fa fa-trash"></i></a>
                                    @else
                                        <a id="deleteBtn" class="dropdown-item" data-bs-toggle="modal"
                                            data-original-title="test" data-bs-target="#deletemodal"> الحذف <i
                                                class="fa fa-trash"></i></a>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <th><i class="fa fa-info-circle"></i></th>



                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    {{-- store products --}}
    @livewire('admin.store.show-product', ['store' => $store])

    {{-- store donations --}}
    @livewire('admin.store.show-donation', ['store' => $store])



    {{-- delete --}}
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.stores.destroy') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <p>متأكد من حذف :{{ $store->name }} ؟؟</p>
                            @csrf
                            <input type="hidden" name="id" value="{{ $store->id }}">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-danger">حذف </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- delete --}}



@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@endpush

@push('css')
    <style>
        .table {
            font-family: Arial, sans-serif;
            background-color: #fff;
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
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }







        .buttons .print-button {
            background-color: #4CAF50;
        }

        .buttons .complete-button {
            background-color: #008CBA;
        }

        .container {
            max-width: 100%;
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
