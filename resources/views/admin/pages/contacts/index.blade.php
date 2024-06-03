@extends('admin.layouts.app')

@section('body')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> رسائل التواصل ({{ $contacts->count() }})
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
                        <li class="breadcrumb-item active"><a href="{{ route('admin.mediators.create') }}"> رسائل
                                التواصل </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">التواصل </h3>


                          <form action="{{ route('admin.contacts.index') }}" method="post">
                            @csrf
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="search" class="form-control" placeholder="ابحث عن الايميل او الاسم">
                                    <div class="input-group-append">
                                        <button style="margin-right: 5px" type="submit" class="btn btn-primary">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                          </form>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('admin.contacts.deleteSelected') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <div class="float-right">
                                        1-10/{{ $contacts->count() }}
                                        <div class="btn-group">

                                            <button type="submit" class="btn btn-defualt btn-sm">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                حذف
                                            </button>
                                        </div>


                                    </div>
                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <tbody>
                                            @forelse ($contacts as $contact)
                                                <tr>
                                                    <td>
                                                        <div class="icheck-primary">
                                                            <input type="checkbox" name="contacts[]" value="{{ $contact->id }}" id="check1">
                                                            <label for="check1"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.contacts.show' , $contact->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    </td>
                                                    <td class="mailbox-star"><a href="{{ route('admin.contacts.replay' , $contact->id) }}"><i class="fa fa-reply"
                                                                aria-hidden="true"></i></a></td>
                                                    <td class="mailbox-name"><a
                                                            href="{{ route('admin.contacts.show' , $contact->id) }}">{{ $contact->name }}</a></td>
                                                    <td class="mailbox-subject"><b>{{ $contact->subject }}</b> -
                                                        {{ mb_strimwidth($contact->message, 0, 30) }}...
                                                    </td>
                                                    <td class="mailbox-attachment">{{ $contact->email }}</td>
                                                    <td class="mailbox-attachment"><i class="fa fa-hourglass-start"
                                                            aria-hidden="true"></i></td>

                                                    <td class="mailbox-date">{{ $contact->created_at->diffForHumans() }}
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse

                                        </tbody>
                                    </table>
                                    {{ $contacts->links() }}
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>

                        </form>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                            <div class="mailbox-controls">


                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm">
                                    <i class="fas fa-sync-alt"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    </div>
@endsection

@push('css')
@endpush
