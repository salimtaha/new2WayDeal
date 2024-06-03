@extends('admin.layouts.app')

@section('title', ' المتاجر المحظوره')

@push('css')
    <style>
        .parent {
            width: 100%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-right: 5px;
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
                        <h3 style="color: rgb(236, 73, 73)"> المتاجر المحظوره
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.stores.index') }}">المتاجر </a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.stores.blocked') }}">المتاجر
                                المحظوره </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    @php
        use Illuminate\Support\Carbon;

        $startOfMonth = now()->startOfMonth()->format('Y-m-d h:m:s');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d h:m:s');
    @endphp


    <div class="row parent">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="display: flex">
                            <form action="{{ route('admin.stores.blocked') }}" method="POST">
                                @csrf
                                <input placeholder="ابحث هنا" class="input shadow-0"
                                    style="height: 35px; background:rgba(255, 255, 255, 0)" type="text" name="search">
                                <button class="btn btn-danger" type="submit">بحث</button>
                            </form>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="categoryTable" class=" table-striped table  table-shadow ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>أسم المتجر</th>
                                    <th>المحافظه</th>
                                    <th>المدينه</th>
                                    <th> رقم الهاتف </th>
                                    <th> التقيم </th>
                                    <th>تاريخ الانشاء </th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody id="withdrawalTableBody">
                                @forelse ($stores as  $store)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->governorate->name }}</td>
                                        <td>{{ $store->city->name }}</td>
                                        <td>{{ $store->phone }}</td>
                                        @php
                                            //Store Rate
                                            $store_rate = App\Models\StoreRate::where('store_id', $store->id)
                                                ->select(DB::raw('AVG(value) as rate'))
                                                ->get();
                                            $store_rate = $store_rate[0]->rate;

                                            $store['rate'] = $store_rate;
                                        @endphp
                                        <td>

                                            <i class="fa @if ($store->rate >= 1) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store->rate >= 2) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store->rate >= 3) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store->rate >= 4) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store->rate >= 5) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>




                                        </td>
                                        <td>{{ $store->created_at->format('Y-m-d h:m:s') }}</td>
                                        {{-- <td><img src="{{ asset($store->image) }}" class="img-thumbnail  img-fluid" width="100px"></td> --}}
                                        <td>

                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    العمليات
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"
                                                        data-bs-toggle="modal" data-original-title="test"
                                                        data-bs-target="#deletemodal{{ $store->id }}"> الحذف <i
                                                            class="fa fa-trash"></i></a>
                                                    <a class="dropdown-item "
                                                        href="{{ Route('admin.stores.active', $store->id) }}">فك الحظر <i
                                                            class="fa fa-unlock" aria-hidden="true"></i></a>
                                                    <a class="dropdown-item "
                                                        href="{{ Route('admin.stores.show', $store->id) }}">العرض <i
                                                            class="fa fa-eye"></i></a>

                                                </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deletemodal{{ $store->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">

                                            <form action="{{ route('admin.stores.destroy') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">هل انت متاكد من
                                                            حذف
                                                            متجر : {{ $store->name }} ؟</h5>
                                                        <input type="hidden" name="id" value="{{ $store->id }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">الغاء</button>
                                                        <button type="submit" class="btn btn-primary">حذف</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <center>
                                                <div class="text-info"> لا يوجد متاجر في الارشيف</div>
                                            </center>
                                        </td>
                                    </tr>
                                @endforelse


                            </tbody>
                            {{ $stores->links() }}
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection







@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
@endpush
