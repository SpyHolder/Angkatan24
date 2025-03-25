<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('template/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                @if(Auth::user()->isAdmin())
                    <li class="nav-item {{ request()->is('news-home-admin')||request()->is('news-add-admin') ? 'active' : '' }}">
                        <a  href="/news-home-admin" class="collapsed" aria-expanded="false">
                            <i class="fas fa-envelope"></i>
                            <p>News</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('member-home-admin')||request()->is('member-add-admin') ? 'active' : '' }}">
                        <a href="/member-home-admin" class="collapsed" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>Members</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('user-home-admin')||request()->is('user-add-admin') ? 'active' : '' }}">
                        <a  href="/user-home-admin" class="collapsed" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->isMember())
                    <li class="nav-item {{ request()->is('member-add-member')||request()->is('member-add') ? 'active' : '' }}">
                        <a href="/member-add-member" class="collapsed" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>Members</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
