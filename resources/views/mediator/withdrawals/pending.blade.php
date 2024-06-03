@extends('mediator.layouts.app')

@section('title', 'طلبات السحب')

@section('body')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class=" shadow-info border-radius-lg pt-4 pb-3" style="background: rgb(94, 92, 92)">
                            <h6 class="text-white text-center text-capitalize ps-3">* طلبات السحب *</h6>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <form class="row" action="{{ route('mediators.pending.index') }}" method="POST">
                                @csrf
                                <div class="col-md-3">
                                    <input type="text" name="search" class="search" placeholder="ابحث هنا الاسم&وسيله السحب">
                                </div>
                                <div class="col-md-4">
                                    <button style="background: rgb(94, 92, 92);color:white" class="btn " type="submit">بحث</button>
                                </div>
                            </form>
                            <table id="editableTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم
                                            العمليه</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            اسم المتجر</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            حاله المتجر</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            طريقه السحب</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            المبلغ </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            التاريخ</th>
                                        <th class="text-secondary opacity-7">العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdrawals as $withdrawal)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $withdrawal->id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div style="margin-left: 10px">
                                                        <img src="{{ asset($withdrawal->store->image) }}"
                                                            class="img-thumbnail avatar avatar-sm me-3 border-radius-lg"
                                                            alt="user4">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $withdrawal->store->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $withdrawal->store->governorate->name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-secondary">{{ $withdrawal->store->status == 'approved' ? 'موثق ' : 'غير معرف' }}</span>
                                            </td>
                                            <td>
                                                <div style="margin-right: 90px">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $withdrawal->method->name }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                {{ $withdrawal->amount }} (ج)
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $withdrawal->created_at->format('Y-m-d h:m') }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <!--*************************************-->
                                                        <a class="btm btn-sm btn-secondary" href="{{ route('mediators.pending.show',$withdrawal->id) }}"><i class="bi bi-eye"></i>عرض</a>
                                              </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="text-info">
                                                    <center>لا يوجد طلبات سحب جديده</center>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                            {{ $withdrawals->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('js')
@endpush

@push('css')
    <style>
        .search {


            height: 38px;
            margin-right: 10px;
            width: 100%;
            box-shadow: 5cm;
            box-shadow: 2px 3px 3px wheat;
            border: none;


        }

    </style>
    <style>
        .table-responsive {
            overflow: hidden;
        }
    </style>

@endpush
