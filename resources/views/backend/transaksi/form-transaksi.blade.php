@extends('layouts.backend.app',[
'title' => 'Transaksi'
])

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Transaksi</h1>
        <a href="{{ url('admin/transaksi/data-transaksi') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>

    <form action="{{ url('admin/transaksi/save-transaksi') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @if(session('success'))
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{!! session('success') !!}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            @endif
            <div class="col-md-6">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Tipe Pelanggan</label>
                            <select name="tipe_pelanggan" class="form-control" id="tipepelanggan">
                                <option value="0">Baru</option>
                                <option value="1">Lama</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('tipe_pelanggan') }}</p>
                        </div>
                        <div id="existingcustomer" style="display:none">
                            <div class="form-group">
                                <label for="">Pelanggan</label>
                                <select name="pelanggan_id" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach($pelanggan as $row)
                                    <option value="{{ $row->id }}">{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('pelanggan_id') }}</p>
                            </div>
                        </div>
                        <div id="newcustomer">
                            <div class="form-group">
                                <label for="">Nik</label>
                                <input name="nik" type="text" class="form-control {{ $errors->has('nik') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('nik') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Foto KTP</label>
                                <input name="foto_ktp" type="file" class="form-control {{ $errors->has('foto_ktp') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('foto_ktp') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input name="nama" type="text" class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('nama') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input name="notlp" type="text" class="form-control {{ $errors->has('notlp') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('notlp') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input name="alamat" type="text" class="form-control {{ $errors->has('alamat') ? 'is-invalid':'' }}">
                                <p class="text-danger">{{ $errors->first('alamat') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Produk</label>
                            <select name="produk_id" class="form-control" id="produk" require>
                                <option value="">Pilih</option>
                                @foreach($produk as $row)
                                <option value="{{ $row->id }}">{{ $row->varian }} - {{ $row->tipe }} (Plat: {{ $row->plat }})</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('produk_id') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Layanan</label>
                            <select name="layanan" class="form-control" id="layanan" require>
                                <option value="">Pilih</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('layanan') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Jaminan</label>
                            <input name="jaminan" type="text" class="form-control {{ $errors->has('jaminan') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('jaminan') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Foto Jaminan</label>
                            <input name="foto_jaminan" type="file" class="form-control {{ $errors->has('foto_jaminan') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('foto_jaminan') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Tgl Pinjam</label>
                            <input name="tgl_pinjam" type="date" class="form-control {{ $errors->has('tgl_pinjam') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('tgl_pinjam') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Lama Pinjam</label>
                            <select name="lama_pinjam" class="form-control" require>
                                <option value="">Pilih</option>
                                <option value="1">1 Hari</option>
                                <option value="2">2 Hari</option>
                                <option value="3">3 Hari</option>
                                <option value="4">4 Hari</option>
                                <option value="5">5 Hari</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('lama_pinjam') }}</p>
                        </div>
                        <div class="float-right pt-3">
                            <button class="btn btn-primary btn-lg"><i class="fas fa-plus-square fa-sm text-white-50"></i> Simpan Transaksi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    $('#tipepelanggan').on('change', function() {
        if ($(this).val() == 0) {
            $('#newcustomer').show()
            $('#existingcustomer').hide()
        } else {
            $('#existingcustomer').show()
            $('#newcustomer').hide()
        }
    })

    $('#produk').on('change', function() {
        let produk_id = $(this).val()
        $.ajax({
            url: "{{ url('api/produk-harga') }}",
            type: 'GET',
            data: {
                id: produk_id
            },
            success: function(item) {
                $('#layanan').empty()
                $('#layanan').append('<option value="">Pilih</option>')
                $.each(item.data, function(key, row) {
                    $('#layanan').append('<option value="' + row.id + '">' + row.deskripsi + ' - Rp ' + row.harga_format + '</option>')
                })
            }
        })
    })
</script>
@endpush