@extends('admin.layouts.app')

@section('title', 'الصفحه الرئيسيه')
@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" /> --}}
@endpush
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="warning-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="home" class="font-warning"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">المؤسسات الخيريه</span>
                                <h3 class="mb-0"> <span class="counter">{{ $counts['charities'] }}</span><small>
                                        هذا الشهر
                                    </small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="secondary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="user" class="font-secondary"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller">
                                <span class="m-0">المستخدمين</span>
                                <h3 class="mb-0"> <span class="counter">{{ $counts['users'] }}</span><small>
                                        هذا الشهر
                                    </small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="primary-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center">
                                    <i data-feather="dollar-sign" class="font-primary"></i>
                                    {{-- <i data-feather="message-square" class="font-primary"></i> --}}
                                </div>
                            </div>
                            <div class="media-body media-doller"><span class="m-0"> المبيعات</span>
                                <h3 class="mb-0">$ <span class="counter">{{ $counts['orders'] }}</span><small>

                                        هذا الشهر</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="danger-box card-body">
                        <div class="media static-top-widget align-items-center">
                            <div class="icons-widgets">
                                <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i>
                                </div>
                            </div>
                            <div class="media-body media-doller"><span class="m-0">
                                    المتاجر</span>
                                <h3 class="mb-0"> <span class="counter">{{ $counts['vendors'] }}</span><small>
                                        هذا الشهر</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">احصائيات المستخدمين</div>

                    <div class="card-body">

                        {!! $chart1->renderHtml() !!}

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">احصائيات المتاجر</div>

                    <div class="card-body">

                        {!! $chart2->renderHtml() !!}

                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">احصائيات المؤسسات</div>

                    <div class="card-body">

                        {!! $chart3->renderHtml() !!}

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">احصائيات  حاله الطلبات</div>

                    <div class="card-body">

                        {!! $chart4->renderHtml() !!}

                    </div>

                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">احصائيات طلبات السحب</div>

                    <div class="card-body">

                        {!! $chart5->renderHtml() !!}

                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">احصائيات  عدد الطلبات</div>

                    <div class="card-body">

                        {!! $chart6->renderHtml() !!}

                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection


@push('css')
    @push('css')
        <style>
            .parent {
                width: 100%;
                height: 100%;
                box-shadow: 0 0 10px rgba(176, 158, 158, 0.1);


            }

            .container {
                background: white;
            }

            .calendar {
                margin-top: 80px;
                width: 100%;
                height: 100%;
                box-shadow: 0 0 10px rgba(176, 158, 158, 0.1);
            }
        </style>
    @endpush
@endpush

@push('js')
    {!! $chart1->renderChartJsLibrary() !!}

    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
    {!! $chart3->renderJs() !!}
    {!! $chart4->renderJs() !!}
    {!! $chart5->renderJs() !!}
    {!! $chart6->renderJs() !!}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#myTab a').click(function() {
                var href = $(this).attr('href');
                if (href == "[href^='tab-']") {
                    $('.tab-pane').css('display', 'none');
                    $("[class^='etab-'][class^='etabi-']").removeClass('show');
                    $("[class^='etab-'][class^='etabi-']").css('display', 'block');
                    $("[class^='etab-'][class^='etabi-']").addClass('show');
                }
            });
        });
    </script>
@endpush
