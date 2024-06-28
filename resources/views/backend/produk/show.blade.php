@extends('layouts.backend.app',[
'title' => 'View Produk'
])

@push('css')

@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Produk</h1>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mobil</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="text-left">
                                <!-- Menambahkan class untuk memberikan frame pada gambar -->
                                <img src="{{ asset('storage/produk/' . $produk->gambar) }}" class="img-responsive img-thumbnail" width="400px">
                            </div>
                        </div>
                        <div class="col">
                            <h4 class="mb-4">Informasi Produk</h4>
                            <dl class="row">
                                <dd class="col-sm-4">Nama</dd>
                                <dt class="col-sm-8">{{ $produk->varian }}</dt>
                                <dd class="col-sm-4">Merk</dd>
                                <dt class="col-sm-8">{{ $produk->merk }}</dt>
                                <dd class="col-sm-4">Tipe</dd>
                                <dt class="col-sm-8">{{ $produk->tipe }}</dt>
                                <dd class="col-sm-4">No Polisi</dd>
                                <dt class="col-sm-8">{{ $produk->plat }}</dt>
                                <dd class="col-sm-4">Warna</dd>
                                <dt class="col-sm-8">{{ $produk->warna }}</dt>
                                <dd class="col-sm-4">Tahun</dd>
                                <dt class="col-sm-8">{{ $produk->tahun }}</dt>
                                <dd class="col-sm-4">Kursi</dd>
                                <dt class="col-sm-8">{{ $produk->tempat_duduk }} Kursi</dt>
                            </dl>
                        </div>
                    </div>
                    <div class="float-right mt-3">
                        <form action="{{ url('admin/produk/delete/' . $produk->id) }}" method="post" style="display:inline;">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus</button>
                        </form>
                        <a href="{{ url('admin/produk/edit/' . $produk->id) }}" type="submit" class="btn btn-warning"><i class="fas fa-pencil-alt fa-sm text-white-50"></i> Ubah</a>
                        <a href="{{ url('admin/produk') }}" type="submit" class="btn btn-primary"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')

@endpush