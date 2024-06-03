@extends('charity.layouts.app')
@section('title' , 'الملف الشخصي')

@section('body')

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">الحساب</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">تفـاصيل الحســاب الشخصـي</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset($charity->image) }}"
                            alt="user-avatar" class="img-thumbnail  img-fluid rounded" style="width: 150px;height:150px" id="uploadedAvatar" />
                            <form action="{{ route('charities.profile.updateImage') }}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4"
                                        tabindex="0">
                                        <span class="d-none d-sm-block">تحميـل صورة جديده</span>

                                        <input type="file" id="upload" name="image" class="account-file-input"
                                            hidden  />
                                    </label>
                                    <button type="submit"
                                        class="btn btn-outline-secondary  mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">إعـادة ضبط</span>
                                    </button>

                                    <p class="text-muted mb-0">
                                        مسموح بـ JPG أو GIF أو PNG. الحجم الأقصى 800
                                        كيلوبايت
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <id class="card-body">
                        <form id="formAccountSettings" action="{{ route('charities.profile.update') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               @if($errors->any())
                               <div class="mb-3 col-md-12 alert-danger" id="errorAlert">
                                <ul>
                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }} ☹</li>

                                    @endforeach
                                </ul>
                               </div>
                               @endif

                                <div class="mb-3 col-md-6">
                                    <label for="charityName" class="form-label">أسم المؤسســه</label>
                                    <input class="form-control" type="text" id="charityName"
                                        name="name" value="{{ $charity->name }}" autofocus />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">البريد الألكتروني</label>
                                    <input class="form-control" type="text" id="email"
                                        name="email"  value="{{ $charity->email }}"
                                        placeholder="someone@example.com" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">رقــم الهـاتف</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phone" name="phone" value="{{ $charity->phone }}"
                                            class="form-control" placeholder="❤" />
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">العنــوان</label>
                                    <input type="text" class="form-control" id="address" value="{{ $charity->address }}"
                                        name="address" placeholder="العنوان التفصيلي " />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">المحافظه : {{ $charity->governorate->name }} ✔</label>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">المدينه : {{ $charity->city->name }} ✔</label>
                                </div>

                                 @livewire('charity.register.register-select')

                                 <div class="mb-3 col-md-12">
                                    <label for="address" class="form-label">عن المؤسسه</label>
                                    <textarea type="text" class="form-control" id="address"
                                        name="description" placeholder="العنوان التفصيلي " >{{ $charity->description }}
                                       </textarea>
                                </div>
                                {{-- <div class="mb-3 col-md-6">
                                    <label for="healthCertificate" class="form-label">الشهــادة
                                        الصحيــة</label>
                                    <input type="file" class="form-control" id="health_certificate"
                                        name="health_certificate"   accept=".pdf, .doc, .docx"/>
                                    <!-- Optionally add a placeholder or helper text for the file format requirements -->
                                    <div id="healthCertificateHelp" class="form-text">
                                        تحميل الشهــادة الصحيــة (PDF, DOC, DOCX).
                                    </div>
                                </div> --}}

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">
                                        حفظ التغييرات
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary">
                                        إلغــاء
                                    </button>
                                </div>
                            </div>
                        </form>
                    </id>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
 <!-- / Content -->

</div>


@endsection
