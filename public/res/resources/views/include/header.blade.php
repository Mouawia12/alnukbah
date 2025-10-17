<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="description" content="{{setting('site.description')}}">
<meta name="keywords" content="{{setting('site.keywords')}}">
<meta name="author" content="{{setting('site.author')}}">
<title>{{setting('site.title')}}</title>
<!-- Stylesheets -->
<link href="{{ asset("assets/css/bootstrap.css") }}" rel="stylesheet">
<link href="{{ asset("assets/css/style.css") }}" rel="stylesheet">
<link href="{{ asset("assets/css/responsive.css") }}" rel="stylesheet">

<!-- Color Switcher Mockup -->
<link href="{{ asset("assets/css/color-switcher-design.css") }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Color Themes -->
<link id="theme-color-file" href="{{ asset("assets/css/color-themes/default-color.css") }}" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Anybody:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
@php
	$favicon=json_decode(setting('site.favicon'));

@endphp

<link rel="shortcut icon" href="{{ asset("storage/app/public/".$favicon[0]->download_link) }}" type="image/x-icon">
<link rel="icon" href="{{ asset("storage/app/public/".$favicon[0]->download_link) }}" type="image/x-icon">

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head>
    <link type="text/css" rel="stylesheet" href="{{asset('css/lightgallery.css')}}" />

    <!-- lightgallery plugins -->
    <link type="text/css" rel="stylesheet" href="{{asset('css/lg-zoom.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('css/lg-thumbnail.css')}}" />


    <!-- OR -->

    <link type="text/css" rel="stylesheet" href="{{asset('css/lightgallery-bundle.css')}}" />
</head>
<style>
    .slider-one-arrow{
        padding-bottom: 20px !important
    }
    .main-header .main-menu .navigation > li > a .menu-text {
        font-size: 16px;
        margin: 4px !important;
        font-family: 'Calibri';
    }
    .main-header .main-menu .navigation > li > ul > li > a{
        text-align: right !important;
    }
	.marginlogo{
		margin-top: -30px;
		width: 250px;
	}
	.marginlogo2{
		width: 200px;
	}
	@media only screen and (max-width: 1025px) {
		.marginlogo{
		margin-top: 20px;
		width: 200px;

	}
	}
	@media only screen and (max-width: 620px) {
           .header-top_list li{
		display: none;
		   }
		   
		   .marginlogo{
		margin-top: 70px;
		width: 150px;

	}
  }
  .progress-one_image-layer2
{
  position: absolute;
  left: 0px;
  top: 50px;
  right: 0px;
  bottom: 0px;
  background-size: cover;
}
.icon-float
{
  width: 64px;
  height: 64px;
  bottom: 30px;
  left: 30px;
  font-size: 40px;
  position: fixed;
}
@media only screen and (min-width: 480px) and (max-width: 767px){
.icon-float {
    width: 64px;
    height: 64px;
    bottom: 30px;
    left: 30px;
    font-size: 40px;
	position: fixed;
}
}
.icon-float
{
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
.icon-float-call
{
  background: #762DC4 !important;
  margin-bottom: 0px;
}
.icon-float-call
{
	bottom: 20px;
  left: 100px;
}

    </style>
</head>

<body>

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
					<div class="d-flex justify-content-between align-items-center flex-wrap" style="float: left !important;">
						

						<div class="right-box d-flex align-items-center flex-wrap">
							<!-- Info List -->
							<ul class="header-top_list">
								<li class="our_list">
									<span class="icon"><img src="assets/images/icons/phone.png" alt="" /></span>
									<a href="tel: {{setting('site.phone')}}"> {{setting('site.phone')}}</a>
								</li>
							</ul>
							<!-- Social Box -->
							<div class="header_socials">
								<span> </span>
                                @if (setting('site.facebook')!="")
								<a href="{{setting('site.facebook')}}"><i class="fa-brands fa-facebook-f"></i></a>
                                @endif 
                                @if (setting('site.twitter')!="")
								<a href="{{setting('site.twitter')}}"><i class="fa-brands fa-twitter"></i></a>
                                @endif 
                                @if (setting('site.youtube')!="")
								<a href="{{setting('site.youtube')}}"><i class="fa-brands fa-youtube"></i></a>
                                @endif 
                                @if (setting('site.instagram')!="")
								<a href="{{setting('site.instagram')}}"><i class="fa-brands fa-instagram"></i></a>
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
					<div class="d-flex justify-content-between align-items-center flex-wrap" >
						
						<div class="logo-box">
							<div class="logo"><a href="{{route('/')}}"><img src="{{asset("storage/app/public/".setting('site.logo_white'))}}"  alt="" title="" class="marginlogo"></a></div>
							<div class="logo-2"><a href="{{route('/')}}"><img src="{{asset("storage/app/public/".setting('site.big_logo'))}}"  alt="" title=""  class="marginlogo2"></a></div>
						</div>
						
						<div class="nav-outer">
							<!-- Main Menu -->
							<nav class="main-menu navbar-expand-md">
								<div class="navbar-header">
									<!-- Toggle Button -->    	
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								
								<div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
									<ul class="navigation clearfix">
										<li class="" ><a href="{{route('/')}}"> <div class="menu-text"><span> الرئيسية </span></div></a>
										</li>
                                        @php
                                            $x=0;
                                            $restarray=[];
                                        @endphp
                                     @foreach ($services as $service)
                                     @php
                                     $x=$x+1;
                                            $subervices=$service->subservices()->get();
                                        @endphp
                                @if ($x<5)
                                         @if (sizeof($subervices))
                                         <li class="dropdown"><a href="{{ route('service',['id'=>$service->id]) }}"><div class="menu-text"><span> {{$service->name}}  </span></div></a>
											<ul>
                                                @foreach ($subervices as $subervice)
                                                <li><a href="{{ route('subservice',['id'=>$subervice->id]) }}">{{$subervice->name}}</a></li>

                                                @endforeach
										
											</ul>
										</li>
                                         @else
                                         <li class="" ><a href="{{ route('service',['id'=>$service->id]) }}"> <div class="menu-text"><span> {{$service->name}} </span></div></a>
                                         </li>
                                         @endif
                                     @else
                                         @php
                                         array_push($restarray,$service)
                                     @endphp 
                                         @endif
                                     @endforeach
                                     @if (sizeof($restarray))
                                     <li class="dropdown"><a href="#"><div class="menu-text"><span>المزيد </span></div></a>
                                        <ul>
                                            @foreach ($restarray as $rest)
                                            @php
                                                 $subervices=$rest->subservices()->get();
                                            @endphp
                                             @if (sizeof($subervices))
                                            
                                             <li class="dropdown"><a href="{{ route('service',['id'=>$service->id]) }}">{{$service->name}} </a>
                                                <ul>
                                                    @foreach ($subervices as $subervice)
                                                    <li><a href="{{ route('subservice',['id'=>$subervice->id]) }}">{{$subervice->name}}</a></li>
    
                                                    @endforeach
                                            
                                                </ul>
                                            </li>
                                             @else
                                             <li><a href="{{ route('service',['id'=>$service->id]) }}">{{$rest->name}}</a>   </li>

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
								<a href="{{route('contact')}}" class="theme-btn btn-style-one">
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
				<div class="nav-logo"><a href="{{route('/')}}"><img src="{{asset("storage/app/public/".setting('site.logo_white'))}}" width="300" alt="" title=""></a></div>
				<div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
			</nav>
		</div>
		<!-- End Mobile Menu -->
	
	</header>
	<!-- End Main Header -->
	