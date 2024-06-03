@extends('admin.layouts.app')
@section('title', 'عرض الرسالة')

@section('body')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>رسائل التواصل</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.welcome') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.contacts.index') }}">رسائل الصندوق
                                الوارد</a></li>
                        <li class="breadcrumb-item active"><a href="">قراءة</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">قراءه البريد الوارد</h3>

                        <div class="card-tools">

                            <a href="{{ route('admin.contacts.delete', $contact->id) }}" type="button"
                                class="btn btn-default btn-sm" data-container="body" title="Delete">
                                الحذف <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('admin.contacts.replay', $contact->id) }}" type="button"
                                class="btn btn-default btn-sm" data-container="body" title="Reply">
                                الرد <i class="fa fa-reply" aria-hidden="true"></i>
                            </a>


                            <button type="button" class="btn btn-default btn-sm" title="Print" onclick="printMail()">
                                طباعه <i class="fa fa-print" aria-hidden="true"></i>
                            </button>
                        </div>

                    </div>
                    <hr>
                    <div style="margin-right: 30px" class="card-body p-0">
                        <div class="mailbox-read-info">
                            <h5>الموضوع : {{ $contact->subject }}</h5>
                            <h6>من: {{ $contact->email }}<br>
                                <span class="mailbox-read-time float-right"></span>
                            </h6>
                            <hr style="width: 300px">

                        </div>
                        <div class="mailbox-controls with-border text-center">

                        </div>
                        <div class="mailbox-read-message">

                            <p>{{ $contact->message }}</p>
                            <br>
                            <p>{{ $contact->created_at->format('Y-M-D h:m:s') }}</p>


                            <p>شكر,{{ config('app.name') }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        function printMail() {
            window.print();
        }
    </script>
@endpush
