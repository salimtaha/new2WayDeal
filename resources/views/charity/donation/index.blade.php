@extends('charity.layouts.app')

@section('title' , 'التبرعات')

@section('body')
      <!-- Content wrapper -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
          <h5 class="card-header">التبرعــات</h5>
          <div class="card-body">
            <div class="table-responsive">
              <table id="editableTable" class="table table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>المتجر المتبرع</th>
                    <th>الوجبات</th>
                    <th>وقت انشاء الطلب</th>
                    <th>الحاله</th>
                    <th>العمليات</th>
                  </tr>
                </thead>
                <tbody>


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection


@push('js')
    <script type="text/javascript">
        $(function() {
            var table = $('#editableTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('charities.donations.getall') }}",
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'store_name',
                        name: 'store_name'
                    },
                    {
                        data: 'meals',
                        name: 'meals'
                    },
                    {
                        data: 'created',
                        name: 'created'
                    },

                    {
                        data: 'newstatus',
                        name: 'newstatus'
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
                ],

            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Arabic.json'
            }
            });

        });


    </script>
@endpush
