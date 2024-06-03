@extends('admin.layouts.app')
@section('title' , 'الملف الشخصي')

@section('body')

    <div class="container  bg-white mt-5 mb-5 shadow-lg">

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3> الملف الشخصي
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
                                    <li class="breadcrumb-item active"><a href="{{ route('admin.profile.index') }}">
                                            الملف الشخصي</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->



        <form class="row" action="{{ route('admin.profile.update') }}" method="post">
            @csrf
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span
                        class="font-weight-bold">{{ $admin->name }}</span><span
                        class="text-black-50">{{ $admin->email }}</span><span> </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">اعدادات الملف الشخصي</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">الاسم</label><input type="text" name="name"
                                class="form-control" placeholder="ادخل الاسم " value="{{ $admin->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">المعرف </label><input type="text" name="user_name"
                                class="form-control" placeholder="ادخل رقم الهاتف" value="{{ $admin->user_name }}"></div>
                        <div class="col-md-12"><label class="labels">البريد الالكتروني </label><input type="email"
                                name="email" class="form-control" placeholder="ادخل البريد الالكتروني"
                                value="{{ $admin->email }}"></div>
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
                    <div class="mt-5 text-center"><button type="submit" class="btn btn-primary profile-button"
                            type="button">حفظ التغيرات</button></div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span> متطلب !</div><br>
                    <div class="col-md-12"><label class="labels">كلمه السر القديمه (مطلوب)</label><input type="password"
                            class="form-control" placeholder="كلمه السر القديمه هنا " name="old_password"></div> <br>
                    <div class="col-md-12"><label class="labels">كلمه السر الجديده (اختياري)</label><input type="password"
                            name="password" class="form-control" placeholder="كلمه السر الجديده اذا امكن">
                        @error('password', 'pass')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12"><label class="labels">تاكيد كلمه السر الجديده (في حاله التغير)</label><input
                            type="password" name="password_confirmation" class="form-control"
                            placeholder="تاكيد كلمه السر الجديده اذا امكن"> @error('password_confirmation', 'pass')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{ $admin->id }}">
                </div>
            </div>
        </form>
    </div>


@endsection

@push('css')
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

@push('javascripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endpush
