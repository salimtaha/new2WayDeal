@extends('mediator.layouts.app')

@section('title', 'تفاصيل السحب')

@section('body')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xl-6 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl">
                                <img src="{{ asset('assets/mediator') }}/img/illustrations/pattern-tree.svg"
                                    class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100"
                                    alt="pattern-tree">
                                <span class="mask bg-gradient-dark opacity-10"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <i class="material-icons text-white p-2">wifi</i>
                                    <h5 class="text-white mt-4 mb-5 pb-2">
                                        {{-- 4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852 --}}
                                        <center> {{ $withdrawal->number }}</center>
                                    </h5>
                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0"></p>
                                                <h6 class="text-white mb-0"></h6>
                                            </div>
                                            <div>
                                                <p class="text-white text-sm opacity-8 mb-0"></p>
                                                <h6 class="text-white mb-0"></h6>
                                            </div>
                                        </div>
                                        <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                            <img class="w-60 mt-2"
                                                src="{{ asset('assets/mediator') }}/img/logos/mastercard.png"
                                                alt="logo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">account_balance</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">رصيد الحساب</h6>
                                        <span class="text-xs">الرصيد المتوفر الان في الحساب</span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">{{ $withdrawal->store->account->value }} (ج)</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="card">
                                    <div class="card-header mx-4 p-3 text-center">
                                        <div
                                            class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                            <i class="material-icons opacity-10">account_balance_wallet</i>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0 p-3 text-center">
                                        <h6 class="text-center mb-0">رصيد الحساب</h6>
                                        <span class="text-xs"> بعد اتمام عمليات السحب المنتظره </span>
                                        <hr class="horizontal dark my-3">
                                        <h5 class="mb-0">
                                            @php
                                            if($withdrawal->status=="pending"){
                                                $current_amount = $withdrawal->amount;
                                            }else{
                                                $current_amount = 0;
                                            }
                                            @endphp

                                            {{ $withdrawal->store->account->value - ($store_pending_withdrawals->sum('amount') + $current_amount ) }}
                                            (ج)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-lg-0 mb-2">
                        <div class="card mt-4">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0"> طلب السحب الحالي</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        @if ($withdrawal->status == 'pending')
                                            <div class="dropdown">
                                                <button class="btn btn-secondary  bg-gradient-dark mb-0  dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    العمليات
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <li><a class="dropdown-item"
                                                            href="{{ route('mediators.pending.accept', $withdrawal->id) }}">موافقه</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('mediators.pending.reject', $withdrawal->id) }}">رفض</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @elseif($withdrawal->status == 'rejected')
                                            <div class="badge badge-lg bg-gradient-secondary ms-4">
                                                مرفوض
                                            </div>
                                        @else

                                        <div class="badge badge-sm bg-gradient-info ms-4">
                                            تم السحب
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-4">
                                        <div
                                            class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                            {{-- <img class="w-10 me-3 mb-0"
                                                src="{{ asset('assets/mediator') }}/img/logos/mastercard.png"
                                                alt="logo"> --}}
                                            <h6 class="mb-0">
                                                الرقم : {{ $withdrawal->number }}
                                                {{-- <i class="material-icons ms-auto text-dark cursor-pointer"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card">edit</i> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                            {{-- <img class="w-10 me-3 mb-0"
                                                src="{{ asset('assets/mediator') }}/img/logos/visa.png" alt="logo"> --}}
                                            <h6 class="mb-0">
                                                المبلغ : {{ $withdrawal->amount }} (ج)

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100" id="printableCard">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">الفتوره</h6>
                            </div>
                            @if ($withdrawal->status == 'accepted')
                                <div class="col-6 text-end">
                                    <button class="btn btn-outline-primary btn-sm mb-0" onclick="printCard()">طباعه
                                        الفتوره</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">الاسم
                                        <span
                                            class="text-xs">({{ $withdrawal->store->status == 'approved' ? 'موثق' : 'انتظار' }})
                                            : </span>
                                </div>
                                <div class="d-flex align-items-center text-sm">

                                    <div class=" text-dark text-sm mb-0 px-0 ms-4">
                                        {{ $withdrawal->store->name }}
                                    </div>
                                </div>
                            </li>
                            <!-- More list items -->
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">تاريخ السحب</h6>
                                    <span class="text-xs"></span>
                                </div>
                                <div class="d-flex align-items-center text-sm">

                                    <div class=" text-dark text-sm mb-0 px-0 ms-4">
                                        {{ $withdrawal->created_at->format('Y-m-d h:m') }}
                                    </div>
                                </div>
                            </li>
                            <!-- More list items -->
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm">وسيله السحب </h6>
                                    <span class="text-xs"></span>
                                </div>
                                <div class="d-flex align-items-center text-sm">

                                    <div class=" text-dark text-sm mb-0 px-0 ms-4">
                                        {{ $withdrawal->method->name }}
                                    </div>
                                </div>
                            </li>
                            <!-- More list items -->
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"> المبلغ بالجنيه</h6>
                                    <span class="text-xs"></span>
                                </div>
                                <div class="d-flex align-items-center text-sm">

                                    <div class=" text-dark text-sm mb-0 px-0 ms-4">
                                        {{ $withdrawal->amount }}
                                    </div>
                                </div>
                            </li>
                            <!-- More list items -->
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"> حاله السحب </h6>
                                    <span class="text-xs"></span>
                                </div>
                                <div class="d-flex align-items-center text-sm">

                                    @if ($withdrawal->status == 'pending')
                                    <div class="badge badge-sm bg-gradient-secondary ms-4 ">
                                        انتظار
                                    </div>
                                    @elseif ($withdrawal->status == 'accepted')
                                    <div class="badge badge-sm bg-gradient-info ms-4">
                                        تم الموافقه
                                    </div>
                                    @else
                                    <div class="badge badge-sm bg-gradient-secondary ms-4">
                                        'مرفوض'
                                    </div>
                                    @endif
                                </div>
                            </li>
                            <!-- More list items -->
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-dark font-weight-bold text-sm"> الرصيد الحساب الحالي </h6>
                                    <span class="text-xs"></span>
                                </div>
                                <div class="d-flex align-items-center text-sm">

                                    <div class=" text-dark text-sm mb-0 px-0 ms-4">
                                        {{ $withdrawal->store->account->value }}
                                    </div>
                                </div>
                            </li>
                            <!-- More list items -->
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mt-4">
                <div class="card mt-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0"> بيانات المتجر</h6>
                            </div>


                        </div>
                    </div>
                    <div class="card-body p-3">

                        <div class="row">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        التقيم : @if ($withdrawal->store_rate > 0)
                                            <i class="bi bi-star-fill"></i>
                                        @endif
                                        @if ($withdrawal->store_rate > 1)
                                            <i class="bi bi-star-fill"></i>
                                        @endif
                                        @if ($withdrawal->store_rate > 2)
                                            <i class="bi bi-star-fill"></i>
                                        @endif
                                        @if ($withdrawal->store_rate > 3)
                                            <i class="bi bi-star-fill"></i>
                                        @endif
                                        @if ($withdrawal->store_rate > 4)
                                            <i class="bi bi-star-fill"></i>
                                        @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        البريد : {{ $withdrawal->store->email }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        المحافظه : {{ $withdrawal->store->governorate->name }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        المدينه : {{ $withdrawal->store->city->name }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        الحاله : {{ $withdrawal->store->status == 'approved' ? 'موثق' : 'انتظار' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        رصيد الحساب : {{ $withdrawal->store->account->value }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-7 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">طلبات السحب الاخرى </h6>
                            </div>
                            <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                                <i class="material-icons me-2 text-lg">date_range</i>
                                <small>{{ now() }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">الاحدث</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <caption>السحب في قائمه الانتظار </caption>
                                <thead>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>وسيله السحب</th>
                                        <th>المبلغ</th>
                                        <th>الحاله</th>
                                        <th>التاريخ</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($store_pending_withdrawals as $withdrawal)
                                        <tr>
                                            <td>{{ $withdrawal->id }}</td>
                                            <td>{{ $withdrawal->method->name }}</td>
                                            <td>{{ $withdrawal->amount }}</td>
                                            <td>
                                                @if($withdrawal->status == "pending")
                                                <div class="badge badge-lg bg-gradient-primary ms-4">
                                                    انتظار
                                                </div>
                                                @endif
                                            </td>
                                            <td>{{ $withdrawal->created_at->format('Y-m-d h:m') }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle"
                                                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        العمليات
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('mediators.pending.show', $withdrawal->id) }}">عرض</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('mediators.pending.accept', $withdrawal->id) }}">موافقه</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('mediators.pending.reject', $withdrawal->id) }}">رفض</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                            {{ $store_pending_withdrawals->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function printCard() {
        // Get the current scroll position
        var scrollPos = window.scrollY;

        // Save the content to print
        var printContents = document.getElementById('printableCard').innerHTML;

        // Open a new window and write the content to print
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print</title></head><body>' + printContents + '</body></html>');
        printWindow.document.close();

        // Print the content
        printWindow.print();

        // Close the window after printing
        printWindow.close();

        // Scroll back to the original position
        window.scrollTo(0, scrollPos);
    }
</script>






<style>

    .table-responsive {
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    tbody tr:hover {
        background-color: #f2f2f2;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
