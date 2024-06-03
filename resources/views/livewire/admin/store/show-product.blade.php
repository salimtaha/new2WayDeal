<div class="card table mt-4 shadow rtl">
    <div class="card-body">
        <center>
            <h5 class="card-title rtl">* منتجات المتجر*</h5>
        </center>
        <br>
        <!-- Search Input -->
        <div class="mb-3">
            <input type="text" placeholder="ابحث عن منتج..." dir="rtl" class="form-control rtl-input"
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
                    <th>اسم المنتج</th>
                    <th>القسم</th>
                    <th>متاح حتي</th>
                    <th> الانتهاء</th>
                    <th>السعر</th>
                    <th>بعد الخصم</th>
                    <th> الطلبات </th>
                    <th>الكميه</th>
                    <th>تاريخ الانشاء</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->available_for }}</td>
                        <td>{{ $product->expire_date }}</td>
                        <td>{{ round($product->price) }}</td>
                        <td>{{ round($product->descount) }}</td>
                        <td>{{ $product->orderItems->count() }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    العمليات
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-sm" href="{{ route('admin.products.show' , $product->id) }}">عرض المنتج <i
                                            class="fa fa-eye"></i></a>
                                            <a class="dropdown-item btn-sm text-danger" href="#" wire:click.prevent="deleteProduct({{ $product->id }})">
                                                حذف المنتج <i class="fa fa-trash"></i>
                                            </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">
                           <div class="alert alert-info"> <center class="text-info">لا يوجد منتجات لهذا المتجر بعد...</center></div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>

<style>
    .rtl-input {
        direction: rtl;
        text-align: right;
    }
</style>
