@extends('layouts.frontend.app',[
'title' => 'Mobil'

])

@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('carbook-master') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Pilih Mobil Anda</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-md-6">
                <form action="{{ url('/cars') }}" method="GET" class="search-form">
                    <div class="form-group">
                        <span class="icon icon-search"></span>
                        <input type="text" name="q" class="form-control" placeholder="Search Yours Cars Feature" value="{{ request()->q }}">
                    </div>
                </form>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-5">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=') }}">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=lcgc') }}">Small/City Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=mpv') }}">Mpv</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=suv') }}">Suv</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=hatchback') }}">Hacthback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=bus') }}">Bus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cars?category=electric') }}">Electric Car</a>
                </li>
            </ul>
        </div>

        <div class="row">
            @if($produk->count() > 0)
            @foreach ($produk as $row)
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/produk/' . $row->gambar) }}');">
                    </div>
                    <div class="text">
                        <h2 class="mb-0">
                            <a href="{{ url('cars/show/' . $row->varian) }}">{{ $row->varian }}</a>
                        </h2>
                        <div class="d-flex mb-3">
                            <span style="font-weight:bold; color:black" class="cat">{{ $row->merk }}</span>
                            @foreach($row->list_harga as $item)
                            <p class="price ml-auto">Rp {{ number_format($item->harga) }}<span style="font-weight:bold;color:#5cb85c">/{{ $item->deskripsi }}</span></p>
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
            @else
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    No cars found.
                </div>
            </div>
            @endif
        </div>

        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul>
                        <!-- Tampilkan tautan ke halaman sebelumnya jika tersedia -->
                        @if ($produk->currentPage() == 1)
                        <li class="disabled"><span>&lt;</span></li>
                        @else
                        <li><a href="{{ $produk->previousPageUrl() }}">&lt;</a></li>
                        @endif

                        <!-- Tampilkan nomor halaman -->
                        @for ($i = 1; $i <= $produk->lastPage(); $i++)
                            @if ($i == $produk->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                            @else
                            <li><a href="{{ $produk->url($i) }}">{{ $i }}</a></li>
                            @endif
                            @endfor

                            <!-- Tampilkan tautan ke halaman berikutnya jika tersedia -->
                            @if ($produk->hasMorePages())
                            <li><a href="{{ $produk->nextPageUrl() }}">&gt;</a></li>
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