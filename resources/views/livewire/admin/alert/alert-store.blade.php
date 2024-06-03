<div class="main_section ">
    <div class="container rtl">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        </div>
                        @php
                            $alerts_count = $store->alerts->count();
                        @endphp
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize"> عدد التحذيرات </p>
                            <h4 class="mb-0">{{ $alerts_count }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">
                                العدد المتبقي للتقيد
                            </span>
                            @if ($store->status != 'blocked')
                                {{ 4 - $alerts_count }}
                            @else
                                الحساب محظور
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                        </div>
                        @php
                            //Store Rate
                            $store_rate = App\Models\StoreRate::where('store_id', $store->id)
                                ->select(DB::raw('AVG(value) as rate'))
                                ->get();
                            $store_rate = $store_rate[0]->rate;
                            $store_rate = round($store_rate);
                        @endphp
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize"> تقييم المتجر</p>
                            <h4 class="mb-0">
                                <i class="fa  @if ($store_rate >= 2) fa-star @else fa-star-o @endif"
                                    aria-hidden="true"></i>
                                <i class="fa @if ($store_rate >= 2) fa-star @else fa-star-o @endif"
                                    aria-hidden="true"></i>
                                <i class="fa @if ($store_rate >= 3) fa-star @else fa-star-o @endif"
                                    aria-hidden="true"></i>
                                <i class="fa @if ($store_rate >= 4) fa-star @else fa-star-o @endif"
                                    aria-hidden="true"></i>
                                <i class="fa @if ($store_rate >= 5) fa-star @else fa-star-o @endif"
                                    aria-hidden="true"></i>
                            </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">
                                الجوده
                            </span>
                            @if ($store_rate == 1)
                                سئ جدا✨
                            @elseif($store_rate == 2)
                                سئ✨✨
                            @elseif($store_rate == 3)
                                جيد✨✨✨
                            @elseif($store_rate == 4)
                                جيد جدا✨✨✨✨
                            @elseif($store_rate == 5)
                                اقص دره ✨✨✨✨✨
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize"> عدد المنتجات الكلي </p>
                            <h4 class="mb-0">
                                <span class="text-danger text-sm font-weight-bolder ms-1"></span>
                                {{ $store->products()->withTrashed()->count() }}
                            </h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">
                                عدد المنتجات الحالي
                            </span>{{ $store->products()->count() }} </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize">محاولات السحب الكلي</p>
                            <h4 class="mb-0">{{ $store->withdrawals->count() }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1"> السحب
                                الناجح </span>
                            {{ $store->withdrawals->where('status', 'accepted')->count() }} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="chat_container">
            {{-- <center> --}}
            <div class="col-sm-12 message_section">
                <div style="background: white" class="row">
                    <div class="new_message_head">
                        <div class="pull-right" ><i class="fa fa-plus-square-o" aria-hidden="true"></i>عرض :
                                 <a href="{{ route('admin.stores.show' , $store->id) }}">{{ $store->name }}  <i class="fa fa-male" aria-hidden="true"></i></a></div>
                        <div class="pull-right">

                        </div>

                        <div class="invoice-btn-section clearfix d-print-none">
                           @if($store->alerts()->exists())
                           <button wire:click.prevent="deleteAllAlerts" class="btn btn-md btn-danger">
                            حذف الجميع<i class="fa fa-trash"></i>
                        </button>
                           @endif
                            @if ($store->status == 'blocked')
                                <button wire:click.prevent="unBlocked" style="color: white" class="btn btn-md btn-secondary btn-theme">
                                    رفع الحظر <i class="fa fa-unlock" aria-hidden="true"></i>
                                </button>
                            @endif
                        </div>
                    </div><!--new_message_head-->
                    <div class="chat_area">
                        <ul class="list-unstyled">
                            @forelse ($alerts as $alert)
                                <li class="rigth clearfix" style=" direction: rtl;">
                                    <span class="chat-img1 pull-left" style=" direction: rtl;">
                                        <img class=" badge-pill" src="{{ asset($store->image) }}" alt="User Avatar"
                                            class="img-circle">
                                    </span>
                                    <div class="chat-body1 clearfix" style=" direction: rtl;">
                                        <strong>{{ $alert->title }}</strong>
                                        <div style=" direction: rtl;">{{ $alert->body }}..<button class="btn"
                                                wire:click="delete({{ $alert->id }})"><i
                                                    class="fa fa-trash"></i></button></div>
                                        <div class="chat_time pull-left">{{ $alert->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </li><br>
                            @empty
                                <div class="alert alert-info"><strong>لا يوجد تحذيرات سابقه لهذا المتجر</strong></div>
                            @endforelse


                        </ul>
                    </div><!--chat_area-->
                    <div class="message_write rtl">
                        @if (session()->has('success'))
                            <div class="error alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form wire:submit.prevent="saveAlert">

                            <input type="hidden" wire:model="store_id" value="{{ $store->id }}">
                            <input class="form-control" placeholder="عنوان الاخطار هنا ..." type="text"
                                wire:model="title">
                            @error('title')
                                <div class="error alert alert-danger">{{ $message }}</div>
                            @enderror
                            <textarea wire:model="body" class="form-control" placeholder="الموضوع هنا  ..."></textarea>
                            @error('body')
                                <div class="error alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="clearfix"></div>
                            <div class="chat_bottom">
                                {{-- <a href="#" class="pull-right upload_btn"><i
                                class="fa fa-cloud-upload" aria-hidden="true"></i>
                            أرفاق ملف </a> --}}
                                <button type="submit" class="pull-left btn btn-success">
                                    أرسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!--message_section-->
        </center>
    </div>
</div>
</div>

<script>

</script>
<link rel="stylesheet" href="{{ asset('assets/admin/alertStore/style.css') }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://use.fontawesome.com/45e03a14ce.js"></script>
