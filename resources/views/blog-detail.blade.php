@extends('layouts.frontend.app',[
'title' => 'Detail Blog'

])

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('carbook-master/images/bg_3.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{ url('/blog') }}">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog Detail <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Baca Blog Kami</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ftco-animate">
                <h1 class="mb-3">{{ $blog->title }}</h1>

                <!-- Content -->
                {!! $blog->content !!}
                <!-- End Content -->

                <div class="tag-widget post-tag-container mb-5 mt-5">
                    <div class="tagcloud">
                        @foreach($tags as $tag)
                        <a href="#" class="tag-cloud-link">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="about-author d-flex p-4 bg-light">
                    <div class="bio mr-5">
                        <img src="{{ asset('carbook-master') }}/images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
                    </div>
                    <div class="desc">
                        <h3>{{ $blog->author }}</h3>
                        <p>Tim profesional yang berdedikasi untuk memberikan layanan pelanggan terbaik dalam industri rental mobil. Dengan pengetahuan mendalam tentang armada kendaraan kami dan komitmen untuk membantu setiap pelanggan.</p>
                    </div>
                </div>
            </div>


            <!-- .col-md-8 -->
            <div class="col-md-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form action="#" class="search-form">
                        <div class="form-group">
                            <span class="icon icon-search"></span>
                            <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                        </div>
                    </form>
                </div>
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Categories</h3>
                        <li><a href="#">Ferrari <span>(12)</span></a></li>
                        <li><a href="#">Cheverolet <span>(22)</span></a></li>
                        <li><a href="#">Ford <span>(37)</span></a></li>
                        <li><a href="#">Subaru <span>(42)</span></a></li>
                        <li><a href="#">Toyota <span>(14)</span></a></li>
                        <li><a href="#">Mistsubishi <span>(140)</span></a></li>
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    @foreach($recent as $item)
                    <h3>Recent Blog</h3>
                    <div class="block-21 mb-4 d-flex">
                        <a href="{{ url('blog/'. $item->slug) }}" class="blog-img mr-4" style="background-image: url('{{ asset('storage/thumbnail/' . $item->thumbnail) }}');"></a>
                        <div class="text">
                            <h3 class="heading"><a href="{{ url('blog/'. $item->slug) }}">{{ $item->title }}</a></h3>
                            <div class="meta">
                                <div><a href="#"><span class="icon-calendar"></span> {{ $item->published_at->format('d M Y') }}</a></div>
                                <div><a href="#"><span class="icon-person"></span> {{ $item->author }}</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Tag Cloud</h3>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">dish</a>
                        <a href="#" class="tag-cloud-link">menu</a>
                        <a href="#" class="tag-cloud-link">food</a>
                        <a href="#" class="tag-cloud-link">sweet</a>
                        <a href="#" class="tag-cloud-link">tasty</a>
                        <a href="#" class="tag-cloud-link">delicious</a>
                        <a href="#" class="tag-cloud-link">desserts</a>
                        <a href="#" class="tag-cloud-link">drinks</a>
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3>Rajawali Rent</h3>
                    <p>Layanan sewa mobil terpercaya dengan armada lengkap dan profesional untuk kebutuhan perjalanan Anda.</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- section -->
@endsection