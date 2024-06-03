@extends('admin.layouts.app')

@section('title', 'المستخدمين')
@section('body')


    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3 style="color: rgb(236, 73, 73)"> المستخدمين المحظورين
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i data-feather="home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">الداشبورد</li>
                            <li class="breadcrumb-item active">المستخدمين المحظورين</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <form class="form-inline search-form search-box">

                            </form>

                            <a class="btn btn-primary mt-md-0 mt-2" href="{{ route('admin.users.create') }}">إضافة
                                مستخدم جديد</a>

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
                            <div class="table-responsive table-desi">
                                <table class="table all-package table-category " id="editableTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>المحافظه</th>
                                            <th>المدينه</th>
                                            <th>الصوره</th>
                                            <th>العمليات</th>
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
        <!-- Container-fluid Ends-->


        {{-- delete --}}
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.users.delete') }}" method="POST">
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


@endsection

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css"> --}}
@endpush
@push('js')
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}


    <script type="text/javascript">
        $(function() {
            var table = $('#editableTable').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                processing: true,
                serverSide: true,
                scrollCollapse: false,
                ajax: "{{ Route('admin.users.blocked.getall') }}",
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'governorate',
                        name: 'governorate'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }

                ]
            });

        });

        $('#editableTable tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            // console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> --}}
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
