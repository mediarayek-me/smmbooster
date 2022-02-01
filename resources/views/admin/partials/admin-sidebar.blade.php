<div class="js-sidebar-scroll">
    <!-- User Info -->
    <div class="smini-hidden">
        <div class="content-side content-side-full bg-black-10 d-flex align-items-center">
            <a class="img-link d-inline-block" href="javascript:void(0)">
                <img class="img-avatar img-avatar48 img-avatar-thumb"
                    src="{{asset('images/avatars/'.auth()->user()->avatar)}}" >
            </a>
            <div class="ml-3">
                <a class="font-w600 text-dual" href="javascript:void(0)">{{ Auth::user()->firstname }}
                    {{ Auth::user()->lastname }}</a>
                <div class="font-size-sm font-italic text-dual">{{ Auth::user()->username }}</div>
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Side Navigation -->
    <div class="content-side">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('admin.dashboard')}}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-main-link-icon fas fa-tachometer-alt"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Dashboad')}}</span>
               </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('admin.services.index')}}" href="{{ route('admin.services.index') }}">
                    <i class="nav-main-link-icon fas fa-list"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Services')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link  {{Helper::isActiveRoute('admin.categories.index')}}" href="{{ route('admin.categories.index') }}">
                    <i class="nav-main-link-icon fas fa-tags"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Categories')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link  {{Helper::isActiveRoute('admin.orders.index')}}" href="{{ route('admin.orders.index') }}">
                    <i class="nav-main-link-icon fas fa-clipboard-list"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Orders')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link  {{Helper::isActiveRoute('admin.tickets.index')}}{{Helper::isActiveRoute('admin.tickets.show')}}" href="{{ route('admin.tickets.index') }}">
                    <i class="nav-main-link-icon fas fa-clipboard-list"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Tickets')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link  {{Helper::isActiveRoute('admin.transactions.index')}}" href="{{ route('admin.transactions.index') }}">
                    <i class="nav-main-link-icon fas fa-random"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Transactions')}}</span>
                </a>
            </li>
            <li class="nav-main-item {{Helper::isNavOpen(['admin.users.index','admin.admins.index'])}}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                    aria-expanded="true" href="#">
                    <i class="nav-main-link-icon fa fa-users"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Users managment')}}</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.users.index')}}" href="{{ route('admin.users.index') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Regular users')}} </span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link {{Helper::isActiveRoute('admin.admins.index')}}" href="{{ route('admin.admins.index') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Admins')}}</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('admin.api-providers.index')}} " href="{{ route('admin.api-providers.index') }}">
                    <i class="nav-main-link-icon fas fa-network-wired"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('API Providers')}}</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link {{Helper::isActiveRoute('admin.payment-methods.index')}}" href="{{ route('admin.payment-methods.index') }}">
                    <i class="nav-main-link-icon fas fa-money-check-alt"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('Payments Methods')}}</span>
                </a>
            </li>
            <li class="nav-main-item  {{Helper::isNavOpen(['admin.settings.general','admin.settings.default','admin.settings.apparence','admin.languages.index','admin.settings.seo','admin.settings.policy','admin.settings.config-emails','admin.settings.emails','admin.faqs.index','admin.faqs.index','admin.languages.show','admin.announcements.index'])}}">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                    aria-expanded="true" href="#">
                    <i class="nav-main-link-icon fa fa-cogs"></i>
                    <span class="nav-main-link-name">{{Helper::getLang('System Settings')}}</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.general')}}" href="{{ route('admin.settings.general') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('General Settings')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.default')}}" href="{{ route('admin.settings.default') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Service Settings')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.apparence')}}" href="{{ route('admin.settings.apparence') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Appearance')}}</span>
                        </a>
                    </li>
                     <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.languages.index')}}{{Helper::isActiveRoute('admin.languages.show')}}" href="{{ route('admin.languages.index') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Languages')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.seo')}}" href="{{ route('admin.settings.seo') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Seo Manager')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.policy')}}" href="{{ route('admin.settings.policy') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Terms and Policy')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.emails')}}" href="{{ route('admin.settings.emails') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Email Templates')}}</span>
                        </a>
                    </li>
                     <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.settings.config-emails')}}" href="{{ route('admin.settings.config-emails') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Email Settings')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.faqs.index')}}" href="{{ route('admin.faqs.index') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('FAQs')}}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link  {{Helper::isActiveRoute('admin.announcements.index')}}" href="{{ route('admin.announcements.index') }}">
                            <span class="nav-main-link-name">{{Helper::getLang('Announcements')}}</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="nav-main-heading"></li>
            
        </ul>
    </div>
    <!-- END Side Navigation -->
</div>
