<!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-7BM6TVB2N3"></script>-->
<!--<script>-->
<!--  window.dataLayer = window.dataLayer || [];-->
<!--  function gtag(){dataLayer.push(arguments);}-->
<!--  gtag('js', new Date());-->

<!--  gtag('config', 'G-7BM6TVB2N3');-->
<!--</script>-->

@include('include.header')

	<!-- Page Title -->
    <section class="page-title" style="background-image:url({{asset('assets/images/background/page-title_bg.jpg')}})">
        <div class="auto-container">
			<h2>تواصل معنا</h2>
			<ul class="bread-crumb clearfix">
				<li><a href="index.html">الرئيسية</a></li>
			-	<li>التواصل </li>
			</ul>
        </div>
    </section>
    <!-- End Page Title -->
	<!-- Contact One -->
	<section class="contact-one">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_title">معلومات التواصل</div>
				<h2 class="sec-title_heading">ابقى على تواصل</h2>
				<div class="sec-title_text"></div>
			</div>
			<div class="row clearfix">
				
				<!-- Contact Info Block -->
				<div class="contact-info-block col-lg-3 col-md-6 col-sm-12">
					<div class="contact-info-block_inner">
						<span class="contact-info-block_icon fa-solid fa-location-dot fa-fw"></span>
						<h4 class="contact-info-block_heading">العنوان</h4>
						<div class="contact-info-block_text">{{app_setting('site.location')}}</div>
					</div>
				</div>
				
				<!-- Contact Info Block -->
				<div class="contact-info-block col-lg-3 col-md-6 col-sm-12">
					<div class="contact-info-block_inner">
						<span class="contact-info-block_icon fa-solid fa-envelope"></span>
						<h4 class="contact-info-block_heading">البريد الالكتروني</h4>
						<div class="contact-info-block_text"><a href="mailto:{{app_setting('site.email')}}">{{app_setting('site.email')}}</a></div>
					</div>
				</div>
				
				<!-- Contact Info Block -->
				<div class="contact-info-block col-lg-3 col-md-6 col-sm-12">
					<div class="contact-info-block_inner">
						<span class="contact-info-block_icon fa-solid fa-clock fa-fw"></span>
						<h4 class="contact-info-block_heading"> اوقات العمل</h4>
						<div class="contact-info-block_text">{{app_setting('site.worktime')}}</div>
					</div>
				</div>
				
				<!-- Contact Info Block -->
				<div class="contact-info-block col-lg-3 col-md-6 col-sm-12">
					<div class="contact-info-block_inner">
						<span class="contact-info-block_icon fa-solid fa-phone fa-fw"></span>
						<h4 class="contact-info-block_heading">رقم الهاتف</h4>
						<div class="contact-info-block_text"><a href="tel:{{app_setting('site.phone')}}">{{app_setting('site.phone')}}</a></div>
					</div>
				</div>
				
			</div>
		</div>
	</section>
	<!-- End Contact One -->

	
	<!-- Contact Form One -->
	<section class="contact-form-one">
		<div class="auto-container">
			<div class="inner-container">
				
				<!-- Sec Title -->
				<div class="sec-title centered">
					<div class="sec-title_title">تواصل معنا</div>
					<h2 class="sec-title_heading">هل لديك اي اسئلة ؟ اكتب لنا الان</h2>
				</div>
				
				<!-- Default Form -->
				<div class="contact-form">
					<form method="post" action="{{route('contacts.send')}}" >
						{{ csrf_field() }}

						<div class="row clearfix">
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="name" placeholder="الاسم الكامل" required="">
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="email" placeholder="البريد الالكتروني" required="">
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="phone" placeholder="رقم الهاتف" required="">
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 form-group">
								<input type="text" name="location" placeholder="الموقع" required="">
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 form-group">
								<textarea class="" name="message" placeholder="اكتب لنا"></textarea>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 form-group text-center">
								<!-- Button Box -->
								<div class="button-box">
									<button class="theme-btn btn-style-three">
										<span class="btn-wrap">
											<span class="text-one">ارسال</span>
											<span class="text-two">ارسال</span>
										</span>
									</button>
								</div>
							</div>
							
						</div>
					</form>
				</div>
				<!-- End Default Form -->
				
			</div>
		</div>
	</section>
	<!-- End Contact Form One -->
	
@include('include.footer')
