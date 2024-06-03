  <!-- Page Header Start-->
  <div class="page-main-header">
    <div class="main-header-right row">
        <div class="main-header-left d-lg-none w-auto">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="blur-up lazyloaded d-block d-lg-none"
                        src="{{ asset('default.jpg') }}" alt="">
                </a>
            </div>
        </div>
        <div class="mobile-sidebar w-auto">
            <div class="media-body text-end switch-sm">
                <label class="switch">
                    <a href="javascript:void(0)">
                        <i id="sidebar-toggle" data-feather="align-left"></i>
                    </a>
                </label>
            </div>
        </div>
        <div class="nav-right col">
            <ul class="nav-menus">
                <li>
                   @livewire('admin.search-header')
                </li>
                <li>
                    <a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()">
                        <i data-feather="maximize-2"></i>
                    </a>
                </li>
                <li class="onhover-dropdown">
                    <a class="txt-dark" href="javascript:void(0)">
                        <h6>العربيه</h6>
                    </a>
                    <ul class="language-dropdown onhover-show-div p-20">

                        <li>
                            <a href="javascript:void(0)" data-lng="fr">
                                <i class="flag-icon flag-icon-eg"></i>عربي</a>
                        </li>
                    </ul>
                </li>
                <li class="onhover-dropdown">
                    <i data-feather="bell"></i>
                    <span class="badge badge-pill badge-primary pull-right notification-badge">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span>
                    <span class="dot"></span>
                    <ul class="notification-dropdown onhover-show-div p-0">
                        <li>الاشعارات <span class="badge badge-pill badge-primary pull-right">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span></li>
                        @forelse (Auth::guard('admin')->user()->unreadNotifications as $notification)

                        <li>
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0">
                                        <span>
                                            <i class="shopping-color" data-feather="shopping-bag"></i>
                                        </span><a href="{{ route('admin.notifications.redirectTo' ,$notification->id ) }}">{{ $notification->data['title']}}</a>
                                    </h6>
                                    <p class="mb-0">{{ $notification->data['msg']}}</p>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li>
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="mt-0">
                                        <span>
                                            <i class="shopping-color" data-feather="shopping-bag"></i>
                                        </span>لا يوجد اشعارات جديده
                                    </h6>
                                    <p class="mb-0"></p>
                                </div>
                            </div>
                        </li>
                        @endforelse


                        <li class="txt-dark"><a href="{{ route('admin.notifications.index') }}">كل</a> الاشعارات</li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="right_side_toggle" data-feather="message-square"></i>
                        <span class="dot"></span>
                    </a>
                </li>
                <li class="onhover-dropdown">
                    <div class="media align-items-center">
                        <img class="align-self-center pull-right img-50 blur-up lazyloaded"
                            src="{{ asset('default.jpg') }}" alt="header-user">
                        <div class="dotted-animation">
                            <span class="animate-circle"></span>
                            <span class="main-circle"></span>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                        <li>
                            <a href="">
                                <i data-feather="user"></i>تعديل الملف الشخصي
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contacts.index') }}">
                                <i data-feather="mail"></i>انبوكس
                            </a>
                        </li>
                        <li>
                            <a href="" onclick="lockScreen()">
                                <i data-feather="lock"></i>قفل الشاشه
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i data-feather="settings"></i>الاعدادات
                            </a>
                        </li>
                        <li>
                            <form action="" method="post">
                            @csrf
                            <button class="btn btn-air-light btn-sm" type="submit" value="تسجيل الخروج">
                                <i data-feather="log-out"></i>تسجيل الخروج
                            </button>
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right">
                <i data-feather="more-horizontal"></i>
            </div>
        </div>
    </div>
</div>
<!-- Page Header Ends -->
