<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item ">
            <a href="{{ route('profile.dashboard') }}"
               class="nav-link {{ request()->is('profile/dashboard') ? 'active' : '' }}">
                <i class="nav-icon far fa-file"></i>
                <p>
                    {{ __('Dashboard') }}
                </p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('products*') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-paperclip"></i>
                <p>
                    {{ __('Products') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('profile.products.index') }}"
                       class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                        <p>{{ __('My Products') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.products.create') }}" class="nav-link
                    {{ '$isCanCreateProduct' ? '' : 'disabled' }}
                    {{ request()->is('products.create') ? 'active' : '' }}">
                        <p>{{ __('Create Product') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item {{ request()->is('users/*') ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('users/*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-cog"></i>
                <p>
                    {{ __('Profile') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('account.show', auth()->user() ) }}"
                       class="nav-link {{ request()->is('profile/settings') ? 'active' : '' }}">
                        <p>{{ __('Account') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
