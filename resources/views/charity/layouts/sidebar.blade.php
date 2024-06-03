<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">2WayDeal</span>
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/charity') }}/img/favicon/favicon.png" alt="" />
            </span>
        </a>

        <a title="link" href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="{{ route('charities.welcome') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">الرئيسيه</div>
            </a>
        </li>
        <!-- Tables -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">محتوى لوحه التحكم</span>
        </li>

        <!-- Users -->
        <li class="menu-item">
            <a href="{{ route('charities.profile.index') }}" class="menu-link">
                <i class='bx bx-universal-access'></i>
                <div data-i18n="Users"> الملف الشخصي </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('charities.members.index') }}" class="menu-link">
                <i class='bx bxs-user-account'></i>
                <div data-i18n="Users"> الاعضاء </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('charities.members.trashed.index') }}" class="menu-link">
                <i class='bx bxs-user-x'></i>
                <div data-i18n="Users"> أرشيف الاعضاء </div>
            </a>
        </li>
        <!-- Donation -->
        <li class="menu-item">
            <a href="{{ route('charities.donations.index') }}" class="menu-link">
                <i class='bx bx-donate-heart'></i>
                <div data-i18n="Donations"> التبرعات </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('charities.donations.accepted.index') }}" class="menu-link">
                <i class='bx bx-cart-add'></i>
                <div data-i18n="Donations"> التبرعات المقبوله </div>
            </a>
        </li>
        <!-- Notifications -->
        <li class="menu-item">
            <a href="{{ route('charities.notifications.index') }}" class="menu-link">
                <i class='bx bx-notification'></i>
                <div data-i18n="Notifications"> الأشعــارات </div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://wa.me/+201098598845"  class="menu-link" target="_blank">
                <i class='bx bx-support'></i>   الدعم الفني
            </a>
        </li>
        <li class="menu-item">
            <form action="{{ route('charities.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn"  class="menu-link">
                    <i class="bx bx-power-off me-2"></i>   تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</aside>
<!-- / Menu -->
