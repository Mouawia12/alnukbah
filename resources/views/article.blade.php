<!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-7BM6TVB2N3"></script>-->
<!--<script>-->
<!--  window.dataLayer = window.dataLayer || [];-->
<!--  function gtag(){dataLayer.push(arguments);}-->
<!--  gtag('js', new Date());-->

<!--  gtag('config', 'G-7BM6TVB2N3');-->
<!--</script>-->

@include('include.header')
<style>
	.zoomimage {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.zoommiddle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
.item {
  position: relative;
  width: 50%;
}

.item:hover .zoomimage {
  opacity: 0.3;
}

.item:hover .zoommiddle {
  opacity: 1;
}

.zoomtext {
  background-color: #0e0e0e00;
  color: rgb(0, 0, 0);
  font-size: 25px;
  padding: 16px 32px;
}
</style>
	<!-- Page Title -->
    <section class="page-title" style="background-image:url({{asset('assets/images/background/page-title_bg.jpg')}})">
        <div class="auto-container">
			<h2>{{$article->name}}</h2>
			<ul class="bread-crumb clearfix">
				<li><a href="index.html">الرئيسية</a></li>
			-	<li>التفاصيل </li>
			</ul>
        </div>
    </section>
    <!-- End Page Title -->

	<!-- Project Detail -->
	<section class="project-detail">
		<div class="auto-container">
		
			<div class="middle-box">
				<p>{!!$article->description !!}</p>
				
			</div>
			<div class="project-detail_gallery">
				<div class="row clearfix" id="lightgallery">
					@php
					    $articleImages = $article->images;
					    if (is_string($articleImages) && $articleImages !== '') {
					        $decodedImages = json_decode($articleImages, true);
					        $articleImages = is_array($decodedImages) ? $decodedImages : [];
					    } elseif (!is_array($articleImages)) {
					        $articleImages = [];
					    }
					@endphp

					@if (!empty($articleImages))
						@foreach ($articleImages as $image)
							@php
								$imagePath = is_array($image)
									? ($image['download_link'] ?? $image['path'] ?? reset($image))
									: (is_object($image) ? ($image->download_link ?? $image->path ?? null) : $image);
							@endphp
							@if ($imagePath)
							<!-- Project Detail Gallery Image -->
							<div  data-src="{{asset("storage/".str_replace('\\', '/', $imagePath))}}" class=" item project-detail_gallery-image skewElem col-lg-6 col-md-6 col-sm-6">
								<img src="{{asset("storage/".str_replace('\\', '/', $imagePath))}}" class="zoomimage" alt="" />
								<div class="zoommiddle">
									<div class="zoomtext"><span class="fa fa-search"></span></div>
								</div>
							</div>
							@endif
						@endforeach
					@endif
				</div>
			</div>

			

		</div>
	</section>
	<!-- End Project Detail -->
@include('include.footer')
