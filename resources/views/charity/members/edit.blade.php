@extends('charity.layouts.app')
@section('title' , 'تعديل العضو')

@section('body')
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
     <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('charities.members.index') }}">الاعضاء </a>/</span>  تعديل العضو</h4>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
      <!-- HTML5 Inputs -->
      <div class="container " style="width:80%;align-items: center;" >
      <form action="{{ route('charities.members.update') }}"  method="post">
        @csrf
        @method('PUT')
        <div class="card mb-12">
            <h5 class="card-header">تعديل بيانات العضو</h5>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <div class="mb-3 row">
                <label for="html5-text-input" class="col-md-2 col-form-label">الاسم</label>
                <div class="col-md-10">
                  <input class="form-control" name="name" type="text" value="{{ $member->name }}" id="html5-text-input" />

                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-search-input" class="col-md-2 col-form-label">رقم الجوال</label>
                <div class="col-md-10">
                  <input class="form-control" name="phone" type="search" value="{{ $member->phone }}" i d="html5-search-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-email-input" class="col-md-2 col-form-label">البريد لالكتروني</label>
                <div class="col-md-10">
                  <input class="form-control" name="email"  type="email" value="{{ $member->email }}" id="html5-email-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-email-input" class="col-md-2 col-form-label">المستوى </label>
                <div class="col-md-10">
                    <select class="form-control" name="living_standard" id="html5-email-input" >
                        <option value="medium" selected>المستوي الاجتماعي للعضو </option>
                        <option value="medium" @selected($member->living_standard=="medium")>متوسط الحال</option>
                        <option value="low"  @selected($member->living_standard=="low")>ميئوس الحال </option>
                    </select>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-email-input" class="col-md-2 col-form-label">العنوان التفصيلي </label>
                <div class="col-md-10">
                  <input class="form-control" name="address"  type="text" value="{{ $member->address }}" id="html5-email-input" />
                </div>
              </div>
              <div class="mb-3 row">
                <label for="html5-email-input" class="col-md-2 col-form-label">المحافظه  </label>
                <div class="col-md-4">
                    <input class="form-control"   type="text" readonly value="{{ $member->governorate->name }}" id="html5-email-input" />
                  </div>
                  <label for="html5-email-input" class="col-md-2 col-form-label">المدينه  </label>

                  <div class="col-md-4">
                    <input class="form-control"   type="text" readonly value="{{ $member->city->name }}" id="html5-email-input" />
                  </div>
              </div>
            @livewire('charity.register.register-select')

            <div class="mb-3 row">
                <input type="hidden" name="id" value="{{ $member->id }}">
                <div class="col-md-10">
                   <button type="submit" class="btn btn-success">تحديث البيانات</button>
                </div>
              </div>
            </div>
          </div>
      </form>
@endsection
