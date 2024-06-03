@extends('admin.layouts.app')

@section('title', 'إعدادات السحوبات')

@push('css')
    <!-- Add any additional CSS files you may need -->
    <style>
        /* Add your custom styles here */
        .form-control {
            border-radius: 10px; /* Rounded corners */
            border-color: #ccc; /* Border color */
        }

        .form-control:focus {
            border-color: #007bff; /* Border color on focus */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Add a shadow on focus */
        }

        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff; /* Border color */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Button color on hover */
            border-color: #0056b3; /* Border color on hover */
        }

        .btn-danger {
            background-color: #dc3545; /* Danger button color */
            border-color: #dc3545; /* Border color */
        }

        .btn-danger:hover {
            background-color: #c82333; /* Button color on hover */
            border-color: #c82333; /* Border color on hover */
        }
    </style>
@endpush

@section('body')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>اعدادات السحب
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
                    <li class="breadcrumb-item active "><a href="">
                            اعدادات السحب</a></li>

                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<!-- Add form to add payment methods -->
<div class="row mt-4">
    <div class="col-md-6">
       @livewire('admin.withdrawal.add-method')
    </div>
    <div class="col-md-6">
        @livewire('admin.withdrawal.methods-table')
    </div>
</div>

<div class="row">
    @livewire('admin.withdrawal.update-withdrawal-setting')
    @livewire('admin.withdrawal.withdrawal-setting')


</div>



@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
<!-- Add any additional scripts you may need -->
@endpush
