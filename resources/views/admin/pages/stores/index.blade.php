@extends('admin.layouts.app')

@section('title', 'المتاجر')
@section('body')

    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3> قائمه المتاجر
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
                            <li class="breadcrumb-item active"><a href="{{ route('admin.stores.index') }}">
                                    المتاجر</a></li>

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
                                <h3> المتاجر الموثقه</h3>
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
                                            <th>#</th>
                                            <th>أسم المتجر</th>
                                            <th>المحافظه</th>
                                            <th>المدينه</th>
                                            <th>تاريخ الانضمام </th>
                                            <th>الصوره </th>
                                            <th>العمليات</th>
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
                <form action="{{ route('admin.stores.destroy') }}" method="POST">
                    <div class="modal-content">
                        <div class="modal-body">
                            @csrf
                            @method('DELETE')
                            <div class="form-group">
                                <p>متأكد من الحذف .. ؟؟</p>
                                @csrf
                                <input type="hidden" name="id" id="id">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-danger">حذف </button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- delete --}}


    </div>
    </div>


@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#editableTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.stores.getallApproved') }}",
                    data: function(d) {
                        d.date = $('#filter-date').val();
                    }
                },
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,

                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'governorate',
                        name: 'governorate',
                        searchable: false,

                    },
                    {
                        data: 'city',
                        name: 'city',
                        searchable: false,

                    },
                    {
                        data: 'created',
                        name: 'created',

                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

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

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@endpush
@push('css')
    <style>
        .parent {
            width: 100%;
            text-align: center;
            align-content: center;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* margin-right: 60px; */

        }

        /* body {
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    margin: 0;
                    padding: 0;
                } */



        h1 {
            color: #333;
            text-align: center;
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

        .product-details th,
        .product-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-details th {
            background-color: #f0f0f0;
            color: #333;
        }

        .product-details td {
            color: #666;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
        }

        .buttons .print-button {
            background-color: #4CAF50;
        }

        .buttons .complete-button {
            background-color: #008CBA;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
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

        .order-details ul li strong {
            display: inline-block;
            width: 150px;
            /* Adjust width as needed */
            font-weight: bold;
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
        }

        .buttons .print-button {
            background-color: #93cf95;
        }

        .buttons .complete-button {
            background-color: #008CBA;
        }
    </style>
@endpush
