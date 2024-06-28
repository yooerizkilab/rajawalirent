@extends('layouts.frontend.app',[
'title' => 'Pesan Mobil'

])

@push('css')
<style>
    .invoice {
        margin-top: 50px;
    }
</style>
@endpush

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('carbook-master') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{ url('/cars') }}">Cars <i class="ion-ios-arrow-forward"></i></a></span> <span>Pesan Mobil<i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Pesan Mobil Anda</h1>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/produk/' . $produk->gambar) }}');">
                    </div>
                    <div class="text">
                        <h2 class="mb-0">
                            <a href="{{ url('cars/view-cars/' . $produk->varian) }}">{{ $produk->varian }}</a>
                        </h2>
                        <div class="d-flex mb-3">
                            <span class="cat">{{ $produk->merk }}</span>
                            @foreach($produk->list_harga as $harga)
                            @if($harga->deskripsi == 'Per Hari')
                            <p class="price ml-auto">Rp {{ number_format($harga->harga) }}<span style="font-weight:bold;color:#5cb85c">/{{ $harga->deskripsi }}</span></p>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 block-9 mb-md-5">

                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">{{ session('success') }}</h4>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">{{ session('error') }}</h4>
                </div>
                @endif

                <form action="{{ url('cars/orders/'. $produk->varian) }}" method="get">
                    <label for="">Nik</label>
                    <div class="input-group mb-3">
                        <input type="text" name="nik" class="form-control" value="{{ request()->nik }}" placeholder="Masukkan Nik Anda">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-success">search</button>
                        </div>
                    </div>
                    <p class="text-danger">{{ $errors->first('nik') }}</p>
                </form>

                <form action="{{ url('cars/orders') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="nik" value="{{ request()->nik }}">

                    @if($pelanggan)
                    <div class="card card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th width="15%">Nik</th>
                                        <th width="20%">Nama</th>
                                        <th width="15%">No Tlp</th>
                                        <th width="25%">Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $pelanggan->nik }}</td>
                                        <td>{{ $pelanggan->nama }}</td>
                                        <td>{{ $pelanggan->notlp }}</td>
                                        <td>{{ $pelanggan->alamat }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else

                    <div class="form-group">
                        <label for="">Foto KTP</label>
                        <input name="foto_ktp" type="file" placeholder="Masukkan Foto KTP" class="form-control {{ $errors->has('foto_ktp') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('foto_ktp') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input name="nama" type="text" placeholder="Masukkan Nama Lengkap" value="{{ request()->nama }}" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('nama') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">No Telp</label>
                        <input name="notlp" type="text" placeholder="Masukkan No Telpon" value="{{ request()->notlp }}" class="form-control {{ $errors->has('notlp') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('notlp') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input name="alamat" type="text" placeholder="Masukkan Alamat" value="{{ request()->alamat }}" class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}">
                        <p class="text-danger">{{ $errors->first('alamat') }}</p>
                    </div>

                    @endif

                    <div class="form-group mt-3">
                        <label for="">Layanan</label>
                        <select class="custom-select" name="layanan" required>
                            <option selected disabled>Pilih Layanan</option>
                            @foreach($produkHarga as $row)
                            <option value="{{ $row->id }}">{{ $row->deskripsi }} - Rp. {{ number_format($row->harga) }}</option>
                            @endforeach
                        </select>
                        <p class="class text-danger">{{ $errors->first('layanan') }}</p>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Jaminan</label>
                                <input name="jaminan" type="text" placeholder="Masukkan Jaminan" value="{{ request()->jaminan }}" class="form-control {{ $errors->has('jaminan') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('jaminan') }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Foto Jaminan</label>
                                <input name="foto_jaminan" type="file" placeholder="Masukkan Foto Jaminan" class="form-control {{ $errors->has('foto_jaminan') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('foto_jaminan') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Tgl Pinjam</label>
                                <input name="tgl_pinjam" type="date" value="{{ request()->tgl_pinjam }}" class="form-control {{ $errors->has('tgl_pinjam') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('tgl_pinjam') }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Lama Pinjam</label>
                                <select name="lama_pinjam" class="form-control" value="{{ request()->lama_pinjam }}" require>
                                    <option selected disabled>Pilih Lama Pinjam</option>
                                    <option value="1">1 Hari</option>
                                    <option value="2">2 Hari</option>
                                    <option value="3">3 Hari</option>
                                    <option value="4">4 Hari</option>
                                    <option value="5">5 Hari</option>
                                    <option value="6">6 Hari</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('lama_pinjam') }}</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-5 float-right">Booking Cars</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection