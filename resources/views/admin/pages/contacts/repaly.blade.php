@extends('admin.layouts.app')

@section('title', 'الرد علي التواصل')
@section('body')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> الرد علي رساله جديده
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
                        <li class="breadcrumb-item "><a href="{{ route('admin.contacts.index') }}">
                                الصندوق المرسل </a></li>
                        <li class="breadcrumb-item active"><a href="">
                                {{ $contact->email }} </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                    <form action="{{ route('admin.contacts.send') }}" method="post">
                        @csrf
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">الرد علي : {{ $contact->name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <input class="form-control" readonly  placeholder="الي : {{ $contact->email }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" readonly placeholder="الموضوع : {{ $contact->subject }}">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="editor"  class="form-control  @error('message') is-invalid @enderror"
                                       >

                                    </textarea>
                                </div>
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <input type="hidden" name="email" value="{{ $contact->email }}">
                                <input type="hidden" name="name" value="{{ $contact->name }}">
                                <input type="hidden" name="subject" value="{{ $contact->subject }}">
                                <div class="form-group">
                                    <p class="help-block">الحد الاقصى :32MB</p>
                                    <button type="submit" class="btn btn-primary"> ارسال الرد</button>
                                </div>
                            </div>

                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection

@push('css')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.0/classic/ckeditor.js"></script>
<style type="text/css">
.ck-editor_editable_inline{
    height: 460px;
}

</style>
@endpush
@push('js')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )

        .catch( error => {
            console.error( error );
        } );
</script>
@endpush

