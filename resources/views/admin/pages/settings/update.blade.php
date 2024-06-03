@extends('admin.layouts.app')
@section('title', 'الاعدادات')
@section('body')
    <div class="page-body">
      <!-- Container-fluid starts-->
      <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>   الاعدادات
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
                        <li class="breadcrumb-item "><a href="">
                            الاعدادات </a></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row product-adding ">
                <div class="col-xl-12">
                    <div class="card product-details">

                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <form action="{{ route('admin.settings.update', $setting->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')

                                    @if ($errors->any())
                                        <div class=" rounded bg-red-800 mt-5 mb-5 -lg" id="errorAlert">
                                            <ul style="background-color: rgb(191, 159, 159);color:wheat">
                                                @foreach ($errors->all() as $error)
                                                    <li style="padding-right: 15px;color:white"> * {{ $error }}</li>
                                                    <br>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="validationCustom05" class="col-form-label pt-0">
                                            لوجو الموقع</label>
                                        <input class="image size  form-control dropify"
                                            data-default-file="{{ asset($setting->logo) }}" id="validationCustom05"
                                            type="file" name="logo">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">الصورة المصغرة</label>
                                        <input class="image size  form-control dropify"
                                            data-default-file="{{ asset($setting->favicon) }}" id="validationCustom05"
                                            type="file" name="favicon">
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    اسم الموقع</label>
                                                <input class="size  form-control" id="validationCustom01" type="text"
                                                    name="title" value="{{ $setting->title }}">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom02" class="col-form-label"><span>*</span>
                                                    حقوق النشر </label>
                                                <input class="size  form-control" id="validationCustom02" type="text"
                                                    name="copyright" value="{{ $setting->copyright }}">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">وصف الموقع</label>
                                        <textarea class="textarea  area" rows="5" cols="12" name="description">{{ $setting->description }}</textarea>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>
                                                    بريد الدعم المالي </label>
                                                <input class="size  form-control" id="validationCustom01" type="text"
                                                    name="withdrawal_email" value="{{ $setting->withdrawal_email }}">
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="validationCustom02" class="col-form-label"><span>*</span>
                                                    بريد المشاكل الفنيه </label>
                                                <input class="size  form-control" id="validationCustom02" type="text"
                                                    name="support_email" value="{{ $setting->support_email }}">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="validationCustom02" class="col-form-label"><span>*</span>
                                                    بريد الاستفسارات </label>
                                                <input class="size  form-control" id="validationCustom02" type="text"
                                                    name="info_email" value="{{ $setting->info_email }}">

                                            </div>
                                        </div>
                                    </div>




                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0"> رقم الهاتف
                                                    الاول</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="phone[]" value="{{ $setting->phone[0] }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">رقم الهاتف
                                                    الثاني</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="phone[]" value="{{ $setting->phone[1] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">رابط الفيس
                                                    بوك</label>
                                                <input class="size  form-control" id="validationCustomtitle"
                                                    type="text" name="facebook" value="{{ $setting->facebook }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">رابط
                                                    تويتر</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="twitter" value="{{ $setting->twitter }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">حساب
                                                    الانستجرام</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="instagram" value="{{ $setting->instagram }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">
                                                    اليوتيوب</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="youtupe" value="{{ $setting->youtupe }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">رابط الفيس
                                                    بوك</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="facebook" value="{{ $setting->facebook }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="validationCustomtitle" class="col-form-label pt-0">التيك
                                                    توك</label>
                                                <input class="size form-control" id="validationCustomtitle"
                                                    type="text" name="tiktok" value="{{ $setting->tiktok }}">
                                            </div>
                                        </div>
                                    </div>







                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">حفظ</button>
                                    </div>


                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection

@push('css')
    <style>
        /* .shadow {
 box-shadow: 0 1px 1px rgba(74, 237, 199, 0.1);

         } */
         .size{
            background: rgb(250, 250, 250);
            height: 50px;
        }
        /* .textarea{
            background: rgb(220, 208, 208);
            height: 60px;
        } */

    </style>

@endpush
@push('css')
    <style>
        .parent {
            width: 100%;
            text-align: center;
            align-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* margin-right: 60px; */

        }

        /* body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        } */



        h1 {
            color: #333;
            text-align: center;
        }

        .order-details,
        .product-details {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
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
