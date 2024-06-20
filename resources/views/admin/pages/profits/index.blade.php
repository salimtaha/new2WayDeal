@extends('admin.layouts.app')
@section('title', 'اداره الارباح اليوميه')

@section('body')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3 style="color: rgb(236, 73, 73)"> الارباح اليوميه
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
                    <li class="breadcrumb-item active"><a href=""> الارباح اليوميه  </a></li>
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
                        <h3 >الربح اليومي</h3>
                    </form>
                    <a href="{{ route('admin.profits.index.monthly') }}" type="button" class="btn btn-primary mt-md-0 mt-2">الربح الشهري</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-desi product-details">
                        <table id="editableTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاريخ اليوم</th>
                                    <th class="col-span">الطلبات المدفوعه</th>
                                    <th>المبلغ</th>
                                    <th>الربح</th>
                                    <th> جميع الطلبات</th>
                                    <th>المبلغ</th>
                                    <th>الربح المتوقع</th>
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
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#editableTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('admin.profits.getall.daily')}}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'date_day', name: 'date_day' },
                { data: 'actual_count_orders', name: 'actual_count_orders', searchable: false },
                { data: 'actual_amount', name: 'actual_amount', searchable: false },
                { data: 'actual_profit_day', name: 'actual_profit_day' },
                { data: 'count_orders', name: 'count_orders', searchable: false },
                { data: 'amount', name: 'amount', searchable: false },
                { data: 'profit_day', name: 'profit_day', searchable: false },
            ],

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

    .order-details, .product-details {
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .order-details h2, .product-details h2 {
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
