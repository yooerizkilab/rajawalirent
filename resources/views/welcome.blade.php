@extends('layouts.frontend.app',[
'title' => 'Welcome'

])

@section('content')

<!-- Background Tron -->
<div class="hero-wrap ftco-degree-bg" style="background-image: url('{{ asset('carbook-master') }}/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
            <div class="col-lg-8 ftco-animate">
                <div class="text w-100 text-center mb-md-5 pb-md-5">
                    <h1 class="mb-4">Cepat &amp; Mudah Menyewa Mobil</h1>
                    <p style="font-size: 18px;">"Selamat datang di Rajawali Rent Kami adalah penyedia layanan sewa mobil yang terpercaya dan siap memenuhi kebutuhan perjalanan Anda. Dengan komitmen untuk memberikan pengalaman sewa mobil yang aman dan praktis"</p>
                    <!-- <a href="https://vimeo.com/45830194" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="ion-ios-play"></span>
                        </div>
                        <div class="heading-title ml-5">
                            <span>Easy steps for renting a car</span>
                        </div>
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Background Tron -->

<!-- Form Rent -->
<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-12 featured-top">
                <div class="row no-gutters">
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="services-wrap rounded-right w-100">
                            <h3 class="heading-section mb-4">Cara Terbaik Untuk Menyewa Mobil Anda</h3>
                            <div class="row d-flex mb-4">
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="flaticon-route"></span>
                                        </div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Lokasi Penyewaan Terbaik</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Pilih Penawaran Terbaik</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                    <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                        <div class="text w-100">
                                            <h3 class="heading mb-2">Pesan Mobil Sewa Anda</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center align-items-center justify-content-center" style="display: flex;">
                                <a href="{{ url('cars') }}" class="btn btn-primary py-3 px-4">Pesan Mobil Terbaik Anda</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Form Rent -->

<!-- Top Brand -->
<section class="ftco-section ftco-no-pt bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                <h2 class="mb-2"></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="carousel-car owl-carousel">
                    @foreach($produk as $row)
                    <div class="item">
                        <div class="car-wrap rounded ftco-animate">
                            <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/produk/' . $row->gambar) }}');">
                            </div>
                            <div class="text">
                                <h2 class="mb-0">
                                    <a href="{{ url('cars/view-cars/' . $row->varian) }}">{{ $row->varian }}</a>
                                </h2>
                                <div class="d-flex mb-3">
                                    <span class="cat">{{ $row->merk }}</span>
                                    @foreach($row->list_harga as $item)
                                    <p class="price ml-auto">Rp {{ number_format($item->harga) }}<span>/{{ $item->deskripsi }}</span></p>
                                    @endforeach
                                </div>
                                <p class="d-flex mb-0 d-block">
                                    <a href="{{ url('cars/orders/' . $row->varian) }}" class="btn btn-primary py-2 mr-1">Pesan</a>
                                    <a href="{{ url('cars/show/' . $row->varian) }}" class="btn btn-secondary py-2 ml-1">Lihat</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- EndTop Brand -->

<!-- Services Customers -->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2 class="mb-3">Layanan Terbaik Kami</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Upacara Pernikahan</h3>
                        <p>Rayakan momen istimewa Anda dengan kemewahan dan kenyamanan dari layanan rental mobil Rajawali Rent Pastikan perjalanan Anda menuju upacara pernikahan menjadi pengalaman yang tak terlupakan!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Transportasi Kota</h3>
                        <p>Nikmati kemudahan berkeliling kota dengan layanan rental mobil Rajawali Rent Dengan armada yang handal dan nyaman, perjalanan Anda di dalam kota akan lebih praktis dan menyenangkan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Transportasi Bandara</h3>
                        <p>Mulai dan akhiri perjalanan Anda dengan lancar bersama Rajawali Rent Kami menyediakan layanan transportasi bandara yang tepat waktu dan nyaman, memastikan Anda tiba di tujuan tanpa stres.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Tour Pariwisata</h3>
                        <p>Jelajahi destinasi wisata terbaik dengan kenyamanan maksimal bersama Rajawali Rent Layanan rental mobil kami siap membawa Anda berpetualang, menjadikan setiap perjalanan wisata menjadi pengalaman yang mengesankan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Services Customers -->

<!-- Brands Cars -->
<section class="ftco-section testimony-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <h2 class="mb-3">Merk Mobil</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Toyota_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Toyota</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Honda_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Honda</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Daihatsu_logo.jpeg)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Daihatsu</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Hyundai_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Hyundai</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Suzuki_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Suzuki</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Wuling_logo.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Wuling</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Mitsubishi_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Mitsubishi</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Mazda_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Mazda</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/Mercedes_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">Mercedes</p>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url({{ asset('carbook-master') }}/images/brands/BMW_logo.png)">
                            </div>
                            <div class="text pt-4">
                                <p class="name">BMW</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Staff Commpany -->

<!-- Blog -->
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2>Blog Terbaru</h2>
            </div>
        </div>
        <div class="row d-flex">
            @foreach($recent as $item)
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="{{ url('blog/'. $item->slug) }}" class="block-20" style="background-image: url('{{ asset('storage/thumbnail/' . $item->thumbnail) }}');"></a>
                    <div class="text pt-4">
                        <div class="meta mb-3">
                            <div>
                                <a href="#">{{ $item->published_at->format('d M Y') }}</a>
                            </div>
                            <div>
                                <a href="#">{{ $item->author }}</a>
                            </div>
                        </div>
                        <h3 class="heading mt-2">
                            <a href="{{ url('blog/'. $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        <p>
                            <a href="{{ url('blog/'. $item->slug) }}" class="btn btn-primary">Read more</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--End Blog -->

<!-- Experience -->
<section class="ftco-counter ftco-section img bg-light" id="section-counter">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="{{ $counter['years_experienced'] }}">0</strong>
                        <span>Tahun <br>Pengalaman</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="{{ $counter['total_cars'] }}">0</strong>
                        <span>Total <br>Mobil</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text text-border d-flex align-items-center">
                        <strong class="number" data-number="{{ $counter['happy_customers'] }}">0</strong>
                        <span>Total <br>Pelanggan</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                <div class="block-18">
                    <div class="text d-flex align-items-center">
                        <strong class="number" data-number="{{ $counter['total_transaction'] }}">0</strong>
                        <span>Total <br>Transaksi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Experience -->

@endsection