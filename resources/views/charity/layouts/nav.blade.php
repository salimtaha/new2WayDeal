<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a title="link" class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
        <div class="nav-item d-flex align-items-center">
            <i class="bx bx-search fs-4 lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2"
                placeholder="ابحــث..." aria-label="أبحــث..." />
        </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- Notification Icon and Dropdown -->
        <li class="nav-item dropdown">
            <a title="link" class="nav-link dropdown-toggle hide-arrow" href="#"
                id="notificationDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bx bx-bell"></i>
                <!-- Notification Icon -->
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                <!-- Notification List Items -->
                @forelse (Auth::guard('charity')->user()->unreadNotifications as $notification)
                    <li>
                        <a class="dropdown-item" href="{{ route('charities.notifications.show' , $notification->id) }}">
                            <div class="d-flex">
                                <div class="me-3">
                                    {{-- <img src="{{ asset('assets/charity') }}/img/avatars/1.png"
                                        alt="Notification Image" class="rounded-circle" /> --}}
                                        <h6 class="mb-1">{{$notification->data['title']  }}</h6>

                                </div>
                                <div>
                                    <p class="mb-0">{{mb_substr( $notification->data['msg'] , 0 ,30) }}.... عرض المزيد </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @empty

                @endforelse




                <!-- Add more notification items as needed -->
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('charities.notifications.index') }}">
                        <i class="bx bx-show"></i> عـرض كـل الأشعـارات
                    </a>
                </li>
            </ul>
        </li>
        <!--/ Notification Icon and Dropdown -->

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a title="link" class="nav-link dropdown-toggle hide-arrow"
                href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img src="{{ asset(Auth::guard('charity')->user()->image) }}" alt
                        class="w-px-40 h-auto rounded-circle" />
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="{{ route('charities.profile.index') }}">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <img src="{{ asset(Auth::guard('charity')->user()->image) }}" alt
                                        class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-medium d-block">{{ Auth::guard('charity')->user()->name }}</span>
                                <small class="text-muted">اسم المؤسسه</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('charities.profile.index') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">ملفــى الشخصــي</span>
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">

                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <form action="{{ route('charities.logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">خــروج</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>
</nav>
