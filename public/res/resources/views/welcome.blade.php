@include('include.header')


	<!-- Slider One -->
	<section class="slider-one">
		<div class="main-slider swiper-container">
			<div class="swiper-wrapper">
         
                @foreach ($sliders as $slider)

				<!-- Slide -->
				<div class="swiper-slide">
					<div class="slider-one_image-layer" style="background-image:url(assets/images/main-slider/1.jpg)"></div>
					<div class="auto-container">
						<div class="upper-box d-flex justify-content-between align-items-center flex-wrap">
							<h2 class="slider-one_heading">{{$slider->title}}</h2>
						</div>
						<div class="lower-box">
							<div class="row clearfix">
								<div class="column col-lg-3 col-md-12 col-sm-12">
									<div class="slider-one_text" style="font-size: 18px;">{{$slider->subtitle}}</div>
								
								</div>
								<div class="column col-lg-9 col-md-12 col-sm-12">
									<div class="slider-one_image"><img src="{{ asset("storage/app/public/".$slider->img) }}" alt="" /></div>
								</div>
							</div>
						</div>
					</div>
				</div>
                @endforeach

			</div>
			<div class="slider-one-arrow">
				<!-- If we need navigation buttons -->
				<div class="main-slider-prev"><img src="assets/images/main-slider/slider-next_arrow.png" alt="" /></div>
				<div class="main-slider-next"><img src="assets/images/main-slider/slider-prev_arrow.png" alt="" /></div>

				<!-- If we need pagination -->
				<div class="main-slider_pagination"></div>

			</div>
		</div>
	</section>
	<!-- End Main Slider Section -->

	<!-- Welcome One -->
	<section class="welcome-one">
		<div class="welcome-one_circle"></div>
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_icon">
					<img src="{{asset("storage/app/public/".app_setting('site.logo'))}}" alt="" />
				</div>
				<h2 class="sec-title_heading">{{app_setting('site.title')}}  </h2>
			</div>
            <div class="row clearfix">
				<!-- Column -->
				<div class="welcome-two_content-column col-lg-5 col-md-12 col-sm-12">
					<div class="welcome-two_content-outer">
						<p>{{$abouts->text}}</p>
		
						<div class="welcome-two_author">
							{{app_setting('site.author')}} 
						</div>
						
					</div>
				</div>
				<!-- Column -->
				<div class="welcome-two_image-column col-lg-7 col-md-12 col-sm-12">
					<div class="welcome-two_image-outer">
						<div class="welcome-two_image skewElem">
							<img src="{{ asset("storage/app/public/".$abouts->image) }}" alt="" />
						</div>
						<div class="welcome-two_experiance" data-parallax='{"y" : 40}'>
							<img src="assets/images/resource/welcome-4.jpg" alt="" />
							<div class="welcome-two_experiance-count">
								<div class="count-box">
									<span class="count-text" data-speed="3000" data-stop="{{$abouts->experiance}}">0</span><sub>+</sub>
								</div>
								<i>سنوات <br> الخبرة</i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Welcome One -->

	<!-- Progress One -->
	<section class="progress-one">
		<div class="progress-one_image-layer2" style="background-image:url(assets/images/background/progress-one_bg.jpg)"></div>
		<div class="auto-container">
			<div class="row clearfix">

				<!-- Progress One Content Column -->
				<div class="progress-one_content-column col-lg-12 col-md-12 col-sm-12">
					<div class="progress-one_content-outer">
						<!-- Sec Title -->
						<div class="sec-title light">
							<div class="sec-title_title">احصل على مظلات وسواتر مصممة خصيصًا لتلبية احتياجاتك وتوفير الراحة والأمان</div>
							<h3 class="sec-title_heading">متخصص في إنشاء وتركيب كافة أعمال الحدادة من المظلات والسواتر والبرجولات والهناجر وأعمال شترات النوافذ.

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
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_icon">
					<img src="{{asset("storage/app/public/".app_setting('site.logo'))}}" alt="" />
				</div>
				<h2 class="sec-title_heading">خدماتنا</h2>
			</div>
			<div class="row clearfix">
                
			@foreach ($services as $service)
                
				<!-- Project Block One -->
				<div class="project-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="project-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
						<div class="project-block_one-image">
							<a href="{{ route('service',['id'=>$service->id]) }}"><img src="{{asset("storage/app/public/".$service->image)}}" alt="" /></a>
						</div>
						<div class="project-block_one-content">
							<h3 class="project-block_one-heading"><a href="{{ route('service',['id'=>$service->id]) }}">{{$service->name}}</a></h3>
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
		<div class="progress-one_image-layer" style="background-image:url(assets/images/background/progress-one_bg.jpg)"></div>
		<div class="auto-container">
			<div class="row clearfix">

				<!-- Progress One Content Column -->
				<div class="progress-one_content-column col-lg-6 col-md-12 col-sm-12">
					<div class="progress-one_content-outer">
						<!-- Sec Title -->
						<div class="sec-title light">
							<div class="sec-title_title">تصميمات حديثة ومتنوعة من مظلات وسواتر تلبي احتياجات المساحات الخارجية المختلفة</div>
							<h3 class="sec-title_heading">متخصص في إنشاء وتركيب كافة أعمال الحدادة من المظلات والسواتر والبرجولات والهناجر وأعمال شترات النوافذ.</h3>
						</div>

						<!-- Skills -->
						<div class="skills">

							<!-- Skill Item -->
							<div class="skill-item">
								<div class="skill-header clearfix">
									<div class="skill-title">المشاريع</div>
								</div>
								<div class="skill-bar">
									<div class="bar-inner">
										<div class="bar progress-line" data-width="95"></div>
										<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{$statistics->projects}}">0</span></div>
									</div>
								</div>
							</div>

							<!-- Skill Item -->
							<div class="skill-item">
								<div class="skill-header clearfix">
									<div class="skill-title">العملاء</div>
								</div>
								<div class="skill-bar">
									<div class="bar-inner">
										<div class="bar progress-line" data-width="98"></div>
										<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{$statistics->client}}">0</span></div>
									</div>
								</div>
							</div>

							<!-- Skill Item -->
							<div class="skill-item">
								<div class="skill-header clearfix">
									<div class="skill-title">العمال العاملين
                                    </div>
								</div>
								<div class="skill-bar">
									<div class="bar-inner">
										<div class="bar progress-line" data-width="84"></div>
										<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{$statistics->employer}}">0</span></div>
									</div>
								</div>
							</div>

							<!-- Skill Item -->
							<div class="skill-item">
								<div class="skill-header clearfix">
									<div class="skill-title">سنوات الخبرة</div>
								</div>
								<div class="skill-bar">
									<div class="bar-inner">
										<div class="bar progress-line" data-width="100"></div>
										<div class="count-box"><span class="count-text" data-speed="2000" data-stop="{{$statistics->experience}}">0</span></div>
									</div>
								</div>
							</div>

						</div>

					</div>
				</div>

				<!-- Progress One Images -->
				<div class="progress-one_images-column col-lg-6 col-md-12 col-sm-12">
					<div class="progress-one_images-outer wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
						<div class="row clearfix">
							<div class="progress-one_image skewElem col-lg-6 col-md-6 col-sm-6">
								<img src="{{asset("storage/app/public/".$statistics->img1)}}" alt="" />
							</div>
							<div class="progress-one_image skewElem col-lg-6 col-md-6 col-sm-6">
								<img src="{{asset("storage/app/public/".$statistics->img2)}}" alt="" />
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
			<!-- Sec Title -->
			<div class="sec-title centered">
				<div class="sec-title_icon">
					<img src="{{asset("storage/app/public/".app_setting('site.logo'))}}" alt="" />
				</div>
			
				<h2 class="sec-title_heading">مقالات</h2>
			</div>
			<div class="row clearfix">


			@foreach ($articles as $article)
                
           
          
				<!-- News Block One -->
				<div class="news-block_one col-lg-4 col-md-6 col-sm-12">
					<div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
						<div class="news-block_one-image">
							<a href="{{ route('article',['id'=>$article->id]) }}"><img src="{{asset("storage/app/public/".$article->image)}}" alt="" /></a>
						</div>
						<div class="news-block_one-content" style="margin-top: 20px;margin-right:5px
                    ">
							<h4 class="news-block_one-heading"><a href="{{ route('article',['id'=>$article->id]) }}" style="    font-weight: bold;
							}">{{$article->title}}</a></h4>
							<a href="{{ route('article',['id'=>$article->id]) }}" class="news-block_one-more">المزيد </a>
						</div>
					</div>
				</div>
                @endforeach
			</div>

			<div class="news-one_button text-center">
				<a href="{{route('articles')}}" class="theme-btn btn-style-two">
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
		<div class="cta-one_pattern-layer" style="background-image:url(assets/images/background/cta-one_bg.png)"></div>
		<div class="auto-container">
			<h1 class="cta-one_heading">اتصل بنا</h1>
			<div class="cta-one_text">احصل على حلول مبتكرة واقتصادية للمظلات والسواتر تناسب ميزانيتك وتوفر لك الراحة والأناقة

            </div>
			<div class="cta-one_button">
				<a class="cta-one_community" href="{{route('contact')}}">
					<span></span>
					<div class="content">
						نحن بانتظار اتصالك
					</div>
				</a>
			</div>
		</div>
	</section>
	<!-- End CTA One -->
	<!-- Progress One -->
	<section class="progress-one">
		<div class="progress-one_image-layer2" style="background-image:url(assets/images/background/progress-one_bg.jpg)"></div>
		<div class="auto-container">
			<div class="row clearfix">

				<!-- Progress One Content Column -->
				<div class="progress-one_content-column col-lg-12 col-md-12 col-sm-12">
					<div class="progress-one_content-outer">
						<!-- Sec Title -->
						<div class="sec-title light">
							
							<div class="sec-title_title">هدفنا الوحيد هو توفير الراحة لعملائنا</div>
							<h3 class="sec-title_heading">تصميمات حديثة ومتنوعة من مظلات وسواتر تلبي احتياجات المساحات الخارجية المختلفة</h3>
						</div>

					

					</div>
				</div>

				

			</div>
		</div>
	</section>
	<!-- End Progress One -->
<!-- Services Two -->
<section class="services-two">
	<div class="services-two_color-layer"></div>
	<div class="auto-container">
		<!-- Sec Title -->
		<div class="sec-title centered">
			<div class="sec-title_icon">
				<img src="{{asset("storage/app/public/".app_setting('site.logo'))}}" alt="" />
			</div>
			<h2 class="sec-title_heading">اعمالنا</h2>
		</div>
		<div class="services_carousel swiper-container">
			<div class="swiper-wrapper">
      @foreach ($works as $work)
		  	<!-- Slide -->
			  <div class="swiper-slide">
				<!-- Service Block Two -->
				     
				<!-- Project Block One -->
				<div class="project-block_one col-lg-4 col-md-6 col-sm-12" style="width: 100%;">
					<div class="project-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="700ms">
						<div class="project-block_one-image">
							<a href="{{ route('work',['id'=>$work->id]) }}"><img src="{{asset("storage/app/public/".$work->img)}}" alt="" /></a>
						</div>
						<div class="project-block_one-content">
							<h3 class="project-block_one-heading"><a href="{{ route('work',['id'=>$work->id]) }}">{{$work->title}}</a></h3>
						</div>
					</div>
				</div>
			</div>
	  @endforeach
			



			</div>

			<div class="services-two_arrow">
				<!-- If we need navigation buttons -->
				<div class="services-two_slider-prev"><img src="assets/images/icons/client-one_next-arrow.png" alt="" /></div>
				<div class="services-two_slider-next"><img src="assets/images/icons/client-one_prev-arrow.png" alt="" /></div>
			</div>

		</div>
	</div>
</section>
<!-- End Services Two -->
@include('include.footer')
