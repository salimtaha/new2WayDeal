@extends('charity.layouts.app')

@section('title', 'الاشعارات')

@section('body')


    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4">الاشعارات</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- Notifications List -->
                        <div class="card-body">
                            <div class="list-group">
                                @forelse (Auth::guard('charity')->user()->notifications as $notification )

                                <div href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="">
                                                <div class="fw-semibold">
                                                    {{ $notification->data['title'] }}
                                                </div>
                                                <small class="text-muted">{{ $notification->data['msg'] }}</small>
                                            </a>
                                        </div>
                                        <div class="d-flex">
                                            <div class="text-muted">{{ $notification->created_at->diffForHumans() }}</div>
                                            <div class="trash_icon">
                                                <i class="fa-solid fa-trash"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="text-muted"></div>
                                            <div class="trash_icon">
                                                <i class="bx bx-trash me-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
