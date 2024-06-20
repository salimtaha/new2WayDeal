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
                        <li class="breadcrumb-item active"><a href=""> رسائل
                                التواصل </a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"> التواصل/تم الرد </h3>

                        <form action="{{ route('admin.contacts.old') }}" method="post">
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
                    </div>
                    <form action="{{ route('admin.contacts.deleteSelected') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="card-body p-0">
                            <div class="mailbox-controls">
                                <div class="float-right">
                                    1-10/{{ $contacts->count() }}
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-default btn-sm">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            حذف
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="select-all" class="select-all">
                                                    <label for="select-all"></label>
                                                </div>
                                            </th>
                                            <th></th>
                                            <th>الاسم</th>
                                            <th>الموضوع</th>
                                            <th>الايميل</th>
                                            <th>الحالة</th>
                                            <th></th>
                                            <th>التاريخ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($contacts as $contact)
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" name="contacts[]" value="{{ $contact->id }}" class="contact-checkbox" id="contact-checkbox-{{ $contact->id }}">
                                                        <label for="contact-checkbox-{{ $contact->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="mailbox-star"><a href="{{ route('admin.contacts.show', $contact->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                                <td class="mailbox-name"><a href="{{ route('admin.contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
                                                <td class="mailbox-subject"><b>{{ $contact->subject }}</b> - {{ mb_strimwidth($contact->message, 0, 30) }}...</td>
                                                <td class="mailbox-attachment">{{ $contact->email }}</td>
                                                <td class="mailbox-attachment" style="text-info">تم الرد</td>
                                                <td class="mailbox-attachment"><i class="fa fa-hourglass-end" aria-hidden="true"></i></td>
                                                <td class="mailbox-date">{{ $contact->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No contacts found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    </form>
                    <div class="card-footer p-0">
                        <div class="mailbox-controls">
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const contactCheckboxes = document.querySelectorAll('.contact-checkbox');

        // Add event listener for the "Select All" checkbox
        selectAllCheckbox.addEventListener('change', function() {
            // Check or uncheck all contact checkboxes based on the state of the "Select All" checkbox
            contactCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    });
</script>
@endpush

@push('css')
@endpush
