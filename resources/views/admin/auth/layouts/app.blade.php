<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets') }}/images/logos/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/auth/css/theme.css') }}" />
    <title>@yield('title')</title>
    <link href="{{ asset('assets/noty/noty.css') }}" rel="stylesheet">

</head>

<body class="DEFAULT_THEME bg-white">

    @yield('body')

    {{-- error validation  time --}}
    <script>
        // Hide the error message after a specified duration
        window.onload = function() {
            setTimeout(function() {
                var errorAlert = document.getElementById('errorAlert');
                if (errorAlert) {
                    errorAlert.style.display = 'none';
                }
            }, {{ session('errorLifetime', 4) }} * 1000); // Default to 5 seconds
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
