<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="rtl" data-theme="theme-default"
    data-assets-path="{{ asset('assets/charity') }}/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/charity') }}/img/favicon/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/charity/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/css/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/charity') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/charity') }}/vendor/js/helpers.js"></script>
    <script src="{{ asset('assets/charity') }}/js/config.js"></script>
    {{-- noty --}}
    <link href="{{ asset('assets/noty/noty.css') }}" rel="stylesheet">
    {{-- datatables --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    @stack('css')

    @livewireStyles()
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('charity.layouts.sidebar')

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('charity.layouts.nav')
                <!-- Content wrapper -->
                @yield('body')

                @include('charity.layouts.footer')
            </div>
        </div>


    </div>

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
    <script src="{{ asset('assets/charity') }}/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    {{-- datatables --}}
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

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


    {{-- flash message --}}
    <script src="{{ asset('assets/noty/noty.min.js') }}"></script>
    </script>
    @if (session('success'))
        <script>
            new Noty({
                type: 'success',
                layout: 'topCenter',
                text: "{{ session('success') }}",
                timeout: 4000,
                killer: true
            }).show();
        </script>
    @endif
    @if (session('failed'))
        <script>
            new Noty({
                type: 'error',
                layout: 'topCenter',
                text: "{{ session('failed') }}",
                timeout: 4000,
                killer: true
            }).show();
        </script>
    @endif


    @stack('js')
</body>

</html>
