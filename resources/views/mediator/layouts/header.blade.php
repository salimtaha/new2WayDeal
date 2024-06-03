  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
            <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="{{ route('mediators.welcome') }}">لوحات القيادة</a></li>
        </ol>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">

        </div>
        <ul class="navbar-nav me-auto ms-0 justify-content-end">
          <li class="nav-item d-flex align-items-center">
            <a href="{{ route('mediators.logout') }}" class="nav-link text-body font-weight-bold px-0">
                <i class="bi bi-person-walking"></i>
              <span class="d-sm-inline d-none">تسجيل خروج</span>
            </a>
          </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <li class="nav-item dropdown ps-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="material-icons-round opacity-10">notifications_none</i>
            </a>
            <ul class="dropdown-menu  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li>
                    <a
                      class="btn bg-gradient-info px-7 mb-2 ms-1"
                      href=""
                    >
                       قراءه الكل </a
                    >
                  </li>
                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="javascript:;">
                      <div class="d-flex py-1">
                        <div class="my-auto">
                          <img src="{{ asset('assets/mediator')}}/img/team-2.jpg" class="avatar avatar-sm  ms-3 ">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold">New message</span> from Laur
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            13 minutes ago
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="javascript:;">
                      <div class="d-flex py-1">
                        <div class="my-auto">
                          <img src="{{ asset('assets/mediator')}}/img/team-2.jpg" class="avatar avatar-sm  ms-3 ">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="text-sm font-weight-normal mb-1">
                            <span class="font-weight-bold">New message</span> from Laur
                          </h6>
                          <p class="text-xs text-secondary mb-0">
                            <i class="fa fa-clock me-1"></i>
                            13 minutes ago
                          </p>
                        </div>
                      </div>
                    </a>
                  </li>

                </li>
              <li>
                <a
                  class="btn bg-gradient-dark px-7 mb-1 ms-1"
                  href="{{ route('mediators.notifications.index') }}">
                  عرض الكل </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
