@extends('layouts.backend.app',[
'title' => 'Tambah Harga Produk'
])

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Harga Produk</h1>
        <a href="{{ url('admin/produk') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"">
                        {{ session('success') }}
                        <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form action="{{ url('admin/produk/harga/'. $produk->id) }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="">Produk</label>
                            <input name="varian" type="text" class="form-control {{ $errors->has('varian') ? 'is-invalid':'' }}" value="{{ $produk->varian }}" readonly>
                            <p class="text-danger">{{ $errors->first('varian') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <select name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}">
                                <option value="" selected disabled hidden>Choose here</option>
                                <option value="Per Hari">Per Hari</option>
                                <!-- <option value="Lainnya">Lainnya</option> -->
                                <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                            </select>
                            <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Harga</label>
                            <input name="harga" type="number" class="form-control {{ $errors->has('harga') ? 'is-invalid':'' }}">
                            <p class=" text-danger">{{ $errors->first('harga') }}</p>
                        </div>
                        <button class="btn btn-primary btn-md"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Harga Produk</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produk->list_harga as $row)
                                <tr>
                                    <td>{{ $row->deskripsi }}</td>
                                    <td>Rp {{ number_format($row->harga) }}</td>
                                    <td>
                                        <form action="{{ url('admin/produk/harga', $row->id) }}" method="post">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash fa-sm text-white-50"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection