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
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> السحوبات الماليه
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
                        <li class="breadcrumb-item "><a href="{{ route('admin.withdrawal.index') }}">
                                السحوبات الماليه </a></li>

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

    <div class="row">
        <div class="col-xxl-6 col-md-12 xl-50 ">
            <div class="card o-hidden widget-cards">
                <div class="warning-box card-body">
                    <div class="media static-top-widget align-items-center">
                        <div class="icons-widgets">
                            <div class="align-self-center text-center">
                                <i data-feather="hash" class="font-warning"></i>
                            </div>
                        </div>
                        <div class="media-body media-doller">
                            <span class="m-0"> عدد السحوبات</span>
                            <h3 class="mb-0"> <span class="counter">{{ App\Models\Withdrawal::where('status' , 'accepted')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count() }}</span><small>
                                    هذا الشهر
                                </small>
                            </h3>
                        </div>
                        <div class="media-body media-doller">
                            <span class="m-0"> عدد السحوبات</span>
                            <h3 class="mb-0"> <span class="counter">{{ App\Models\Withdrawal::where('status' , 'accepted')->count() }}</span><small>
                                    الكلي
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 xl-50">
            <div class="card o-hidden widget-cards">
                <div class="secondary-box card-body">
                    <div class="media static-top-widget align-items-center">
                        <div class="icons-widgets">
                            <div class="align-self-center text-center">
                                <i data-feather="dollar-sign" class="font-primary"></i>
                            </div>
                        </div>
                        <div class="media-body media-doller">
                            <span class="m-0">المبلغ المسحوب </span>
                            <h3 class="mb-0"> <span class="counter">{{ App\Models\Withdrawal::where('status' , 'accepted')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->pluck('amount')->sum()}}</span><small>
                                    هذا الشهر
                                </small>
                            </h3>
                        </div>
                        <div class="media-body media-doller">
                            <span class="m-0">المبلغ المسحوب </span>
                            <h3 class="mb-0"> <span class="counter">{{ App\Models\Withdrawal::where('status' , 'accepted')->pluck('amount')->sum()}}</span><small>
                                    المبلغ الكلي
                                </small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row parent">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span style="display: flex">
                            <form action="{{ route('admin.withdrawal.index') }}" method="POST">
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

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#categoryTable tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
    <!-- Add any additional scripts you may need -->
@endpush
