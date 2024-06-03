@extends('admin.layouts.app')

@section('title', 'عرض المستخدم')
@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> بيانات المستخدم
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}"> المستخدمين
                            </a></li>
                        <li class="breadcrumb-item active"><a href="">
                                {{ $user->name }} </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="card mt-4 shadow rtl">
        <form class="row" action="{{ route('admin.profile.update') }}" method="post">
            @csrf
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="badge badge-pill {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        @if ($user->status == 'active')
                            نشط
                        @else
                            غير نشط
                        @endif
                    </span><br>
                    <span class="font-weight-bold">{{ $user->name }}</span><span
                        class="text-black-50">{{ $user->email }}</span><br>


                    <span class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            العمليات
                        </button>
                        <div class="dropdown-menu ">
                            <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item" data-bs-toggle="modal"
                                data-original-title="test" data-bs-target="#deletemodal{{ $user->id }}"> الحذف <i
                                    class="fa fa-trash"></i></a>
                            <div class="dropdown-divider"></div>
                            @if ($user->status == 'active')
                                <a class="dropdown-item " href="{{ route('admin.users.blocked.block', $user->id) }}">تقيد
                                    الحساب <i class="fa fa-stop"></i></a>
                            @else
                                <a class="dropdown-item" href="{{ route('admin.users.blocked.retrieve', $user->id) }}">فك
                                    تقيد الحساب <i class="fa fa-undo" aria-hidden="true"></i></i></a>
                            @endif
                        </div>

                    </span>
                </div>

            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">بيانات الملف الشخصي</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">الاسم</label><input type="text"
                                class="form-control"readonly value="{{ $user->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">رقم الجوال </label><input type="text"
                                name="user_name" class="form-control" readonly value="{{ $user->phone }}"></div>
                        <div class="col-md-12"><label class="labels">البريد الالكتروني </label><input type="email"
                                readonly class="form-control" value="{{ $user->email }}"></div>
                    </div>
                    @if ($errors->any())
                        <div class=" rounded bg-red-800 mt-5 mb-5 shadow-lg" id="errorAlert">
                            <ul style="background-color: rgb(255, 102, 102);color:wheat">
                                @foreach ($errors->all() as $error)
                                    <li style="padding-right: 15px"> * {{ $error }}</li><br>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span
                            style="color: @if ($user->status == 'active') green @else red @endif ;margin-right: 20px">{{ $user->status == 'active' ? 'الحساب نشط' : ' غير نشط' }}</span>
                    </div><br>
                    <div class="col-md-12"><label class="labels">المحافظه</label><input class="form-control"
                            value="{{ $user->governorate->name }}" readonly></div> <br>
                    <div class="col-md-12"><label class="labels"> المدينه</label><input value="{{ $user->city->name }}"
                            class="form-control" readonly>

                    </div>
                    <div class="col-md-12"><label class="labels">عدد الطلبات</label><input name="password_confirmation"
                            class="form-control" value="{{ $user->orders->count() }}" readonly>

                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                </div>
            </div>
        </form>

    </div>




    {{-- delete --}}
    <div class="modal fade" id="deletemodal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.users.delete') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <p>متأكد من الحذف .. ؟؟</p>
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="id" id="id">
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

    <!-- User Orders Table -->
    <div class="card mt-4 shadow rtl">
        <div class="card-body">
            <center>
                <h5 class="card-title rtl">*طلبات المستخدم*</h5>
            </center><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>رقم الاوردر</th>
                        <th>تاريخ الاوردر</th>
                        <th>السعر الكلي</th>
                        <th> حاله الطلب</th>
                        <th> عدد المنتجات</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $orders = $user->orders()->paginate(4);
                    @endphp
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->orderDetails->count() }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        العمليات
                                    </button>
                                    <div class="dropdown-menu ">
                                        <a class="dropdown-item btn-sm"
                                            href="{{ route('admin.users.orders.detail', $order->id) }}"> تفاصيل الطلب <i
                                                class="fa fa-list"></i></a>
                                        <a class="dropdown-item btn-sm" href="{{ route('admin.invoices.show' ,$order->id) }}" style="color:black;">عرض الفاتوره<i
                                                class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="6">
                                <center class="text-info"> لا يوجد اوردرات لهذا المستخدم بعد ...</center>
                            </td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>

    </div>

@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
@endpush
