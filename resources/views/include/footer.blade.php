
<!-- Footer Style -->
<footer class="main-footer">

    <div class="footer_bg-image" style="background-image: url({{ asset('assets/images/background/footer-bg.jpg') }})">
    </div>
    <div class="upper-box">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="column col-lg-6 col-md-6 col-sm-12">
                    <div class="footer-logo"><a href="index.html"><img
                                src="{{ asset('storage/' . app_setting('site.logo_white')) }}" width="300"
                                alt="" title=""></a></div>
                </div>
                <div class="column col-lg-6 col-md-6 col-sm-12">
                    <!-- Subscribe Box -->
                    <div class="subscribe-box">
                        <form method="post" action="{{ route('subscribe') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="email" name="search-field" value="" name="email"
                                    placeholder="ادخل البريد الالكتروني" required>
                                <button type="submit">اشترك معنا</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Widgets Section -->
    <div class="widgets-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Footer Column -->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget logo-widget">
                        <h5>{{ app_setting('site.title') }}</h5>
                        <p>{{ app_setting('site.description') }} </p>
                    </div>
                </div>

                <!-- Footer Column -->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget links-widget">
                        <h5>روابط سريعة</h5>
                        <ul class="footer-list">
                            @php
                                $x = 0;
                            @endphp
                            @foreach ($services as $service)
                                @if ($x < 4)
                                    <li><a href="{{ route('service', ['id' => $service->id]) }}">{{ $service->name }}</a>
                                    </li>
                                    @php
                                        $x = $x + 1;
                                    @endphp
                                @else
                                    @php
                                        break;
                                    @endphp
                                @endif
                            @endforeach


                        </ul>
                    </div>
                </div>

                <!-- Footer Column -->
                <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                    <div class="footer-widget contact-widget">
                        <h5>اتصل بنا</h5>
                        <ul class="footer-contact_list">
                            <li><span></span>{{ app_setting('site.phone') }}</li>
                            <li><span></span>{{ app_setting('site.email') }}</li>
                            <li><span></span>{{ app_setting('site.location') }}</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Widgets Section -->

    <div class="footer-bottom">
        <div class="auto-container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="footer-col col-md-5">
                    <p> جميع الحقوق محفوظة @ 2025 </a></p><a href="https://alnukbah.com"> النخبة الحديثة للمقاولات
                        العامة</a></p>
                    <p> لطلب التصميم <i class="fa fa-heart pulse"></i> والبرمجة <a
                            href="https://wa.me/message/LAU235C7TGCGF1">iTS NOLOGY</a></p>
                </div>
                <!-- Social Box -->
                <div class="footer_socials">
                    @if (app_setting('site.facebook') != '')
                        <a href="{{ app_setting('site.facebook') }}"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if (app_setting('site.twitter') != '')
                        <a href="{{ app_setting('site.twitter') }}"><i class="fa-brands fa-twitter"></i></a>
                    @endif
                    @if (app_setting('site.youtube') != '')
                        <a href="{{ app_setting('site.youtube') }}"><i class="fa-brands fa-youtube"></i></a>
                    @endif
                    @if (app_setting('site.instagram') != '')
                        <a href="{{ app_setting('site.instagram') }}"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Search Popup -->
<div class="search-popup">
    <div class="color-layer"></div>
    <button class="close-search"><span class="flaticon-close-1"></span></button>
    <form method="post" action="https://uniqthemes.com/html/antilia/blog.html">
        <div class="form-group">
            <input type="search" name="search-field" value="" placeholder="Search Here" required="">
            <button class="fa fa-solid fa-magnifying-glass fa-fw" type="submit"></button>
        </div>
    </form>
</div>
<!-- End Search Popup -->



</div>
<!-- End PageWrapper -->



<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/appear.js') }}"></script>
<script src="{{ asset('assets/js/parallax.min.js') }}"></script>
<script src="{{ asset('assets/js/tilt.jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.paroller.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.js') }}"></script>
<script src="{{ asset('assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('assets/js/backtotop.js') }}"></script>
<script src="{{ asset('assets/js/odometer.js') }}"></script>
<script src="{{ asset('assets/js/parallax-scroll.js') }}"></script>

<script src="{{ asset('assets/js/gsap.min.js') }}"></script>
<script src="{{ asset('assets/js/SplitText.min.js') }}"></script>
<script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
<script src="{{ asset('assets/js/ScrollToPlugin.min.js') }}"></script>
<script src="{{ asset('assets/js/ScrollSmoother.min.js') }}"></script>

<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/nav-tool.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
<script src="{{ asset('assets/js/color-settings.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('success'))

        toastr.success("{{ Session::get('success') }}")
    @endif
    @if (Session::has('infor'))

        toastr.warning("{{ Session::get('infor') }}")
    @endif
</script>

@unless (app()->environment('local'))
    <script src="{{ asset('lightgallery.umd.js') }}"></script>
    <script src="{{ asset('lightgallery.min.js') }}"></script>

    <!-- lightgallery plugins -->

    <script src="{{ asset('plugins/thumbnail/lg-thumbnail.umd.js') }}"></script>
    <script src="{{ asset('plugins/zoom/lg-zoom.umd.js') }}"></script>
    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery'), {
            selector: '.item',
            plugins: [lgZoom, lgThumbnail],
            speed: 500,
            licenseKey: 'your_license_key'

        });
    </script>
@endunless
<div class="icon-float icon-float-call">
    <a class="float" href="tel:0508073635" target="_blank" data-kmt="1">
        <i class="fa fa-phone phoneicon"></i>
    </a>
</div>
<script>
    var url = 'https://widget.bot.space/js/widget.js';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled": true,
        "chatButtonSetting": {
            "backgroundColor": "#13C656",
            "ctaText": "",
            "borderRadius": "25",
            "marginLeft": "20",
            "marginBottom": "20",
            "marginRight": "20",
            "position": "left"
        },
        "brandSetting": {
            "brandName": "alnukbah",
            "brandSubTitle": "",
            "brandImg": "https://alnukbah.com//storage/app/public/settings/February2024/ylHxRo1DgF1gBWJfiZ1w.png",
            "welcomeText": "مرحبا بك \nنحن بانتظار تواصلك معنا",
            "backgroundColor": "#085E54",
            "ctaText": "ابدأ المحادثة",
            "borderRadius": "25",
            "autoShow": false,
            "phoneNumber": "966508073635"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
</body>

</html>
