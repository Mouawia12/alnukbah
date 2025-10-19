@include('include.header')

@php
    $siteLogo = app_setting('site.logo');
@endphp

<!-- Slider One -->
<section class="slider-one">
	<div class="main-slider swiper-container">
		<div class="swiper-wrapper">
			@foreach ($sliders as $slider)
			<!-- Slide -->
			<div class="swiper-slide">
				<div class="slider-one_image-layer"
					style="background-image:url('{{ asset('assets/images/main-slider/1.jpg') }}')"></div>
				<div class="auto-container">
					<div class="upper-box d-flex justify-content-between align-items-center flex-wrap">
						<h2 class="slider-one_heading">{{ $slider->title }}</h2>
					</div>
					<div class="lower-box">
						<div class="row clearfix">
							<div class="column col-lg-3 col-md-12 col-sm-12">
								<div class="slider-one_text" style="font-size: 18px;">{{ $slider->subtitle }}</div>
							</div>
							<div class="column col-lg-9 col-md-12 col-sm-12">
								<div class="slider-one_image">
									<img src="{{ asset('storage/'.$slider->img) }}" alt="" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<div class="slider-one-arrow">
			<div class="main-slider-prev"><img src="{{ asset('assets/images/main-slider/slider-next_arrow.png') }}" alt="" />
			</div>
			<div class="main-slider-next"><img src="{{ asset('assets/images/main-slider/slider-prev_arrow.png') }}" alt="" />
			</div>
			<div class="main-slider_pagination"></div>
		</div>
	</div>
</section>
<!-- End Main Slider Section -->

<!-- Welcome One -->
<section class="welcome-one">
	<div class="welcome-one_circle"></div>
	<div class="auto-container">
		<div class="sec-title centered">
			<div class="sec-title_icon">
				<img src="{{ $siteLogo ? asset('storage/' . ltrim($siteLogo, '/')) : asset('assets/images/logo.png') }}" alt="Logo" />
			</div>
			<h2 class="sec-title_heading">{{ config('app.name', 'النخبة الحديثة للمقاولات العامة') }}</h2>
		</div>

		<div class="row clearfix">
			<div class="welcome-two_content-column col-lg-5 col-md-12 col-sm-12">
				<div class="welcome-two_content-outer">
					<p>{{ $abouts->text }}</p>
				</div>
			</div>

			<div class="welcome-two_image-column col-lg-7 col-md-12 col-sm-12">
				<div class="welcome-two_image-outer">
					<div class="welcome-two_image skewElem">
						<img src="{{ asset('storage/'.$abouts->image) }}" alt="" />
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Welcome One -->

<!-- Progress One -->
<section class="progress-one">
	<div class="progress-one_image-layer2"
		style="background-image:url('{{ asset('assets/images/background/progress-one_bg.jpg') }}')"></div>
	<div class="auto-container">
		<div class="row clearfix">
			<div class="progress-one_content-column col-lg-12 col-md-12 col-sm-12">
				<div class="progress-one_content-outer">
					<div class="sec-title light">
						<div class="sec-title_title">
							احصل على مظلات وسواتر مصممة خصيصًا لتلبية احتياجاتك وتوفير الراحة والأمان
						</div>
						<h3 class="sec-title_heading">
							متخصصون في إنشاء وتركيب كافة أعمال الحدادة والمظلات والسواتر والبرجولات والهناجر وأعمال شترات النوافذ والملاحق الإسمنتية الحديثة.
						</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Progress One -->

<!-- Project One -->
<section class="project-one">
	<div class="auto-container">
		<div class="sec-title centered">
			<div class="sec-title_icon">
				<img src="{{ $siteLogo ? asset('storage/' . ltrim($siteLogo, '/')) : asset('assets/images/logo.png') }}" alt="Logo" />
			</div>
			<h2 class="sec-title_heading">خدماتنا</h2>
		</div>

		<div class="row clearfix">
			@foreach ($services as $service)
			<div class="project-block_one col-lg-4 col-md-6 col-sm-12">
				<div class="project-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
					<div class="project-block_one-image">
						<a href="{{ route('service',['id'=>$service->id]) }}">
							<img src="{{ asset('storage/'.$service->image) }}" alt="" />
						</a>
						<div class="project-block_one-content">
							<h4 class="project-block_one-heading">
								<a href="{{ route('service',['id'=>$service->id]) }}">{{ $service->name }}</a>
							</h4>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
<!-- End Project One -->

<!-- Progress One -->
<section class="progress-one">
	<div class="progress-one_image-layer"
		style="background-image:url('{{ asset('assets/images/background/progress-one_bg.jpg') }}')"></div>
	<div class="auto-container">
		<div class="row clearfix">
			<div class="progress-one_content-column col-lg-6 col-md-12 col-sm-12">
				<div class="progress-one_content-outer">
					<div class="sec-title light">
						<div class="sec-title_title">تصميمات حديثة ومتنوعة من مظلات وسواتر تلبي احتياجاتك</div>
						<h3 class="sec-title_heading">
							خبرتنا الممتدة تضمن جودة التنفيذ والدقة في التفاصيل.
						</h3>
					</div>

					<div class="skills">
						<div class="skill-item">
							<div class="skill-header clearfix">
								<div class="skill-title">المشاريع</div>
							</div>
							<div class="skill-bar">
								<div class="bar-inner">
									<div class="bar progress-line" data-width="95"></div>
									<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{ $statistics->projects }}">0</span></div>
								</div>
							</div>
						</div>

						<div class="skill-item">
							<div class="skill-header clearfix">
								<div class="skill-title">العملاء</div>
							</div>
							<div class="skill-bar">
								<div class="bar-inner">
									<div class="bar progress-line" data-width="98"></div>
									<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{ $statistics->client }}">0</span></div>
								</div>
							</div>
						</div>

						<div class="skill-item">
							<div class="skill-header clearfix">
								<div class="skill-title">العمال</div>
							</div>
							<div class="skill-bar">
								<div class="bar-inner">
									<div class="bar progress-line" data-width="84"></div>
									<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{ $statistics->employer }}">0</span></div>
								</div>
							</div>
						</div>

						<div class="skill-item">
							<div class="skill-header clearfix">
								<div class="skill-title">سنوات الخبرة</div>
							</div>
							<div class="skill-bar">
								<div class="bar-inner">
									<div class="bar progress-line" data-width="100"></div>
									<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{ $statistics->experience }}">0</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="progress-one_images-column col-lg-6 col-md-12 col-sm-12">
				<div class="progress-one_images-outer wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
					<div class="row clearfix">
						<div class="progress-one_image skewElem col-lg-6 col-md-6 col-sm-6">
							<img src="{{ asset('storage/'.$statistics->img1) }}" alt="" />
						</div>
						<div class="progress-one_image skewElem col-lg-6 col-md-6 col-sm-6">
							<img src="{{ asset('storage/'.$statistics->img2) }}" alt="" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Progress One -->

<!-- News One -->
<section class="news-one">
	<div class="auto-container">
		<div class="sec-title centered">
			<div class="sec-title_icon">
				<img src="{{ $siteLogo ? asset('storage/' . ltrim($siteLogo, '/')) : asset('assets/images/logo.png') }}" alt="Logo" />
			</div>
			<h2 class="sec-title_heading">مقالات</h2>
		</div>

		<div class="row clearfix">
			@foreach ($articles as $article)
			<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
				<div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
					<div class="news-block_one-image">
						<a href="{{ route('article',['id'=>$article->id]) }}">
							<img src="{{ asset('storage/'.$article->image) }}" alt="" />
						</a>
						<div class="news-block_one-content" style="margin-top: 20px;margin-right:5px">
							<h4 class="news-block_one-heading">
								<a href="{{ route('article',['id'=>$article->id]) }}" style="font-weight:bold;">{{ $article->title }}</a>
							</h4>
							<a href="{{ route('article',['id'=>$article->id]) }}" class="news-block_one-more">المزيد</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

		<div class="news-one_button text-center">
			<a href="{{ route('articles') }}" class="theme-btn btn-style-two">
				<span class="btn-wrap">
					<span class="text-one">عرض الكل</span>
					<span class="text-two">عرض الكل</span>
				</span>
			</a>
		</div>
	</div>
</section>
<!-- End News One -->

<!-- CTA One -->
<section class="cta-one">
	<div class="cta-one_pattern-layer"
		style="background-image:url('{{ asset('assets/images/background/cta-one_bg.png') }}')"></div>
	<div class="auto-container">
		<h1 class="cta-one_heading">اتصل بنا</h1>
		<div class="cta-one_text">احصل على حلول مبتكرة واقتصادية للمظلات والسواتر تناسب ميزانيتك وتوفر لك الراحة والأناقة</div>
		<div class="cta-one_button">
			<a class="cta-one_community" href="{{ route('contact') }}">
				<span></span>
				<div class="content">نحن بانتظار اتصالك</div>
			</a>
		</div>
	</div>
</section>

<!-- Works Section -->
<section class="services-two">
	<div class="services-two_color-layer"></div>
	<div class="auto-container">
		<div class="sec-title centered">
			<div class="sec-title_icon">
				<img src="{{ $siteLogo ? asset('storage/' . ltrim($siteLogo, '/')) : asset('assets/images/logo.png') }}" alt="Logo" />
			</div>
			<h2 class="sec-title_heading">اعمالنا</h2>
		</div>

		<div class="services_carousel swiper-container">
			<div class="swiper-wrapper">
				@foreach ($works as $work)
				<div class="swiper-slide">
					<div class="project-block_one col-lg-4 col-md-6 col-sm-12" style="width: 100%;">
						<div class="project-block_one-inner wow fadeInRight" data-wow-delay="200ms" data-wow-duration="400ms">
							<div class="project-block_one-image">
								<a href="{{ route('work',['id'=>$work->id]) }}">
									<img src="{{ asset('storage/'.$work->img) }}" alt="" />
								</a>
								<div class="project-block_one-content">
									<h4 class="project-block_one-heading">
										<a href="{{ route('work',['id'=>$work->id]) }}">{{ $work->title }}</a>
									</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>

			<div class="services-two_arrow">
				<div class="services-two_slider-prev"><img src="{{ asset('assets/images/icons/client-one_next-arrow.png') }}"
						alt="" /></div>
				<div class="services-two_slider-next"><img src="{{ asset('assets/images/icons/client-one_prev-arrow.png') }}"
						alt="" /></div>
			</div>
		</div>
	</div>
</section>
<!-- End Services Two -->

@include('include.footer')
