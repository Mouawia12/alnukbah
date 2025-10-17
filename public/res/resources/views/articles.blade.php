@include('include.header')

	<!-- Page Title -->
    <section class="page-title" style="background-image:url({{asset('assets/images/background/page-title_bg.jpg')}})">
        <div class="auto-container">
			<h2>المقالات</h2>
			<ul class="bread-crumb clearfix">
				<li><a href="index.html">الرئيسية</a></li>
			-	<li>التفاصيل </li>
			</ul>
        </div>
    </section>
    <!-- End Page Title -->
<!-- News One -->
<section class="news-one">
	<div class="auto-container">
		<!-- Sec Title -->
		<div class="sec-title centered">
			<div class="sec-title_icon">
				<img src="{{asset("storage/app/public/".app_setting('site.logo'))}}" alt="" />
			</div>
			<div class="sec-title_title">هدفنا الوحيد هو توفير الراحة لعملائنا، وفيما يلي بعض من تعليقاتهم
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
						<h5 class="news-block_one-heading"><a href="{{ route('article',['id'=>$article->id]) }}">{{$article->title}}</a></h5>
						<a href="{{ route('article',['id'=>$article->id]) }}" class="news-block_one-more">المزيد </a>
					</div>
				</div>
			</div>
			@endforeach
		</div>


	</div>
</section>
<!-- End News One -->
@include('include.footer')
