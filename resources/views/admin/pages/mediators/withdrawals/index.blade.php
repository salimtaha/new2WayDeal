@extends('admin.layouts.app')

@section('title', 'إدارة السحوبات')

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
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3 style="color: rgb(236, 73, 73)">  المسئول : {{  $mediator->name }}
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
                    <li class="breadcrumb-item "> <a href="{{ route('admin.mediators.index') }}">مسئولي  السحب</a></li>
                     <li class="breadcrumb-item active"> {{   $mediator->name }}</li>

                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<div class="row parent">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span style="display: flex">

                        <form action="{{ route('admin.mediators.withdrawals' , $mediator->id) }}" method="POST">
                            @csrf
                            <input placeholder="ابحث هنا" class="input shadow-0" style="height: 35px; background:rgba(255, 255, 255, 0)"
                                type="text" name="search">
                            <button class="btn btn-sm btn-danger" type="submit">بحث</button>
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
                                <th>اسم البائع</th>
                                <th> الحاله</th>
                                <th>المبلغ المطلوب سحبه</th>
                                <th>طريقه السحب</th>
                                <th>تاريخ الطلب</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody id="withdrawalTableBody">
                            @forelse ($withdrawals as $withdrawal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $withdrawal->store->name??'محذوف' }}</td>

                                    <td class="badge badge-pill"
                                        style="background: @if ($withdrawal->status == 'accepted') green @elseif($withdrawal->status == 'pending') navy @else red @endif ;margin-top: 20px;color:white">
                                        @if ($withdrawal->status == 'accepted')
                                            مقبول
                                        @elseif($withdrawal->status == 'pending')
                                            انتظار
                                        @else
                                            مرفوض
                                        @endif
                                    </td>


                                    <td>{{ $withdrawal->amount }} ج</td>
                                    <td>{{ $withdrawal->method->name }}</td>
                                    <td>{{ $withdrawal->created_at->format('Y-m-d h:m') }}</td>
                                    <td>
                                        <a href="{{ route('admin.withdrawal.show', $withdrawal->id) }}"
                                            > عرض <i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7" class="text-info">
                                    <center>لا يوجد سحوبات</center>
                                </td>
                            @endforelse

                        </tbody>
                        {{ $withdrawals->links() }}
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
