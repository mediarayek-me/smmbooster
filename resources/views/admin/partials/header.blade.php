<header id="page-header">
    <div class="content-header">
        <!-- Left Section -->
        <div>
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-dual" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

      
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div>
            <!-- Language Dropdown -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-dual"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user d-sm-none"></i>
                    <i class="fa fa-flag" aria-hidden="true"></i>
                    <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0" id="dropdown" aria-labelledby="page-header-user-dropdown" style="">
                   <div class="list-group">
                       @foreach ($languages as $language)
                       @if(Auth::guard('admin')->check())
                       <a href="{{route('admin.languages.set-language',$language->id)}}" class="list-group-item list-group-item-action text-uppercase"> <img width="20px" src="{{asset('images/'.$language->image)}}">  {{$language->name}}</a>
                       @else
                       <a href="{{route('user.languages.set-language',$language->id)}}" class="list-group-item list-group-item-action text-uppercase"> <img width="20px" src="{{asset('images/'.$language->image)}}">  {{$language->name}}</a>
                       @endif
                       @endforeach
                   </div>
                </div>
            </div>
            <!-- END Language Dropdown -->

            <!-- Notifications Dropdown -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="badge badge-secondary badge-pill">{{$notifications_count}}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown" style="">
                    <div class="bg-primary rounded-top font-w600 text-white text-center p-3">
                        {{Helper::getLang('Notifications')}}
                    </div>
                    <ul class="nav-items my-2">
                        @for($i = 0 ; $i <  4; $i++)
                            @if($notifications->get($i))
                            @php   $notif = $notifications->get($i); @endphp
                            <li @if($notif->viewed == '0') style="background-color:#f7f8f9" @endif >
                                <a class="text-dark media py-2" href="{{Auth::guard('admin')->check()?route('admin.user-notifications.show',$notif->id) : route('user.user-notifications.show',$notif->id)}}">
                                    <div class="mx-3">
                                        <i class="{{$notif['icon']}}"></i>
                                        {{-- fa fa-fw fa-check-circle text-success --}}
                                    </div>
                                    <div class="media-body font-size-sm pr-2">
                                        <div class="font-w600">{{$notif->subject}} </div>
                                        <div class="text-muted font-italic">{{$notif->getTime()}}</div>
                                    </div>
                                </a>
                            </li>
                            @endif
                        @endfor
                       
                    </ul>
                    <div class="p-2 border-top">
                        <a class="btn btn-light btn-block text-center" href="{{Auth::guard('admin')->check()?route('admin.user-notifications.index'): route('user.user-notifications.index')}}">
                            <i class="fa fa-fw fa-eye mr-1"></i> View All
                        </a>
                    </div>
                </div>
            </div>
            <!-- END Notifications Dropdown -->

                  <!-- User Dropdown -->
            <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                        <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-0" id="dropdown" aria-labelledby="page-header-user-dropdown" style="">
                        <div class="bg-primary rounded-top font-w600 text-white text-center p-3">
                            {{Helper::getLang('User Options')}}
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item" href="@if(Auth::guard('admin')->check()) {{route('admin.profil')}} @else {{route('user.profil')}} @endif">
                                <i class="far fa-fw fa-user mr-1"></i> {{Helper::getLang('Profile')}}
                            </a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a  class="dropdown-item admin-logout" href="#">
                                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i>
                                {{Helper::getLang('Sign Out')}}
                                @if(Auth::guard('admin')->check())
                                <form action="{{ route('admin.logout') }}" method="post"> @csrf </form>
                                @else
                                <form action="{{ route('logout') }}" method="post"> @csrf </form>
                                @endif
                            </a>
                        </div>
                    </div>
             </div>
                <!-- END User Dropdown -->
    
        </div>
        <!-- END Right Section -->
    </div>

  
</header>