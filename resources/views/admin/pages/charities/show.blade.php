@extends('admin.layouts.app')

@section('title', 'عرض المؤسسه')
@push('css')
    <style>
        /* Initially display the image */
        #image {
            display: none;
        }

        #hideButton {
            display: none;
            /* Hide the show button initially because the image is displayed */
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
                        <h3> بيانات المؤسسه
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}"> المؤسسات
                            </a></li>
                        <li class="breadcrumb-item active"><a href="">
                                {{ $charity->name }} </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="card mt-4 shadow rtl">
        <div class="row" action="" method="post">
            @csrf
            <div class="col-md-3 border-right">


                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="{{ asset($charity->image) }}"><br>
                    <span class="badge badge-pill {{ $charity->status == 'approved' ? 'bg-success' : 'bg-danger' }}">
                        @if ($charity->status == 'approved')
                            المؤسسه موثقه
                        @elseif ($charity->status == 'pending')
                            انتظار الموافقه
                        @elseif($charity->status == 'blocked')
                            المؤسسه محظوره
                        @else
                            بيانات الاعتماد مرفوضه
                        @endif
                    </span>
                    <br>
                    <span class="font-weight-bold">{{ $charity->name }}</span><span
                        class="text-black-50">{{ $charity->email }}</span><br>
                    <br>
                    <span class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            العمليات
                        </button>
                        <div class="dropdown-menu ">
                            <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item" data-bs-toggle="modal"
                                data-original-title="test" data-bs-target="#deletemodal"> الحذف <i
                                    class="fa fa-trash"></i></a>
                            <div class="dropdown-divider"></div>
                            @if ($charity->status == 'pending')
                                <a class="dropdown-item " href="{{ route('admin.charities.accept', $charity->id) }}">قبول
                                    المؤسسه <i class="fa fa-stop"></i></a>
                            @elseif ($charity->status == 'approved')
                                <a class="dropdown-item " href="{{ route('admin.charities.block', $charity->id) }}">تقيد
                                    المؤسسه <i class="fa fa-stop"></i></a>
                            @elseif($charity->status == 'blocked')
                                <a class="dropdown-item" href="{{ route('admin.charities.active', $charity->id) }}">فك تقيد
                                    الحساب <i class="fa fa-undo" aria-hidden="true"></i></i></a>
                            @endif

                        </div>

                    </span>
                </div>

            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">بيانات المؤسسه </h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">الاسم</label><input type="text"
                                class="form-control"readonly value="{{ $charity->name }}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">رقم الجوال </label><input type="text"
                                class="form-control" readonly value="{{ $charity->phone }}"></div>
                        <div class="col-md-12"><label class="labels">البريد الالكتروني </label><input type="email"
                                readonly class="form-control" value="{{ $charity->email }}"></div>
                        <div class="col-md-12"><label class="labels">تاريخ الانضمام </label><input type="email" readonly
                                class="form-control" value="{{ $charity->created_at->format('Y-m-d') }}"></div><br><br>
                        <div class="col-md-12">
                            <img style="margin-top: 10px" width="100%" class="img-thumbnail" id="image" src="{{ asset($charity->health_certificate) }}"
                                alt="Sample Image">

                        </div>
                    </div>



                </div>
            </div>
            <div class="col-md-4 ">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span
                            style="color: @if ($charity->status == 'approved') green @else red @endif ;margin-right: 20px">{{ $charity->status == 'approved' ? 'الحساب نشط' : ' غير نشط' }}</span>
                    </div><br>
                    <div class="col-md-12"><label class="labels">المحافظه</label><input class="form-control"
                            value="{{ $charity->governorate->name }}" readonly></div> <br>
                    <div class="col-md-12"><label class="labels"> المدينه</label><input value="{{ $charity->city->name }}"
                            class="form-control" readonly>

                    </div>
                    <div class="col-md-12"><label class="labels">العنوان التفصيلي</label><input class="form-control"
                            value="{{ $charity->address }}" readonly>
                    </div><br>
                    <div class="col-md-12">

                        <button class="btn btn-info" id="showButton">رؤيه الوثيقه</button>
                        <button class="btn btn-danger" id="hideButton">أخفاء</button>
                        <button class="btn btn-primary" id="downloadButton">تحميل الوثيقه</button>
                    </div>

                </div>
            </div>
        </div>

    </div>










    {{-- delete --}}
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.charities.destroy') }}" method="POST">
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

    <!-- charity donations Table -->
    <div class="card mt-4 shadow rtl">
        <div class="card-body">
            <center>
                <h5 class="card-title rtl">* تبرعات المؤسسه ({{ $charity->donations->count() }})*</h5>
            </center><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> اسم المتجر</th>
                        <th> الحاله</th>
                        <th> تاريخ التبرع</th>
                        <th> الوجبات </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $donations = $charity->donations()->paginate(4);
                    @endphp
                    @forelse ($donations as $donate)
                        <tr>
                            <td>{{ $donate->id }}</td>
                            <td><a style="text-decoration: none;color:black"
                                    href="{{ route('admin.stores.show', $donate->store->id) }}">{{ $donate->store->name }}
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a></td>
                            <td class="badge badge-pill {{ $donate->status == 'accept' ? 'bg-success' : 'bg-danger' }}">
                                @if ($donate->status == 'accept')
                                    مقبول
                                @elseif ($donate->status == 'canceld')
                                    مرفوض
                                @else
                                    انتظار
                                @endif
                            </td>
                            <td>{{ $donate->created_at->format('Y-m-d h:m:s') }}</td>
                            <td>{{ $donate->meals }}</td>
                            {{-- <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        العمليات
                                    </button>
                                    <div class="dropdown-menu ">
                                        <a class="dropdown-item btn-sm"
                                            href=""> تفاصيل الطلب <i
                                                class="fa fa-list"></i></a>
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                    @empty

                        <tr>
                            <td colspan="6">
                                <center class="text-info"> لا يوجد تبرعات لهذه المؤسسه بعد ...</center>
                            </td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
            {{ $donations->links() }}
        </div>
    </div>

    <div class="card mt-4 shadow rtl">
        <div class="card-body">
            <center>
                <h5 class="card-title rtl">* اعضاء المؤسسه ({{ $charity->members->count() }})*</h5>
            </center><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> اسم العضو </th>
                        <th> الحاله</th>
                        <th> رقم الجوال </th>
                        <th>المحافظه</th>
                        <th>المدينه</th>
                        <th> تاريخ الانضمام</th>


                    </tr>
                </thead>
                <tbody>
                    @php
                        $members = $charity->members()->paginate(5);
                    @endphp
                    @forelse ($members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->name }}</td>
                            <td style="margin-left: 10px"
                                class="badge badge-pill {{ $member->living_standard == 'medium' ? 'bg-success' : 'bg-danger' }}">
                                @if ($member->living_standard == 'low')
                                    ميئوس
                                @else
                                    متوسط
                                @endif
                            </td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->governorate->name }}</td>
                            <td>{{ $member->city->name }}</td>
                            <td>{{ $member->created_at->format('Y-m-d h:m:s') }}</td>

                        </tr>
                    @empty

                        <tr>
                            <td colspan="7">
                                <center class="text-info"> لا يوجد اعضاء لهذه المؤسسه بعد ...</center>
                            </td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
            {{ $members->links() }}
        </div>
    </div>

    </div>

@endsection
@push('js')
    <script>
        document.getElementById('hideButton').addEventListener('click', function() {
            var img = document.getElementById('image');
            img.style.display = 'none';
            document.getElementById('hideButton').style.display = 'none';
            document.getElementById('showButton').style.display = 'inline-block';
        });

        document.getElementById('showButton').addEventListener('click', function() {
            var img = document.getElementById('image');
            img.style.display = 'block';
            document.getElementById('hideButton').style.display = 'inline-block';
            document.getElementById('showButton').style.display = 'none';
        });

        document.getElementById('downloadButton').addEventListener('click', function() {
            var link = document.createElement('a');
            link.href = document.getElementById('image').src;
            link.download = 'downloaded_image.jpg'; // Specify the filename here
            link.click();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
@endpush
