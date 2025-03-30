<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <img src="{{ asset('template/image/diversiti.svg') }}" alt="navbar brand" class="navbar-brand me-4 bg-light rounded-circle p-1" height="50" />
                <h1 class="navbar-brand text-light" height="20">DIVERSI-TI</h1>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar ">
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
                @elseif(Auth::user()->isMember())
                    <li class="nav-item {{ Route::is('member-add-member') ? 'active' : '' }}">
                        <a  href="/member-add-member" class="collapsed" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>Members</p>
                        </a>
                    </li>
                @elseif(Auth::user()->ispublisher())
                    <li class="nav-item {{ Route::is('member-add-member') ? 'active' : '' }}">
                        <a  href="/member-add-member" class="collapsed" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>Members</p>
                        </a>
                    </li>
                    <li class="nav-item {{ Route::is('news-index-publisher') ? 'active' : '' }}">
                        <a href="/news-home-publisher" class="collapsed" aria-expanded="false">
                            <i class="fas fa-envelope"></i>
                            <p>News</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
