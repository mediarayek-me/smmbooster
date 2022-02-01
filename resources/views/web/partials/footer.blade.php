<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="social">
                    <li><a href="{{Helper::settings('facebook_link')}}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{Helper::settings('twitter_link')}}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{Helper::settings('linkedin_link')}}"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="{{Helper::settings('instagram_link')}}"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
            <div class="">
                <div class="copyright m-0 p-0">
                   <p class="p-0 m-1">{{Helper::getLang('© Copyright by')}} {{Date('Y')}} {{ Helper::settings('website_title')}}</p>
                   <p><a href="{{route('terms-conditions')}}" target="_blank">{{Helper::getLang('Terms & Conditions')}}</a></p>
                </div>
            </div>
    </div>
</footer>