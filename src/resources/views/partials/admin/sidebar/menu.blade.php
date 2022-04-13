<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item ">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon far fa-file"></i>
                <p>
                    {{ __('Dashboard') }}
                </p>
            </a>
        </li>
        @role('admin')
        <li class="nav-item {{ request()->routeIs('users.index')  ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                <i class="nav-icon far fa-user"></i>
                <p>
                    {{ __('Users') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index'); }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                        <p>{{ __('All Users') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.create'); }}" class="nav-link {{ request()->is('users/create') ? 'active' : '' }}">
                        <p>{{ __('Create User') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endrole
        @role('admin')
        <li class="nav-item {{ request()->routeIs('roles.index')  ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                <i class="nav-icon far fa-user"></i>
                <p>
                    {{ __('Roles') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('roles.index'); }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                        <p>{{ __('All Roles') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.create'); }}" class="nav-link {{ request()->is('roles/create') ? 'active' : '' }}">
                        <p>{{ __('Create Role') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endrole
        @role('admin')
        <li class="nav-item {{ request()->routeIs('permissions.index')  ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}">
                <i class="nav-icon far fa-user"></i>
                <p>
                    {{ __('Permissions') }}
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('permissions.index'); }}" class="nav-link {{ request()->is('permissions') ? 'active' : '' }}">
                        <p>{{ __('All Permissions') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions.create'); }}" class="nav-link {{ request()->is('permissions/create') ? 'active' : '' }}">
                        <p>{{ __('Create Permissions') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        @endrole
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
                    <a href="{{ route('products.index') }}" class="nav-link {{ request()->is('products') ? 'active' : '' }}">
                        <p>{{ __('All Products') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.create') }}" class="nav-link {{ request()->is('products.create') ? 'active' : '' }}">
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
                    <a href="{{ route('users.show', auth()->user()->id ) }}" class="nav-link {{ request()->is('users/*') ? 'active' : '' }}">
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
