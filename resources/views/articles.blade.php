{{-- resources/views/articles.blade.php --}}
@include('include.header')

<!-- Page Title -->
<section class="page-title" style="background-image:url({{ asset('assets/images/background/page-title_bg.jpg') }})">
  <div class="auto-container">
    <h2>المقالات</h2>
    <ul class="bread-crumb clearfix">
      <li><a href="{{ url('/') }}">الرئيسية</a></li>
      <li>التفاصيل</li>
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
        {{-- استخدم لوجو افتراضي أو استدعِه من إعداداتك الخاصة --}}
        <img src="{{ asset('storage/site/logo.png') }}" alt="شعار الموقع" />
      </div>
      <div class="sec-title_title">
        هدفنا الوحيد هو توفير الراحة لعملائنا، وفيما يلي بعض من تعليقاتهم
      </div>
      <h2 class="sec-title_heading">مقالات</h2>
    </div>

    <div class="row clearfix">
      @foreach ($articles as $article)
        <!-- News Block One -->
        <div class="news-block_one col-lg-4 col-md-6 col-sm-12">
          <div class="news-block_one-inner wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">

            <div class="news-block_one-image">
              <a href="{{ route('article', ['id' => $article->id]) }}">
                {{-- عرض الصورة من التخزين --}}
                @if(!empty($article->image))
                  <img src="{{ asset('storage/' . ltrim($article->image, '/')) }}" alt="{{ $article->title }}" />
                @else
                  <img src="{{ asset('assets/images/default-article.jpg') }}" alt="صورة افتراضية" />
                @endif
              </a>
            </div>

            <div class="news-block_one-content" style="margin-top:20px; margin-right:5px;">
              <h5 class="news-block_one-heading">
                <a href="{{ route('article', ['id' => $article->id]) }}">{{ $article->title }}</a>
              </h5>
              <a href="{{ route('article', ['id' => $article->id]) }}" class="news-block_one-more">المزيد</a>
            </div>

          </div>
        </div>
      @endforeach
    </div>

  </div>
</section>
<!-- End News One -->

@include('include.footer')
