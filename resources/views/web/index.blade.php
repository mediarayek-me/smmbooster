@extends('layouts.app')

@section('content')

<!--- Header Start ---->
@include('web/partials/header',['links'=>false])

<!-- ***** Welcome Area Start ***** -->
<div class="welcome-area" id="welcome">

    <!-- ***** Header Text Start ***** -->
    <div class="header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>{{ Helper::getLang('Worldwide Top Quality Social Media Panel') }}
                    </h1>
                    <p>{{ Helper::getLang('As a member of our website, you can quickly gain popularity on social media. You can buy likes and followers on your social media account in the fastest way. Add balance and start processing with the Auto Online Payment and Money Transfer methods, instantly') }}
                    </p>
                    <a href="#services">{{ Helper::getLang('See All Services') }}</a>
                </div>
                <div class="col-md-6">
                    <img class="w-100" src="{{ asset('assets/images/welcome.png') }}"
                        alt="welcome">
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Header Text End ***** -->
</div>
<!-- ***** Welcome Area End ***** -->

<!-- ***** About ***** -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 align-self-center"
                data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <img src="assets/images/left-image.png" class="p-0 rounded img-fluid d-block mx-auto" alt="App">
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix">
                <div class="left-heading">
                    <h2 class="section-title">
                        {{ Helper::getLang('Affordable Price and Fast Delivery Guarantee!') }}
                    </h2>
                </div>
                <div class="left-text">
                    <p>{{ Helper::getLang('We provide the oldest and most reliable automated social media services. System is a fully automated and has a structure where you can get followers, likes, views and more without sharing your password.') }}
                    </p>
                    <a href="#">{{ Helper::getLang('Sign up') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** About End ***** -->


<!-- ***** services Start ***** -->
<section class="section" id="services">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ Helper::getLang('services') }}</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p> {{ Helper::getLang('Our services can help you to understand your account better and your account will  become more effective.') }}
                    </p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.8s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fab fa-facebook-square"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('facebook') }}</h5>
                            <p>{{ Helper::getLang('Our Quality SMM Panel can help to increase Facebook Page Likes, Facebook Followers, Increase Post Likes, Auto comments and boost live views.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fab fa-twitter-square"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('twitter') }}</h5>
                            <p>{{ Helper::getLang('we can help you to boost your tweets. We can help you to increase Twitter followers as your requirement. Also boost your twitter re-tweets, likes and favourites.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1.2s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fab fa-instagram-square"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('instagram') }}</h5>
                            <p>{{ Helper::getLang('Increase your Instagram real followers, Videos & Picture Likes, Boost live viewers count and get custom comments to increase your post engagement.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                </div>
                <div class="row">

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.8s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fab fa-youtube-square"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('youtube') }}</h5>
                            <p>{{ Helper::getLang('Increase YouTube Views and conversations. It is the fastest way to increase your YouTube views, and it can help to increase likes and boost your views with just one click.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fab fa-tiktok"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('TikTok') }}</h5>
                            <p>{{ Helper::getLang('Increase your TikTok real followers, Videos & Picture Likes, Boost your post engagements, It is the fastest way to increase your TikTok views and followers with just one click.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1.2s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('and more') }}</h5>
                            <p>{{ Helper::getLang('we provide all kind of social media platforms including website Traffic, Soundcloud, Spotify & many more.  our Support team and we make sure that we provide only the best services.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->





                </div>
            </div>
        </div>

    </div>
</section>
<!-- ***** services End ***** -->


<!-- ***** Features Start ***** -->
<section class="section" id="features">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ Helper::getLang('Features') }}</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p> {{ Helper::getLang('Comes with all the essential features and elements you need') }}
                    </p>
                    <p> {{ Helper::getLang('here are the key features of our services you must know.') }}
                    </p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.8s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-star"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('Superior quality') }}
                            </h5>
                            <p>{{ Helper::getLang('We provide our panel users with superb SMM services.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h5 class="features-title">
                                {{ Helper::getLang('Friendly Dashboard') }}</h5>
                            <p>{{ Helper::getLang('We have the friendliest dashboard in the SMM World! Updated regularly.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1.2s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <h5 class="features-title">
                                {{ Helper::getLang('Various payment methods') }}</h5>
                            <p>{{ Helper::getLang('Pick a payment option you prefer to add funds.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->

                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 0.8s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('Shockingly cheap') }}
                            </h5>
                            <p>{{ Helper::getLang('Cheap SMM services to meet the needs of our customers.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h5 class="features-title">{{ Helper::getLang('Prompt delivery') }}
                            </h5>
                            <p>{{ Helper::getLang('You can rest assured that your orders will be delivered fast.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->
                    <!-- ***** Features Small Item Start ***** -->
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12"
                        data-scroll-reveal="enter bottom move 50px over 0.6s after 1.2s">
                        <div class="features-small-item">
                            <div class="icon-o">
                                <i class="fas fa-life-ring"></i>
                            </div>
                            <h5 class="features-title">
                                {{ Helper::getLang('24/7 Customer Support') }}</h5>
                            <p>{{ Helper::getLang('With us, you get 24/7 customer support that can help you.') }}
                            </p>
                        </div>
                    </div>
                    <!-- ***** Features Small Item End ***** -->

                </div>
            </div>
        </div>

    </div>
</section>
<!-- ***** Features End ***** -->


<!-- ***** Testimonials Start ***** -->
<section class="section" id="testimonials">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ Helper::getLang('What do they say?') }}
                    </h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>{{ Helper::getLang('Everyday we work hard to make life of our clients better and happier') }}
                    </p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->

        <div class="row">
            <!-- ***** Testimonials Item Start ***** -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="team-item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                    <div class="team-content">
                        <i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 508.044 508.044"
                                x="0px" y="0px" id="svg-7714" style="enable-background:new 0 0 508.044 508.044;">
                                <g>
                                    <g>
                                        <path
                                            d="M0.108,352.536c0,66.794,54.144,120.938,120.937,120.938c66.794,0,120.938-54.144,120.938-120.938    s-54.144-120.937-120.938-120.937c-13.727,0-26.867,2.393-39.168,6.61C109.093,82.118,230.814-18.543,117.979,64.303    C-7.138,156.17-0.026,348.84,0.114,352.371C0.114,352.426,0.108,352.475,0.108,352.536z">
                                        </path>
                                        <path
                                            d="M266.169,352.536c0,66.794,54.144,120.938,120.938,120.938s120.938-54.144,120.938-120.938S453.9,231.599,387.106,231.599    c-13.728,0-26.867,2.393-39.168,6.61C375.154,82.118,496.875-18.543,384.04,64.303C258.923,156.17,266.034,348.84,266.175,352.371    C266.175,352.426,266.169,352.475,266.169,352.536z">
                                        </path>
                                    </g>
                                </g>
                            </svg></i>
                        <p>{{ Helper::settings('website_title') }}
                            {{ Helper::getLang('is the best SMM  panel that understands the customer’s needs and provides services.') }}
                        </p>
                        <div class="user-image">
                            <img src="{{ asset('assets/images/person.jpeg') }}" alt="">
                        </div>
                        <div class="team-info">
                            <h3 class="user-name">{{ Helper::getLang('Catherine Soft') }}</h3>
                            <span>{{ Helper::getLang('Youtuber') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ***** Testimonials Item End ***** -->

            <!-- ***** Testimonials Item Start ***** -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="team-item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
                    <div class="team-content">
                        <i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 508.044 508.044"
                                x="0px" y="0px" id="svg-7714" style="enable-background:new 0 0 508.044 508.044;">
                                <g>
                                    <g>
                                        <path
                                            d="M0.108,352.536c0,66.794,54.144,120.938,120.937,120.938c66.794,0,120.938-54.144,120.938-120.938    s-54.144-120.937-120.938-120.937c-13.727,0-26.867,2.393-39.168,6.61C109.093,82.118,230.814-18.543,117.979,64.303    C-7.138,156.17-0.026,348.84,0.114,352.371C0.114,352.426,0.108,352.475,0.108,352.536z">
                                        </path>
                                        <path
                                            d="M266.169,352.536c0,66.794,54.144,120.938,120.938,120.938s120.938-54.144,120.938-120.938S453.9,231.599,387.106,231.599    c-13.728,0-26.867,2.393-39.168,6.61C375.154,82.118,496.875-18.543,384.04,64.303C258.923,156.17,266.034,348.84,266.175,352.371    C266.175,352.426,266.169,352.475,266.169,352.536z">
                                        </path>
                                    </g>
                                </g>
                            </svg></i>
                        <p>{{ Helper::getLang('Order lots of Instagram Followers and got my followers as promised in time! Happy to Purchased from.') }}
                            {{ Helper::settings('website_title') }}</p>
                        <div class="user-image">
                            <img src="{{ asset('assets/images/person.jpeg') }}" alt="">
                        </div>
                        <div class="team-info">
                            <h3 class="user-name">{{ Helper::getLang('Kelvin Wood') }}</h3>
                            <span>{{ Helper::getLang('Instagram Model') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ***** Testimonials Item End ***** -->

            <!-- ***** Testimonials Item Start ***** -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="team-item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s">
                    <div class="team-content">
                        <i><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 508.044 508.044"
                                x="0px" y="0px" id="svg-7714" style="enable-background:new 0 0 508.044 508.044;">
                                <g>
                                    <g>
                                        <path
                                            d="M0.108,352.536c0,66.794,54.144,120.938,120.937,120.938c66.794,0,120.938-54.144,120.938-120.938    s-54.144-120.937-120.938-120.937c-13.727,0-26.867,2.393-39.168,6.61C109.093,82.118,230.814-18.543,117.979,64.303    C-7.138,156.17-0.026,348.84,0.114,352.371C0.114,352.426,0.108,352.475,0.108,352.536z">
                                        </path>
                                        <path
                                            d="M266.169,352.536c0,66.794,54.144,120.938,120.938,120.938s120.938-54.144,120.938-120.938S453.9,231.599,387.106,231.599    c-13.728,0-26.867,2.393-39.168,6.61C375.154,82.118,496.875-18.543,384.04,64.303C258.923,156.17,266.034,348.84,266.175,352.371    C266.175,352.426,266.169,352.475,266.169,352.536z">
                                        </path>
                                    </g>
                                </g>
                            </svg></i>
                        <p> {{ Helper::getLang('If you are looking for the most reasonable smm panel then') }}
                            {{ Helper::settings('website_title') }}
                            {{ Helper::getLang('is the best panel.') }}</p>
                        <div class="user-image">
                            <img src="{{ asset('assets/images/person.jpeg') }}" alt="">
                        </div>
                        <div class="team-info">
                            <h3 class="user-name">{{ Helper::getLang('David Martin') }}</h3>
                            <span>{{ Helper::getLang('Blogger') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ***** Testimonials Item End ***** -->
        </div>
    </div>
</section>
<!-- ***** Testimonials End ***** -->
<section class="section" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ Helper::getLang('F.A.Q') }}</h2>
                </div>
            </div>
        </div>
        @foreach($faqs as $key => $faq)
            @if($key%2 == 0)  <div class="row">  @endif

                <div class="col-md-6">
                    <div class="item-faq">
                        <div class="title">
                            <i class="fas fa-plus"></i>
                            <h5>{{ Helper::getLang($faq->question) }}</h5>
                        </div>
                        <div class="body">{!! Helper::getLang($faq->answer) !!}</div>
                    </div>
                </div>
                @if($key%2 != 0)  </div>  @endif
                @endforeach

    </div>
    </div>
</section>

<!-- ***** Contact Us Start ***** -->
<section class="section" id="contact-us">
    <div class="container">
        <!-- ***** Section Title Start ***** -->
        <div class="row">
            <div class="col-lg-12">
                <div class="center-heading">
                    <h2 class="section-title">{{ Helper::getLang('Talk To Us') }}</h2>
                </div>
            </div>
            <div class="offset-lg-3 col-lg-6">
                <div class="center-text">
                    <p>{!!Helper::getLang('Technical support for all our services <br> 24/7 to help you')!!}</p>
                </div>
            </div>
        </div>
        <!-- ***** Section Title End ***** -->

        <div class="row">
            <!-- ***** Contact Text Start ***** -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <h5 class="margin-bottom-30 text-uppercase ">{{ Helper::getLang('Our services can help you make your account more effective.') }}</h5>
                <div class="contact-text">
                    <p>{{ Helper::getLang('We provide the cheapest SMM Panel services amongst our competitors. If you’re looking for a super-easy way to offer additional marketing services to your existing and new clients, look no further! our site offers that and more !') }}
                    </p>
                </div>
            </div>
            <!-- ***** Contact Text End ***** -->

            <!-- ***** Contact Form Start ***** -->
            <div class="col-lg-8 col-md-6 col-sm-12">
                @if (session()->has('send'))
                <div class="alert alert-success" role="alert">
                    <strong>{{Helper::getLang('your email has been sent successfully')}}</strong>
                </div>             
                @endif
                <div class="contact-form">
                    <form id="contact" action="{{route('contact-us')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="name" type="text" class="form-control" id="name"
                                        placeholder="{{ Helper::getLang('Full Name') }}"
                                        required>
                                </fieldset>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <fieldset>
                                    <input name="email" type="email" class="form-control" id="email"
                                        placeholder="{{ Helper::getLang('E-Mail Address') }}"
                                        required>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="body" rows="6" class="form-control" id="message"
                                        placeholder="{{ Helper::getLang('Your Message') }}"
                                        required></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit"
                                        class="main-button">{{ Helper::getLang('Send Message') }}</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ***** Contact Form End ***** -->
        </div>
    </div>
</section>
<!-- ***** Contact Us End ***** -->

<!-- ***** Footer Start ***** -->
@include('web/partials/footer')

@endsection

@section('scripts')
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/imgfix.min.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endsection
