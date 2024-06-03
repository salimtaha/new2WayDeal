@extends('admin.layouts.app')

@section('title', 'تفاصيل المنتج')

@section('body')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> تفاصيل المنتج
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
                        <li class="breadcrumb-item "><a href="{{ route('admin.products.index') }}">
                                المنتجات </a></li>
                        <li class="breadcrumb-item active"><a href="">
                                {{ $product->name }} </a></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }} <strong
                                        class="badge badge-pill {{ $product->deleted_at == null ? 'bg-success' : 'bg-primary' }}">{{ $product->deleted_at == null ? ' المنتج نشط ' : ' المنتج محذوف  ' }}</strong>
                                    @if ($product->deleted_at != null)
                                        <a href="{{ route('admin.products.trashed.restore', $product->id) }}"
                                            style="margin-right: 10px" class="gap-1"> استرجاع
                                            <i class="fa fa-undo" aria-hidden="true"></i></i></a>
                                    @endif
                                </h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div type="text" class="form-control" readonly>اسم المتجر :
                                            {{ $product->store->name }}</div>
                                        <input type="text" class="form-control" readonly
                                            value="السعر :  {{ round($product->price) }}">
                                        <input type="text" class="form-control" readonly
                                            value="بعد الخصم : {{ round($product->descount) }}">
                                        <input type="text" class="form-control" readonly
                                            value="القسم  : {{ $product->category->name }}">
                                        <input type="text" class="form-control" readonly
                                            value="تاريخ النشر : {{ $product->created_at }}">
                                        @if ($product->deleted_at != null)
                                            <input type="text" class="form-control" readonly
                                                value="تاريخ الحذف : {{ $product->deleted_at }}">
                                        @endif
                                    </div>
                                    @php
                                        $store_rate = App\Models\StoreRate::where('store_id', $product->store->id)
                                            ->select(DB::raw('AVG(value) as rate'))
                                            ->get();
                                        $store_rate = $store_rate[0]->rate;
                                    @endphp
                                    <div class="col-md-6">

                                        <div type="text" class="form-control" readonly>
                                            تقيم المتجر :
                                            <i class="fa @if ($store_rate >= 1) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store_rate >= 2) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store_rate >= 3) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store_rate >= 4) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>
                                            <i class="fa @if ($store_rate >= 5) fa-star @else fa-star-o @endif"
                                                aria-hidden="true"></i>

                                        </div>

                                        <input type="text" class="form-control" readonly
                                            value="متاح حتي : {{ $product->available_for }}">
                                        <input type="text" class="form-control" readonly
                                            value="تاريخ الانتهاء : {{ $product->expire_date }}">
                                        <input type="text" class="form-control" readonly
                                            value="الكميه المتوفره : {{ $product->quantity }}">
                                        <input type="text" class="form-control" readonly
                                            value=" عدد الطلبات : {{ $product->orderItems->count() }}">
                                    </div>
                                </div>
                                <br><br>
                                <span style="display: flex;">
                                    @if ($product->deleted_at == null)
                                        <form action="{{ route('admin.products.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $product->id }}" name="id">
                                            <button type="submit" href="" class="btn btn-danger"> حذف <i
                                                    class="fa fa-trash"></i> </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.products.trashed.forceDelete') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{ $product->id }}" name="id">
                                            <button type="submit" href="" class="btn btn-danger"> حذف نهائياً <i
                                                    class="fa fa-trash"></i> </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.stores.show', $product->store->id) }}"
                                        style="margin-right: 10px" class="btn btn-secondary gap-1"> المتجر
                                        <i class="fa fa-user" aria-hidden="true"></i></a>
                                </span>


                                <!-- Add a button here for delete or other actions -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach ($product->images as $key => $image)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                            class="{{ $loop->first ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($product->images as $image)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img style="height: 400px" class="d-block w-100 "
                                                src="{{ asset($image->image) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">السابق</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">التالي</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="roe justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h3 class="justify-content-center text-center">
                                    الطلبات الخاصه بهذا المنتج
                                </h3><br>
                                <table class="table shadow-card">
                                    <thead>
                                        <tr>
                                            <th># </th>
                                            <th>اسم العميل</th>
                                            <th>اسم المنتج</th>
                                            <th> الكميه</th>
                                            <th>تاريخ الطلب</th>
                                            <th>رقم الاوردر</th>
                                            <th>رقم الجوال</th>
                                            <th>رقم الشحن</th>
                                            <th> حاله الطلب </th>
                                            <th>بروفايل العميل</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // $product_orders = $product->orderItems()->whereRelation('order','deleted_at' ,'=', null)->paginate(5);
                                            $product_orders = $product->orderItems()->paginate(5);
                                        @endphp
                                        @forelse ($product_orders as $order_item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order_item->order->name }}</td>
                                                <td>{{ $order_item->product_name }}</td>
                                                <td>{{ $order_item->product_quantity }}</td>
                                                <td>{{ $order_item->created_at }}</td>
                                                <td>{{ $order_item->order->id }}</td>
                                                <td>{{ $order_item->order->user->phone ?? 'المستخدم محذوف' }}</td>
                                                <td>{{ $order_item->order->phone }}</td>
                                                <td>{{ $order_item->order->status }}</td>
                                                <td>
                                                    @if($order_item->order->user)
                                                    <a style="color: black"
                                                    href="{{ route('admin.users.show', $order_item->order->user->id) }}">
                                                   عرض <i class="fa fa-eye"></i>
                                                </a>
                                                    @else
                                                     المستخدم محذوف

                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11">
                                                    <div class="alert alert-info">
                                                        <center class="text-info">لا يوجد طلبات لهذا المنتج بعد...</center>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $product_orders->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>




@endsection
@push('css')
    <style>
        .rtl-input {
            direction: rtl;
            text-align: right;
        }
    </style>
@endpush
@push('js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush
