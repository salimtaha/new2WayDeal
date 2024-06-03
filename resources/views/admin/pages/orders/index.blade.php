@extends('admin.layouts.app')
@section('title', 'الطلبات')

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="color: rgb(236, 73, 73)"> الطلبات
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
                        <li class="breadcrumb-item active"><a href=""> الطلبات </a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <form class="form-inline search-form search-box">
                            <h3>جميع المنتجات</h3>
                        </form>
                        <div class="form-inline gap-2">
                            <input type="date" id="filter-date" class="form-control mr-2">
                            <button id="filter-button" class="btn btn-primary">تصفية حسب التاريخ</button>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-desi product-details">
                            <table id="editableTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th> رقم العمليه</th>
                                        <th>اسم العميل</th>
                                        <th>وسيله الدفع</th>
                                        <th> المبلغ الكلي</th>
                                        <th>  التاريخ  </th>
                                        <th> حاله الطلب  </th>
                                        <th> العمليات   </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded here via DataTables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- delete --}}
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.products.destroy') }}" method="POST">
                <div class="modal-content">
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <p>متأكد من المنتج .. ؟؟</p>
                            <input type="hidden" name="id" id="id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- delete --}}
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#editableTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.orders.getall') }}",
                    data: function(d) {
                        d.date = $('#filter-date').val();
                    }
                },
                columns: [
                    {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false

                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },

                {
                    data: 'payment_method',
                    name: 'payment_method'
                },
                {
                    data: 'total_price',
                    name: 'total_price'
                },
                {
                    data: 'created',
                    name: 'created',
                    searchable: false
                },

                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                },


                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

                ],
            });

            $('#filter-button').click(function() {
                table.ajax.reload();
            });

            $('#editableTable tbody').on('click', '#deleteBtn', function() {
                var id = $(this).attr("data-id");
                $('#deletemodal #id').val(id);
            });
        });
    </script>
@endpush

@push('css')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .order-details,
        .product-details {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-details h2,
        .product-details h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #555;
            font-size: 24px;
            text-align: center;
        }

        .order-details ul {
            list-style: none;
            padding: 0;
        }

        .order-details ul li {
            margin-bottom: 10px;
            color: #666;
        }

        .product-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .container {
            max-width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .order-details {
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .order-details h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }

        .order-details ul {
            list-style: none;
            padding: 0;
        }

        .order-details ul li {
            margin-bottom: 10px;
            color: #666;
            background-color: #e6e6e6;
            padding: 10px;
            border-radius: 4px;
        }

        .form-inline.search-form.search-box input {
            margin-right: 10px;
        }

        .col-span {
            width: 20% !important;
        }
    </style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <style>
            .scroll{
                overflow-y: auto;                overscroll-behavior: none;
            }
        </style>
@endpush










@section('body')

    <div class="parent">

        <div class="container-fluid">
            <div class="page-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Product Details Box -->
                        <div class="product-details">
                            <h2>الطلبات</h2>
                            <table id="editableTable" class="editableTable">
                                <thead>
                                    <tr>
                                        <th> رقم العمليه</th>
                                        <th>اسم العميل</th>
                                        <th>وسيله الدفع</th>
                                        <th> المبلغ الكلي</th>
                                        <th>  التاريخ  </th>
                                        <th> حاله الطلب  </th>
                                        <th> العمليات   </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



