<!DOCTYPE html>
<script>
    gtag('event', 'conversion_event_contact', {
        // <event_parameters>
    });
</script>

<html>

<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YSXL9YL6V4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-YSXL9YL6V4');
    </script>

    <!-- Twitter conversion tracking base code -->
    <script>
        ! function(e, t, n, s, u, a) {
            e.twq || (s = e.twq = function() {
                    s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
                }, s.version = '1.1', s.queue = [], u = t.createElement(n), u.async = !0, u.src =
                'https://static.ads-twitter.com/uwt.js',
                a = t.getElementsByTagName(n)[0], a.parentNode.insertBefore(u, a))
        }(window, document, 'script');
        twq('config', 'okdd6');
    </script>
    <!-- End Twitter conversion tracking base code -->

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-K36WC3T7');
    </script>
    <!-- End Google Tag Manager -->

    <script>
        ! function(w, d, t) {
            w.TiktokAnalyticsObject = t;
            var ttq = w[t] = w[t] || [];
            ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias",
                "group", "enableCookie", "disableCookie"
            ], ttq.setAndDefer = function(t, e) {
                t[e] = function() {
                    t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                }
            };
            for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
            ttq.instance = function(t) {
                for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]);
                return e
            }, ttq.load = function(e, n) {
                var i = "https://analytics.tiktok.com/i18n/pixel/events.js";
                ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = i, ttq._t = ttq._t || {}, ttq._t[e] = +new Date,
                    ttq._o = ttq._o || {}, ttq._o[e] = n || {};
                var o = document.createElement("script");
                o.type = "text/javascript", o.async = !0, o.src = i + "?sdkid=" + e + "&lib=" + t;
                var a = document.getElementsByTagName("script")[0];
                a.parentNode.insertBefore(o, a)
            };

            ttq.load('CN47VP3C77U706OO112G');
            ttq.page();
        }(window, document, 'ttq');
    </script>

    <!-- Hotjar Tracking Code for https://alnukbah.com -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 3861869,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>

    {{ app_setting('site.analysiscode') }}
    <meta charset="utf-8">
    <meta name="description" content="{{ app_setting('site.description') }}">
    <meta name="keywords" content="{{ app_setting('site.keywords') }}">
    <meta name="author" content="{{ app_setting('site.author') }}">
    <title>{{ app_setting('site.title') }}</title>
    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <!-- Color Switcher Mockup -->
    <link href="{{ asset('assets/css/color-switcher-design.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Color Themes -->
    <link id="theme-color-file" href="{{ asset('assets/css/color-themes/default-color.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    @php
        $favicon = json_decode(app_setting('site.favicon'));

    @endphp

    <link rel="shortcut icon" href="{{ asset('storage/app/public/' . $favicon[0]->download_link) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('storage/app/public/' . $favicon[0]->download_link) }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <head>


        <link type="text/css" rel="stylesheet" href="{{ asset('css/lightgallery.css') }}" />

        <!-- lightgallery plugins -->
        <link type="text/css" rel="stylesheet" href="{{ asset('css/lg-zoom.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('css/lg-thumbnail.css') }}" />


        <!-- OR -->

        <link type="text/css" rel="stylesheet" href="{{ asset('css/lightgallery-bundle.css') }}" />
    </head>
    <style>
        .slider-one-arrow {
            padding-bottom: 20px !important
        }

        .main-header .main-menu .navigation>li>a .menu-text {
            font-size: 16px;
            margin: 4px !important;
            font-family: 'Calibri';
        }

        .main-header .main-menu .navigation>li>ul>li>a {
            text-align: right !important;
        }

        .marginlogo {
            margin-top: -30px;
            width: 250px;
        }

        .marginlogo2 {
            width: 200px;
        }

        @media only screen and (max-width: 1025px) {
            .marginlogo {
                margin-top: 20px;
                width: 200px;

            }
        }

        .icon-float {
            position: fixed;
            width: 70px;
            height: 70px;
            bottom: 40px;
            left: 40px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            font-size: 50px;
            z-index: 100;
            animation: icon-float 3s infinite ease-in-out;
        }

        .icon-float-call {
            background: #762DC4 !important;
            margin-bottom: 0px;
        }

        .icon-float-call {
            bottom: 20px;
            left: 100px;
        }

        .phoneicon {
            color: white;
            margin-top: 20px;
            font-size: 30px;
        }

        @media only screen and (max-width: 620px) {
            .header-top_list li {
                display: none;
            }

            .marginlogo {
                margin-top: 70px;
                width: 150px;

            }
        }

        @media only screen and (max-width: 800px) {

            .icon-float-call {
                bottom: 80px !important;
                left: 20px !important;
            }

            .icon-float {
                width: 50px;
                height: 50px;
                bottom: 30px;
                left: 30px;
                font-size: 40px;
                position: fixed;
            }

            .phoneicon {
                color: white;
                margin-top: 10px;
                font-size: 30px;
            }

            #wa-widget-send-button-no-text {
                margin: 0 0 20px 0 !important;
                padding-left: 0px;
                padding-right: 0px;
                position: fixed !important;
                z-index: 16000160 !important;
                bottom: 0 !important;
                text-align: center !important;
                height: 50px !important;
                min-width: 50px !important;
                border-radius: 34px;
                visibility: visible;
                transition: none !important;
                background-color: #13C656;
                box-shadow: rgb(0 0 0 / 10%) 0px 12px 24px 0px;
                left: 20px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        .progress-one_image-layer2 {
            position: absolute;
            left: 0px;
            top: 50px;
            right: 0px;
            bottom: 0px;
            background-size: cover;
        }


        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-container img {
            width: 100%;
            /* Or set a fixed width */
        }

        .number-overlay {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 30px;
            color: white;
            font-weight: bold;
            z-index: 10;
        }
    </style>
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K36WC3T7" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="page-wrapper" dir="rtl">

        <!-- Preloader -->
        <div class="preloader"></div>
        <!-- End Preloader -->

        <!-- Cursor -->
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
        <!-- Cursor End -->



        <!-- Main Header -->
        <header class="main-header">

            <!-- Header Top -->
            <div class="header-top">
                <div class="auto-container">
                    <div class="inner-container">
                        <div class="d-flex justify-content-between align-items-center flex-wrap"
                            style="float: left !important;">


                            <div class="right-box d-flex align-items-center flex-wrap">
                                <!-- Info List -->
                                <ul class="header-top_list">
                                    <li class="our_list">
                                        <span class="icon"><img src="assets/images/icons/phone.png"
                                                alt="" /></span>
                                        <a href="tel: {{ app_setting('site.phone') }}"> {{ app_setting('site.phone') }}</a>
                                    </li>
                                </ul>
                                <!-- Social Box -->
                                <div class="header_socials">
                                    <span> </span>
                                    @if (app_setting('site.facebook') != '')
                                        <a href="{{ app_setting('site.facebook') }}"><i
                                                class="fa-brands fa-facebook-f"></i></a>
                                    @endif
                                    @if (app_setting('site.twitter') != '')
                                        <a href="{{ app_setting('site.twitter') }}"><i
                                                class="fa-brands fa-twitter"></i></a>
                                    @endif
                                    @if (app_setting('site.youtube') != '')
                                        <a href="{{ app_setting('site.youtube') }}"><i
                                                class="fa-brands fa-youtube"></i></a>
                                    @endif
                                    @if (app_setting('site.instagram') != '')
                                        <a href="{{ app_setting('site.instagram') }}"><i
                                                class="fa-brands fa-instagram"></i></a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Upper -->
            <div class="header-upper">
                <div class="auto-container">
                    <div class="inner-container">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">

                            <div class="logo-box">
                                <div class="logo"><a href="{{ route('/') }}"><img
                                            src="{{ asset('storage/app/public/' . app_setting('site.logo_white')) }}"
                                            alt="" title="" class="marginlogo"></a></div>
                                <div class="logo-2"><a href="{{ route('/') }}"><img
                                            src="{{ asset('storage/app/public/' . app_setting('site.big_logo')) }}"
                                            alt="" title="" class="marginlogo2"></a></div>
                            </div>

                            <div class="nav-outer">
                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md">
                                    <div class="navbar-header">
                                        <!-- Toggle Button -->
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent"
                                            aria-controls="navbarSupportedContent" aria-expanded="false"
                                            aria-label="Toggle navigation">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>

                                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li class=""><a href="{{ route('/') }}">
                                                    <div class="menu-text"><span> الرئيسية </span></div>
                                                </a>
                                            </li>
                                            @php
                                                $x = 0;
                                                $restarray = [];
                                            @endphp
                                            @foreach ($services as $service)
                                                @php
                                                    $x = $x + 1;
                                                    $subervices = $service->subservices()->get();
                                                @endphp
                                                @if ($x < 7)
                                                    @if (sizeof($subervices))
                                                        <li class="dropdown"><a
                                                                href="{{ route('service', ['id' => $service->id]) }}">
                                                                <div class="menu-text"><span> {{ $service->name }}
                                                                    </span></div>
                                                            </a>
                                                            <ul>
                                                                @foreach ($subervices as $subervice)
                                                                    <li><a
                                                                            href="{{ route('subservice', ['id' => $subervice->id]) }}">{{ $subervice->name }}</a>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </li>
                                                    @else
                                                        <li class=""><a
                                                                href="{{ route('service', ['id' => $service->id]) }}">
                                                                <div class="menu-text"><span> {{ $service->name }}
                                                                    </span></div>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @else
                                                    @php
                                                        array_push($restarray, $service);
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if (sizeof($restarray))
                                                <li class="dropdown"><a href="#">
                                                        <div class="menu-text"><span>المزيد </span></div>
                                                    </a>
                                                    <ul>
                                                        @foreach ($restarray as $rest)
                                                            @php
                                                                $subervices = $rest->subservices()->get();
                                                            @endphp
                                                            @if (sizeof($subervices))
                                                                <li class="dropdown"><a
                                                                        href="{{ route('service', ['id' => $rest->id]) }}">{{ $rest->name }}
                                                                    </a>
                                                                    <ul>
                                                                        @foreach ($subervices as $subervice)
                                                                            <li><a
                                                                                    href="{{ route('subservice', ['id' => $subervice->id]) }}">{{ $subervice->name }}</a>
                                                                            </li>
                                                                        @endforeach

                                                                    </ul>
                                                                </li>
                                                            @else
                                                                <li><a
                                                                        href="{{ route('service', ['id' => $rest->id]) }}">{{ $rest->name }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                    </ul>
                                                </li>
                                            @endif



                                        </ul>
                                    </div>
                                </nav>
                            </div>

                            <!-- Main Menu End-->
                            <div class="outer-box d-flex align-items-center flex-wrap">



                                <!-- Button Box -->
                                <div class="header_button-box">
                                    <a href="{{ route('contact') }}" class="theme-btn btn-style-one">
                                        <span class="btn-wrap">
                                            <span class="text-one">اتصل بنا </span>
                                            <span class="text-two">اتصل بنا </span>
                                        </span>
                                    </a>
                                </div>

                                <!-- Mobile Navigation Toggler -->
                                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <div class="close-btn"><span class="icon flaticon-close-1"></span></div>

                <nav class="menu-box">
                    <div class="nav-logo"><a href="{{ route('/') }}"><img
                                src="{{ asset('storage/app/public/' . app_setting('site.logo_white')) }}" width="300"
                                alt="" title=""></a></div>
                    <div class="menu-outer">
                        <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                </nav>
            </div>
            <!-- End Mobile Menu -->

        </header>
        <!-- End Main Header -->
