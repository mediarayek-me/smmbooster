<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>  
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('welcome')}}" class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="logo">
                        {{-- {{Helper::settings('website_title')}} --}}
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a class="link" href="@if($links) {{route('welcome').'#welcome'}}@else{{'#welcome'}}@endif" class="active">{{Helper::getLang('Home')}}</a></li>
                        <li><a  class="link services" href="@if($links) {{route('welcome').'#services'}}@else{{'#services'}}@endif">{{Helper::getLang('Services')}}</a></li>
                        <li><a class="link" href="@if($links) {{route('welcome').'#features'}}@else{{'#features'}}@endif">{{Helper::getLang('Features')}}</a></li>
                        <li><a class="link" href="@if($links) {{route('welcome').'#testimonials'}}@else{{'#testimonials'}}@endif">{{Helper::getLang('Testimonials')}}</a></li>
                        <li><a class="link" href="@if($links) {{route('welcome').'#contact-us'}}@else{{'#contact-us'}}@endif">{{Helper::getLang('Contact Us')}}</a></li>
                        @if (Helper::settings('user_login') === 'on')
                        <li class="login"><a href="{{route('login')}}">{{Helper::getLang('login')}} </a></li>
                        @endif
                        @if (Helper::settings('user_registration') === 'on')
                        <li class="try"><a href="{{route('register')}}">{{Helper::getLang('sign up')}}</a></li>
                       @endif
                       <li>
                        <div class="dropdown">
                            <div class="dropdown-toggle pt-2"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <img width="30px" src="{{asset('images/'.$lang->image)}}">
                               <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="dropdown-menu">
                                @foreach ($languages as $language)
                                <a class="dropdown-item" href="{{route('languages.set-language',$language->id)}}"> 
                                     <img width="20px" src="{{asset('images/'.$language->image)}}">     
                                       {{$language->name}}</a>
                                @endforeach
                            </div>
                            </div>
                       </li>
                    </ul>
                    
                   
                   
                  
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
