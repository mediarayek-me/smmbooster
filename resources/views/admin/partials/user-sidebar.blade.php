<div class="js-sidebar-scroll">
    <!-- User Info -->
    <div class="smini-hidden">
        <div class="content-side content-side-full bg-black-10 d-flex align-items-center">
            <a class="img-link d-inline-block" href="javascript:void(0)">
                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{asset('images/avatars/'.auth()->user()->avatar)}}" alt="">
            </a>
            <div class="ml-3">
                <a class="font-w600 text-dual" href="javascript:void(0)">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</a>
                <div class="font-size-sm font-italic text-dual">{{Auth::user()->username}}</div>
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Side Navigation -->
    <div class="content-side">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('Dashboad')}}" href="{{route('user.dashboard')}}">
                    <i class="nav-main-link-icon fas fa-tachometer-alt"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Dashboad')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('user.add-funds')}}" href="{{route('user.add-funds')}}">
                    <i class="nav-main-link-icon fas fa-money-bill-wave"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Add funds')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('user.services.index')}}" href="{{route('user.services.index')}}">
                    <i class="nav-main-link-icon fas fa-list"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Services')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('user.orders.index')}}" href="{{route('user.orders.index')}}">
                    <i class="nav-main-link-icon fas fa-clipboard-list"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Orders')}}</span>
                </a>
            </li>
            <li class="nav-main-item {{Helper::isActiveRoute('user.tickets.index')}}">
                <a class="nav-main-link" href="{{route('user.tickets.index')}}">
                    <i class="nav-main-link-icon fas fa-clipboard-list"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Tickets')}}</span>
                </a>
            </li>
            <li class="nav-main-item {{Helper::isActiveRoute('user.transactions.index')}}">
                <a class="nav-main-link" href="{{route('user.transactions.index')}}">
                    <i class="nav-main-link-icon fas fa-random"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Transactions log')}}</span>
                </a>
            </li>
            <li class="nav-main-heading"></li>
        </ul>
    </div>
    <!-- END Side Navigation -->
</div>