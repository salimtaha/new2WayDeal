<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret  bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="" target="_blank">
        <img src="{{ asset($setting->logo) }}" class="navbar-brand-img h-100" alt="main_logo" width="200px">
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse px-0 w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link active" href="{{ route('mediators.welcome') }}">
              <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                  <i class="material-icons-round opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text me-1">لوحه القياده</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('mediators.pending.index') }}">
              <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class="material-icons-round opacity-10">hourglass_empty
                </i>
              </div>
              <span class="nav-link-text me-1">الطلبات الحاليه </span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('mediators.rejected.index') }}">
              <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class="material-icons-round opacity-10">highlight_off</i>
              </div>
              <span class="nav-link-text me-1">   الطلبات المرفوضه</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{ route('mediators.accepted.index') }}">
              <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                <i class="material-icons-round opacity-10">assignment_turned_in</i>
              </div>
              <span class="nav-link-text me-1"> الطلبات المقبوله </span>
            </a>
          </li>


        <li class="nav-item">
          <a class="nav-link " href="{{ route('mediators.notifications.index') }}">
            <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text me-1">إشعارات</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link " href="{{ route('mediators.logout') }}">
            <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
              <i class="material-icons-round opacity-10">logout</i>
            </div>
            <span class="nav-link-text me-1">تسجيل الخروج</span>
          </a>
        </li>

      </ul>
    </div>

  </aside>
