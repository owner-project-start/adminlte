<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <a href="#" class="brand-link navbar-lightblue border-bottom-0">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ trans('sidebar.dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-header">{{ trans('sidebar.header.access_management') }}</li>
                <li class="nav-item">
                    <a href="{{ route('users') }}"
                       class="nav-link {{ (request()->is('user-managements/users*')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('sidebar.access_management.users') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles') }}"
                       class="nav-link {{ (request()->is('user-managements/roles*')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('sidebar.access_management.roles') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('permissions') }}"
                       class="nav-link {{ (request()->is('user-managements/permissions*')) ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('sidebar.access_management.permissions') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
