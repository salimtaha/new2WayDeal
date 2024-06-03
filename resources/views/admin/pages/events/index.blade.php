@extends('admin.layouts.app')
@section('title' , 'اداره الاحداث ')

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="color: rgb(236, 73, 73)"> الاحداث
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
                        <li class="breadcrumb-item active"><a href=""> احداث النظام </a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    <div class="parent">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="card ">
                        <div class="card-header">
                            <form class="form-inline search-form search-box">

                            </form>

                            <a href="{{ route('admin.events.calendar') }}" type="button" class="btn btn-primary mt-md-0 mt-2"
                               >إضافة حدث جديد</a>


                        </div>

                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="table-responsive table-desi product-details">
                                <table id="editableTable" class="editableTable">
                                    <thead>
                                        <tr>
                                            <th> رقم الحدث</th>
                                            <th> عنوان الحدث</th>
                                            <th> تاريخ انشاء الحدث</th>
                                            <th> تاريخ بدء الحدث </th>
                                            <th>   الوقت المتبقي باليوم </th>
                                            <th>  العمليات </th>
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

    </div>


@endsection


@push('js')
<script type="text/javascript">
    $(function() {
        var table = $('#editableTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ Route('admin.events.getall') }}",
            columns: [

                {
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false

                },
                {
                    data: 'title',
                    name: 'title'
                },

                {
                    data: 'created',
                    name: 'created'
                },
                {
                    data: 'start',
                    name: 'start'
                },
                {
                    data: 'remaining_time',
                    name: 'remaining_time',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }

            ],
        });

    });
</script>
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

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }



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

        .order-details {
            margin-bottom: 20px;
            padding: 20px;
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
