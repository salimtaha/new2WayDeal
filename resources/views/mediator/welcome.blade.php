@extends('mediator.layouts.app')

@section('title' , 'الرئيسيه')

@section('body')
<div class="row">
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-start pt-1">
            <p class="text-sm mb-0 text-capitalize"> سحب اليوم المقبول</p>
            <h4 class="mb-0">{{ $count['withdrawal_accepted_today'] }} جنيه </h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">{{$count['withdrawal_today'] }} </span>سحب اليوم الكلي</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">leaderboard</i>
          </div>
          <div class="text-start pt-1">
            <p class="text-sm mb-0 text-capitalize">مستخدمو السحب المقبول</p>
            <h4 class="mb-0">{{ $count['num_of_stores_make_accepted_withdrawals'] }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">{{ $count['num_of_stores_make_withdrawals'] }} </span>مستخدمو السحب الكلي</p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">account_balance_wallet</i>
          </div>
          <div class="text-start pt-1">
            <p class="text-sm mb-0 text-capitalize"> سحب اليوم المرفوض</p>
            <h4 class="mb-0">
              <span class="text-danger text-sm font-weight-bolder ms-1"></span>
              {{ $count['rejected_withdrawal_today'] }}
            </h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">{{ $count['rejected_withdrawal'] }} </span>مبلغ السحب المرفوض الكلي  </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6">
      <div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">account_balance</i>
          </div>
          <div class="text-start pt-1">
            <p class="text-sm mb-0 text-capitalize">السحب الكلي المقبول</p>
            <h4 class="mb-0">{{ $count['total_accepted_withdrawals'] }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
          <p class="mb-0 text-start"><span class="text-success text-sm font-weight-bolder ms-1">{{ $count['total_withdrawals'] }}</span>  السحب الكلي </p>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="row mt-4">
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2 ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">مشاهدات الموقع</h6>
          <p class="text-sm ">آخر أداء للحملة</p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto ms-1">schedule</i>
            <p class="mb-0 text-sm"> الحملة أرسلت قبل يومين </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card z-index-2  ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 "> المبيعات اليومية </h6>
          <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) زيادة في مبيعات اليوم. </p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto ms-1">schedule</i>
            <p class="mb-0 text-sm"> تم التحديث منذ 4 دقائق </p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mt-4 mb-3">
      <div class="card z-index-2 ">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
          <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
            <div class="chart">
              <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
            </div>
          </div>
        </div>
        <div class="card-body">
          <h6 class="mb-0 ">المهام المكتملة</h6>
          <p class="text-sm ">آخر أداء للحملة</p>
          <hr class="dark horizontal">
          <div class="d-flex ">
            <i class="material-icons text-sm my-auto me-1">schedule</i>
            <p class="mb-0 text-sm">تم تحديثه للتو</p>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row mb-3">
            <div class="col-6">
              <h6>اخر طلبات السحب</h6>
              <p class="text-sm">
                <i class="fa fa-check text-info" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1">{{ now()->format('Y-m-d') }}</span> اليوم
              </p>
            </div>
            <div class="col-6 my-auto text-start">
              <div class="dropdown float-start ps-4">
                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-n4" aria-labelledby="dropdownTable">
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">عمل</a></li>
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">عمل آخر</a></li>
                  <li><a class="dropdown-item border-radius-md" href="javascript:;">شيء آخر هنا</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body p-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">اسم المتجر</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الصوره</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المبلغ</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النسبه من رصيد الحساب% </th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">طريقه السحب</th>
                </tr>
              </thead>
              <tbody>
               @forelse ($latest_withdrawals as $withdrawal)
               <tr>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div>
                      <img src="{{ asset('assets/charity/img/icons/unicons/cc-success.png')}}" class="avatar avatar-sm ms-3">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $withdrawal->store->name }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="avatar-group mt-2">
                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $withdrawal->store->name }}">
                      <img alt="Image placeholder" src="{{ asset($withdrawal->store->image)}}">
                    </a>
                  </div>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold"> {{ $withdrawal->amount }}  (ج) </span>
                </td>
                <td class="align-middle">
                  <div class="progress-wrapper w-75 mx-auto">
                    <div class="progress-info">
                      <div class="progress-percentage">
                        <span class="text-xs font-weight-bold">{{ceil(($withdrawal->amount/$withdrawal->store->account->value)*100) }}%</span>
                      </div>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info w-{{ ceil((($withdrawal->amount/$withdrawal->store->account->value)*100) / 10)*10 }}" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="text-xs font-weight-bold"> {{ $withdrawal->method->name }} </span>
                  </td>
              </tr>
               @empty

               @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>نظرة عامة على وسائل السحب</h6>
                <p class="text-sm">
                    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold">24%</span> هذا الشهر
                </p>
            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">

                    @forelse ($methods as $method)
                    <div class="timeline-block mb-3">
                        <span class="timeline-step">
                            <i class="material-icons text-warning text-gradient">credit_card</i>
                        </span>
                        <div class="timeline-content">
                            <div class="row">
                                <div class="col-md-6 text-dark text-sm font-weight-bold mb-0">{{ $method->name }}</div>
                                <div class="col-md-6 text-dark text-sm font-weight-bold mb-0"> عمليات السحب : {{ $method->withdrawals->count() }}</div>
                            </div>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $method->created_at->format('Y-m-d h:m') }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="alert alert-info">لا يوجد وسائل سحب بعد !</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

  </div>
@endsection
