<nav class="main-header navbar navbar-expand navbar-dark navbar-lightblue border-bottom-0 sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

<!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('img/user1-128x128.jpg') }}" alt="User Avatar"
                             class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('img/user8-128x128.jpg') }}" alt="User Avatar"
                             class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('img/user3-128x128.jpg') }}" alt="User Avatar"
                             class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown align-self-center">
            <a data-toggle="dropdown" href="#" class="nav-link px-0">
                <div class="px-2 pb-1">
                    @if(session()->get('locale'))
                        <img class="brand-image img-circle elevation-3 nav-avatar"
                             src="{{ asset('img/country-icons/'.session()->get('locale').'.png') }}" height="18px"
                             alt="">
                    @else
                        <i class="fa fa-language"></i>
                    @endif
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right p-0">
                @foreach($languages as $lang)
                    @if(session()->get('locale') !== $lang)
                        <a href="{{ url('lang/'.$lang) }}" class="dropdown-item px-2 pt-2 pb-2">
                            <img src="{{ asset('img/country-icons/'.$lang.'.png') }}" height="22px" alt="">
                            {{ trans('lang.'.$lang) }}
                        </a>
                    @endif
                @endforeach
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="" data-toggle="dropdown" href="#">
                <div class="px-2">
                    <img class="brand-image img-circle elevation-3 nav-avatar" width="30px"
                         src="{{ asset(auth()->user()->avatar) }}"
                         alt="Avatar">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="navbarDropdown">
                <a class="dropdown-item p-0" href="{{ route('users.profile') }}">
                    <span class="dropdown-item dropdown-header text-capitalize name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item p-0" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <span class="dropdown-item dropdown-header text-capitalize">{{ trans('auth.logout') }}</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
        {{--                <i class="fas fa-th-large"></i>--}}
        {{--            </a>--}}
        {{--        </li>--}}
    </ul>
</nav>
