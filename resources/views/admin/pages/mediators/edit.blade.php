

@extends('admin.layouts.app')

@section('body')
<div class="container mt-5">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> تعديل بيانات مسئول السحب
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
                        <li class="breadcrumb-item"><a href="{{route('admin.mediators.index')}}"> مسئولين السحب</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.mediators.edit' , $mediator->id)}}">تعديل    </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>تعديل بيانات مسئول سحب </strong>   </div>

                <div class="card-body" style="animation: shadow-pulse 2s infinite;">
                    <form method="POST" action="{{ route('admin.mediators.update' , $mediator->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ $mediator->name }}" autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_name">المعرف</label>
                            <input id="user_name" type="text" class="form-control form-control-lg @error('user_name') is-invalid @enderror" name="user_name" value="{{ $mediator->user_name }}" autocomplete="user_name" autofocus>
                            @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">البريد الالكتروني</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $mediator->email }}" autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">كلمه المرور</label>
                            <input id="password" name="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" autocomplete="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">تاكيد كلمه المرور</label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="image">الصوره</label>
                            <input id="dropify"  data-default-file="{{ asset($mediator->image) }}" class="dropify form-control-lg" type="file" class="form-control" name="image" autocomplete="image">
                        </div>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                تحديث البيانات
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
