@extends('charity.layouts.app')
@section('title', 'الرئيسيه')

@section('body')

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-8 mb-4 order-0">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">مرحباً بك في To WayDeal 🎉</h5>
                  <p class="mb-4">
                   نعمل جاهدين <span class="fw-bold"> علي  </span>تقديم المساعدات الانسانيه
                   الي المؤسسات الخيريه لنكن ايد عون لها .
                  </p>

                  <a href="{{ route('charities.profile.index') }}" class="btn btn-sm btn-outline-primary"> الملف الشخصي  </a>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body">
                  {{-- <img style="margin-bottom: 50px"
                    src="{{ asset('assets/images/favicon.png') }}"

                    alt="View Badge User"
                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                    data-app-light-img="illustrations/man-with-laptop-light.png"
                  /> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
          <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="{{ asset('assets/charity/img/icons/brands/slack.png') }}"
                        alt="chart success"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                        <a class="dropdown-item" href="{{ route('charities.members.index') }}"> الاعضاء</a>
                        <a class="dropdown-item" href="{{ route('charities.members.trashed.index') }}">الارشيف</a>
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1"> الاعضاء هذ الشهر</span>
                  <h3 class="card-title mb-2">{{ $currentMonthMembersCount }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($percentageIncrease, 2) }}%</small>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="{{ asset('assets/charity/img/icons/brands/asana.png') }}"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt6"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                        <a class="dropdown-item" href="{{ route('charities.donations.index') }}">التبرعات </a>
                        <a class="dropdown-item" href="{{ route('charities.donations.accepted.index') }}"> المقبوله</a>
                      </div>
                    </div>
                  </div>
                  <span>التبرعات هذا الشهر</span>
                  <h3 class="card-title text-nowrap mb-1">{{ $currentMonthDonationsCount }}</h3>
                  <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +{{ number_format($percentageIncreaseDonation, 2) }}%</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="row">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">احصائيات التبرعات</div>

                        <div class="card-body">

                            {!! $chart1->renderHtml() !!}

                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">احصائيات الاعضاء</div>

                        <div class="card-body">

                            {!! $chart2->renderHtml() !!}

                        </div>

                    </div>
                </div>
            </div>

        </div>
      </div>

@endsection
@push('js')
{!! $chart1->renderChartJsLibrary() !!}

{!! $chart1->renderJs() !!}
{!! $chart2->renderJs() !!}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
</script>
@endpush
