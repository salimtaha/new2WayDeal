@extends('charity.layouts.app')

@section('title', 'الاعضاء')

@section('body')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">الاعضاء</h5>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="editableTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th># </th>
                                    <th>الاسم</th>
                                    <th>الايميل</th>
                                    <th>رقم الجوال</th>
                                    <th> المحافظه</th>
                                    <th>المدينه</th>
                                    <th>المستوى</th>
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
    <!-- Content wrapper -->



@endsection

@push('js')
    <script type="text/javascript">
        $(function() {
            var table = $('#editableTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('charities.members.trashed.getall') }}",
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
                        data: 'phone',
                        name: 'phone'
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
                        data: 'standard',
                        name: 'standard'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],
                columnDefs: [
                { width: "2%", targets: 2 } // Adjust the width of the third column (index 2)
            ],


            });

        });

        $('#editableTable tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>
@endpush
