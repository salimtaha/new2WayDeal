@extends('charity.layouts.app')

@section('title', 'الاعضاء')

@section('body')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <h5 class="card-header">الاعضاء</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">اضافه عضو</button>
                    </div>
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

    <!-- New User Modal  -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">اضافه عضو</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add user form will be here -->
                    <form id="addUserForm" action="{{ route('charities.members.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                        <div class="mb-3 alert-danger" id="errorAlert">
                            <ul>
                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }} ☹</li>

                                @endforeach
                            </ul>
                           </div>
                           @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الجوال</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">الايميل</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        @livewire('charity.register.register-select')
                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان التفصيلي</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">الحاله الاجتماعيه </label>
                            <select class="form-control" name="living_standard">
                                <option value="low" > منخفض</option>
                                <option value="medium" >متوسط</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">الصوره  </label>
                            <input class="form-control" name="image" type="file">

                        </div>

                        <button type="submit" class="btn btn-primary">اضافه</button>
                    </form>
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
                ajax: "{{ Route('charities.members.getall') }}",
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
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json'
            }
            });

        });

        $('#editableTable tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>
@endpush
