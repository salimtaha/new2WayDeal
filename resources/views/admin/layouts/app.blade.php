<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Multikart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('default.jpg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('default.jpg') }}" type="image/x-icon">
    <title> @yield('title') </title>

    <!-- Google font-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,500;1,600;1,700;1,800;1,900&display=swap">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">


    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/vendors/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/vendors/flag-icon.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/vendors/icofont.css">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/vendors/prism.css">


    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin') }}/css/style.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dropify.css') }}">

    {{-- datatables  --}}
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
    <link href="{{ asset('assets/noty/noty.css') }}" rel="stylesheet">
    @livewireStyles
    @stack('css')
</head>

{{-- class="rtl dark" --}}

<body class="rtl">

    <!-- page-wrapper Start-->
    <div class="page-wrapper">

        @include('admin.layouts.header')

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            @include('admin.layouts.sidebar')

            <div class="page-body">
                @yield('body')
            </div>

           @include('admin.layouts.footer')
        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('assets/admin') }}/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets/admin') }}/js/bootstrap.bundle.min.js"></script>

    <!-- feather icon js-->
    <script src="{{ asset('assets/admin') }}/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('assets/admin') }}/js/icons/feather-icon/feather-icon.js"></script>

    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/admin') }}/js/sidebar-menu.js"></script>


    <!--counter js-->
    <script src="{{ asset('assets/admin') }}/js/counter/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets/admin') }}/js/counter/jquery.counterup.min.js"></script>
    <script src="{{ asset('assets/admin') }}/js/counter/counter-custom.js"></script>



    <!--Customizer admin-->
    <script src="{{ asset('assets/admin') }}/js/admin-customizer.js"></script>

    <!--dashboard custom js-->
    <script src="{{ asset('assets/admin') }}/js/dashboard/default.js"></script>

    <!--right sidebar js-->
    <script src="{{ asset('assets/admin') }}/js/chat-menu.js"></script>

    <!--height equal js-->
    <script src="{{ asset('assets/admin') }}/js/height-equal.js"></script>


    <!--script admin-->
    <script src="{{ asset('assets/admin') }}/js/admin-script.js"></script>
    {{-- dropify to apper image in input --}}
    <script src="{{ asset('assets/admin/js/dropify.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.dropify').dropify();
    </script>
    {{-- datatables cdn --}}
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

    {{-- select 2 tag --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    {{-- script to apper error validation to 5 second --}}
    <script>
        // Hide the error message after a specified duration
        window.onload = function() {
            setTimeout(function() {
                var errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, {{ session('errorLifetime', 5) }} * 1000); // Default to 5 seconds
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


    {{-- error validation  time --}}
    <script>
        // Hide the error message after a specified duration
        window.onload = function() {
            setTimeout(function() {
                var errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, {{ session('errorLifetime', 5) }} * 1000); // Default to 5 seconds
        };
    </script>






    <script>
        document.querySelector('div.demo-html')
            .setAttribute('dir', 'rtl'); // Demo only

        new DataTable('#example');
    </script>

    {{-- select to tag  --}}
    <script>
        $(".select").select2({
            tags: true
        });

    </script>
    @livewireScripts
    @stack('js')
</body>

</html>
