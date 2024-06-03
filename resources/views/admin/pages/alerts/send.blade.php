@extends('admin.layouts.app')
@section('title', 'اخطار المتجر')
@section('body')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>  إخطار المتجر
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
                        <li class="breadcrumb-item "><a href="{{ route('admin.stores.index') }}">
                           المتاجر</a></li>
                            <li class="breadcrumb-item "><a href="{{ route('admin.stores.show' , $store->id) }}">
                                {{ $store->name }}  </a></li>
                            <li class="breadcrumb-item active"><a href="">
                                إخطار المتجر </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @livewire('admin.alert.alert-store' , ['store'=>$store])

@endsection
@push('css')


@endpush
