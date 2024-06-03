<!DOCTYPE html>
<html   lang="en"   class="light-style layout-wide customizer-hide" dir="rtl" data-theme="theme-default" data-assets-path="{{ asset('assets/charity/')}}" data-template="vertical-menu-template-free">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waiting Admin Approval</title>
  <meta name="description" content="">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/charity/')}}img/favicon/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/charity/')}}vendor/fonts/boxicons.css">
  <link rel="stylesheet" href="{{ asset('assets/charity/')}}vendor/css/core.css" class="template-customizer-core-css">
  <link rel="stylesheet" href="{{ asset('assets/charity/')}}vendor/css/theme-default.css" class="template-customizer-theme-css">
  <link rel="stylesheet" href="{{ asset('assets/charity/')}}css/demo.css">
  <link rel="stylesheet" href="{{ asset('assets/charity/')}}vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="{{ asset('assets/charity/')}}vendor/css/pages/page-auth.css">
  <script src="{{ asset('assets/charity/')}}vendor/js/helpers.js"></script>
  <script src="{{ asset('assets/charity/')}}js/config.js"></script>
  <link href="{{ asset('assets/noty/noty.css') }}" rel="stylesheet">

  <style>
    body {
      font-family: 'Public Sans', sans-serif;
      background-color: #f8f9fa;
      text-align: center;
    }
    .container-xxl {
      margin-top: 50px;
      text-align: center;
    }
    .message {
      font-size: 24px;
      margin-bottom: 20px;
    }
    .image {
      max-width: 100%;
      height: auto;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
              <img src="{{ asset('assets/charity/')}}img/favicon/favicon.png" alt="">
                </span>
                <span class="app-brand-text demo text-body fw-bold">2WayDeal</span>
              </a>
            </div>
            <div class="container">
                <div class="message">انتظر الموافقه من الادمن , جاي فحص بياناتك...</div>
                <div class="message"><a href="{{ route('charities.profile.index') }}" class="btn btn-primary">فحص الطلب</a></div>
                <img class="image" src="https://cdn-icons-png.flaticon.com/512/3858/3858433.png" alt="Administrator Approval" width="200" height="200">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
</body>
</html>
