@extends('admin.layouts.app')
@section('title' , 'الاشعارات')
@section('body')

 <!-- Container-fluid starts-->
 <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3 style="color: rgb(236, 73, 73)"> الاشعارات
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
                    <li class="breadcrumb-item active">الاشعارات </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">جميع الاشعارات</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- Notifications List -->
                        <div class="card-body">
                            <div class="list-group">
                                @php
                                   $notifications = Auth::guard('admin')->user()->notifications()->paginate(8)
                                @endphp
                                @forelse ($notifications as $notification )

                                <div  class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="{{ route('admin.notifications.redirectTo' , $notification->id) }}">
                                                <div class="fw-semibold">
                                                    {{ $notification->data['title'] }}
                                                </div>
                                                <small class="text-muted">{{ $notification->data['msg'] }}</small>
                                            </a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="text-muted"> {{ $notification->created_at->diffForHumans() }} </div>
                                            <div class="trash_icon">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="text-muted"></div>
                                            <div class="trash_icon">
                                               <a href="{{ route('admin.notifications.delete' , $notification->id) }}"> <i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ $notifications->links() }}

                                @empty

                                <div class="alert alert-info">
                                    لا يوجد اشعارات
                                </div>

                                @endforelse ()



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection
