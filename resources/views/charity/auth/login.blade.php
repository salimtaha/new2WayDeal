<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="rtl" data-theme="theme-default"
    data-assets-path="{{ asset('assets/charity') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>تسجيل الدخول</title>

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
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/charity') }}/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/charity') }}/img/favicon/favicon.png" alt="" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bold">2WayDeal</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">مرحبــاَ ب 2WayDeal 👋</h4>
                        <p class="mb-4">
                            سجل للاستمتاع بالمزايا الخاصه بنا
                        </p>

                        <form id="formAuthentication" class="mb-3" action="{{ route('charities.login.check') }}"
                            method="post">
                            @csrf
                            @if (session('successResetPassword'))
                                <div class="mb-3" id="errorAlert">
                                    <div class="alert alert-success">
                                        {{ session('successResetPassword') }}
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="email" class="form-label"> البريد الإلكتروني</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="ادخل البريد الالكتروني" autofocus />
                            </div>
                            @if ($errors->any())
                                <div class="mb-3" id="errorAlert">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">كلمة السـر</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <a href="{{ route('charities.password.forget') }}">
                                    <small>هـل نسيت كلمة السـر ؟</small>
                                </a>
                            </div>
                            <div class="mb-3" style="margin-right: 20px">
                                {!! NoCaptcha::display() !!}
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember"
                                        name="remember" />
                                    <label class="form-check-label" for="remember">
                                        تذكرنـي
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    تسجيــل الدخـول
                                </button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>جديد على منصتنا؟ </span>
                            <a href="{{ route('charities.showRegister') }}">
                                <span>إنشاء حساب </span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    {!! NoCaptcha::renderJs() !!}

    <script src="{{ asset('assets/charity') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets/charity') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->
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
    <!-- Main JS -->
    <script src="{{ asset('assets/charity') }}/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
