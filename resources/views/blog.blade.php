@extends('layouts.frontend.app',[
'title' => 'Blog'

])

@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('carbook-master') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Blog Kami</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row d-flex justify-content-center">
            @foreach($blog as $item)
            <div class="col-md-12 text-center d-flex ftco-animate">
                <div class="blog-entry justify-content-end mb-md-5">
                    <a href="{{ url('blog/'. $item->slug) }}" class="block-20 img" style="background-image: url('{{ asset('storage/thumbnail/' . $item->thumbnail) }}');">
                    </a>
                    <div class="text px-md-5 pt-4">
                        <div class="meta mb-3">
                            <div><a href="#">{{ $item->published_at->format('d M Y') }}</div>
                            <div><a href="#">{{ $item->author }}</a></div>
                            <!-- <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div> -->
                        </div>
                        <h3 class="heading mt-2"><a href="{{ url('blog/'. $item->slug) }}">{{ $item->title }}</a></h3>
                        <p>{{ Str::limit(strip_tags($item->content), 150) }}</p>
                        <p><a href="{{ url('blog/'. $item->slug) }}" class="btn btn-primary">Continue <span class="icon-long-arrow-right"></span></a></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <!-- Tampilkan tautan ke halaman sebelumnya jika tersedia -->
                        @if ($blog->currentPage() == 1)
                        <li class="disabled"><span>&lt;</span></li>
                        @else
                        <li><a href="{{ $blog->previousPageUrl() }}">&lt;</a></li>
                        @endif

                        <!-- Tampilkan nomor halaman -->
                        @for ($i = 1; $i <= $blog->lastPage(); $i++)
                            @if ($i == $blog->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                            @else
                            <li><a href="{{ $blog->url($i) }}">{{ $i }}</a></li>
                            @endif
                            @endfor

                            <!-- Tampilkan tautan ke halaman berikutnya jika tersedia -->
                            @if ($blog->hasMorePages())
                            <li><a href="{{ $blog->nextPageUrl() }}">&gt;</a></li>
                            @else
                            <li class="disabled"><span>&gt;</span></li>
                            @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection