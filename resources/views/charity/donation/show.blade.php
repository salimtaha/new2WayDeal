@extends('charity.layouts.app')
@section('title' , 'بيانات التجر ')

@section('body')
@push('css')
<style>
    .twemoji--star {
  display: inline-block;
  width: 1rem;
  height: 1rem;
  background-repeat: no-repeat;
  background-size: 100% 100%;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 36 36'%3E%3Cpath fill='%23ffac33' d='M27.287 34.627c-.404 0-.806-.124-1.152-.371L18 28.422l-8.135 5.834a1.97 1.97 0 0 1-2.312-.008a1.971 1.971 0 0 1-.721-2.194l3.034-9.792l-8.062-5.681a1.98 1.98 0 0 1-.708-2.203a1.978 1.978 0 0 1 1.866-1.363L12.947 13l3.179-9.549a1.976 1.976 0 0 1 3.749 0L23 13l10.036.015a1.975 1.975 0 0 1 1.159 3.566l-8.062 5.681l3.034 9.792a1.97 1.97 0 0 1-.72 2.194a1.957 1.957 0 0 1-1.16.379'/%3E%3C/svg%3E");
}
</style>
@endpush
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">بيانات المتجر المتبرع</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">المتجر</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset($donation->store->image) }}"
                            alt="user-avatar" class="img-thumbnail  img-fluid rounded" style="width: 150px;height:150px" id="uploadedAvatar" />

                        </div>
                    </div>
                    <hr class="my-0" />
                    <id class="card-body">
                        <form id="formAccountSettings" >
                            @csrf
                            <div class="row">
                               @if($errors->any())
                               <div class="mb-3 col-md-12 alert-danger" id="errorAlert">
                                <ul>
                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }} ☹</li>

                                    @endforeach
                                </ul>
                               </div>
                               @endif

                                <div class="mb-3 col-md-6">
                                    <label for="charityName" class="form-label">أسم المتجر</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->store->name }}</label>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">البريد الألكتروني</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->store->email }}</label>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">رقــم الهـاتف</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->store->phone }}</label>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">العنــوان</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->store->street }}</label>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">المحافظه</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->store->governorate->name }} </label>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">المدينه</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->store->city->name }} </label>

                                </div>




                                 <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">تقييم المتجر </label>
                                    {{-- <label class="form-control" type="text" id="charityName">{{ $donation->store->description }} </label> --}}
                                    @if($store['rate']>0)
                                    <span class="twemoji--star"></span>
                                    @endif
                                    @if($store['rate']>1)
                                    <span class="twemoji--star"></span>
                                    @endif
                                    @if($store['rate']>2)
                                    <span class="twemoji--star"></span>
                                    @endif
                                    @if($store['rate']>3)
                                    <span class="twemoji--star"></span>
                                    @endif
                                    @if($store['rate']>4)
                                    <span class="twemoji--star"></span>
                                    @endif

                                  </div>

                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">التبرع</label>
                                    <label class="form-control" type="text" id="charityName">{{ $donation->meals }} </label>

                                </div>

                                <div class="mt-2">
                                    @if ($donation->status == "pending")
                                    <a href="{{ route('charities.donations.accept' , $donation->id) }}"  class="btn btn-primary me-2">
                                        قبول التبرع
                                     </a>

                                    @endif
                                    @if($donation->status != "canceld")
                                    <a href="{{ route('charities.donations.canceld' , $donation->id) }}"  class="btn btn-outline-secondary">
                                        رفض التبرع
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </id>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
 <!-- / Content -->

</div>


@endsection
