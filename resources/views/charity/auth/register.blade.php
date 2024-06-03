<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="rtl" data-theme="theme-default"
    data-assets-path="{{ asset('assets/charity') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>انشاء حساب</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/charity') }}/img/favicon/favicon.png" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ asset('assets/charity') }}/vendor/js/helpers.js"></script>
   <script src="{{ asset('assets/charity') }}/js/config.js"></script>
    @livewireStyles()
</head>

<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/charity') }}/img/favicon/favicon.png" alt="" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bold">2WayDeal</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">الأمل يبدأ هنا 🚀</h4>

                        <form action="{{ route('charities.register.store') }}" method="post" id="formAuthentication" enctype="multipart/form-data"
                            class="mb-3" action="email-verification.html">
                            @csrf
                            @if($errors->any())
                                <div class="mb-3" id="errorAlert">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error )
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="username" class="form-label">أسم المؤسسه</label>
                                <input type="text" class="form-control" id="username" name="name" value="{{ old('name') }}"
                                    placeholder="الاسم هنا" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">البريـد الإلكتروني</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                    placeholder="البريد هنا" />
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">رقـم الهـاتف</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="الجوال هنا" />
                            </div>


                            @livewire('charity.register.register-select')


                            <div class="mb-3">
                                <label for="healthCertificate" class="form-label">الشهـادة الصحيـة</label>
                                <input type="file" class="form-control" id="healthertificate"
                                    name="health_certificate" />
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">الوصــف</label>
                                <textarea class="form-control" id="description" value="{{ old('description') }}" name="description" rows="3" placeholder="نبذه عن المؤسسه"></textarea>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">الرقـم السـري</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password_confirmation">تأكيد الرقم السري</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control"
                                        name="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password_confirmation" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        أنا أوافق علي
                                        <a href="javascript:void(0);">سياسة الخصوصية والشروط </a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" title="btn"
                                class="btn btn-primary d-grid w-100">اشتراك</button>
                        </form>
                        <p class="text-center">
                            <span>هل لديك حساب؟ </span>
                            <a href="{{ route('charities.showLogin') }}">
                                <span>تسجيل الدخول بدلا من ذلك</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
    <!-- / Content -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/charity') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <!-- Main JS -->
    <script src="{{ asset('assets/charity') }}/js/main.js"></script>
    <!-- Page JS -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    @livewireScripts()


    {{-- error validation  time --}}
    <script>
        // Hide the error message after a specified duration
        window.onload = function() {
            setTimeout(function() {
                var errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, {{ session('errorLifetime', 10) }} * 1000); // Default to 5 seconds
        };
    </script>
</body>

</html>
