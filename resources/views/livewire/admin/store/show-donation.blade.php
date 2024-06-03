<div class="card table mt-4 shadow rtl">
    <div class="card-body">
        <center>
            <h5 class="card-title rtl">* تبرعات المتجر*</h5>
        </center>
        <br>
        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" placeholder="ابحث  ..." dir="rtl" class="form-control rtl-input"
                wire:model="searchTerm">
        </div>
        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="alert alert-success rtl-alert" id="errorAlert">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger rtl-alert" id="errorAlert">
                {{ session('error') }}
            </div>
        @endif
        <table class="table shadow-card">
            <thead>
                <tr>
                    <th># </th>
                    <th> اسم المؤسسه</th>
                    <th>تاريخ التبرع</th>
                    <th> الحاله</th>
                    <th> الوجبات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donations as $donation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $donation->charity->name }}</td>
                        <td>{{ $donation->created_at }}</td>
                        <td class="badge badge-pill" @if($donation->status=="accept")
                            style="background:green;color:white"
                            @elseif ($donation->status=="pending")
                            style="background:blue;color:white"
                            @else
                            style="background:red;color:white"
                        @endif> @if($donation->status=="accept")تم قبوله @elseif ($donation->status=="pending") في الانتظار @else تم رفضه  @endif</td>
                        <td>{{ $donation->meals }}</td>

                        {{-- <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    العمليات
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-sm" href="">عرض المنتج <i
                                            class="fa fa-eye"></i></a>
                                            <a class="dropdown-item btn-sm text-danger" href="#" >
                                                حذف المنتج <i class="fa fa-trash"></i>
                                            </a>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                           <div class="alert alert-info"> <center class="text-info">لا يوجد تبرعات لهذا المتجر بعد...</center></div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $donations->links() }}
    </div>
</div>

<style>
    .rtl-input {
        direction: rtl;
        text-align: right;
    }
</style>
