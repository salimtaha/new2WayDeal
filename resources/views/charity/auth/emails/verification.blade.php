<!DOCTYPE html>

<html lang="en" dir="rtl" class="light-style layout-wide customizer-hide" data-theme="theme-default"
    data-assets-path="{{ asset('assets/charity/') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>التحقق من البريد</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/charity/') }}/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/charity/') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/charity/') }}/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/charity/') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/charity/') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/charity/') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/charity/') }}/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="{{ asset('assets/charity/') }}/vendor/js/helpers.js"></script>
    <script src="{{ asset('assets/charity/') }}/js/config.js"></script>
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
                            <a class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/charity/') }}/img/favicon/favicon.png" alt="" />
                                </span>
                                <span class="app-brand-text demo text-body fw-bold">2WayDeal</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">تحقق من بريدك الالكتروني</h4>

                        <form id="formAuthentication" class="mb-3" action="{{ route('charities.email.check') }}" method="post">
                            @csrf
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


                            <!-- Add these elements inside the form -->
                            <div class="mb-3">
                                <label for="verificationCode" class="form-label">رمز التحقق
                                </label>
                                <input type="text" class="form-control" id="verificationCode" name="otp"
                                    placeholder="إدخـل رمز التحقق" />
                            </div>


                            <input type="hidden" class="form-control" name="email" value="{{ $request->email }}"/>


                            <div class="bm-3" style="display: flex">
                                <button type="submit" class="btn btn-primary d-grid w-40" id="verifyEmailBtn">
                                    التحقق من البريد
                                </button><br>
                                <a style="margin-right: 60px" class="btn btn-info d-grid w-40" href="{{ route('charities.email.tryagain' , $request->email) }}" >اعاده ارسال الرمز</a>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>ليس حسابك؟ </span>
                            <a href="{{ route('charities.showRegister') }}">
                                <span>سجل مرة أخرى </span>
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

    <script src="{{ asset('assets/charity/') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('assets/charity/') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('assets/charity/') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('assets/charity/') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('assets/charity/') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/charity/') }}/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async src="https://buttons.github.io/buttons.js"></script>

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
