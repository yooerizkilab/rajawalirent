@extends('layouts.backend.app',[
'title' => 'Detail Transaksi'
])

@push('css')
<!-- Tambahkan SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Transaksi</h1>
        <a href="{{ url('admin/transaksi/data-transaksi') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="float-right">
                                <a href="{{ url('admin/transaksi/print-transaksi/' . $transaksi->id) }}" class="btn btn-info {{ $transaksi->status != 2 ? 'disabled':'' }}" target="_blank">
                                    <i class="fas fa-download fa-sm text-white-50"></i> Print
                                </a>
                                <a href="{{ url('admin/transaksi/proses-transaksi/' . $transaksi->id) }}" class="btn btn-primary {{ $transaksi->status != 0 ? 'disabled':'' }}" onclick="event.preventDefault(); confirmAction('{{ url('admin/transaksi/proses-transaksi/' . $transaksi->id) }}', 'Kamu yakin !!')">
                                    <i class="fas fa-exchange-alt fa-sm"></i> Pinjamkan
                                </a>
                                <a href="{{ url('admin/transaksi/kembalikan-transaksi/' . $transaksi->id) }}" class="btn btn-success {{ $transaksi->status != 1 ? 'disabled':'' }}" onclick="event.preventDefault(); confirmAction('{{ url('admin/transaksi/kembalikan-transaksi/' . $transaksi->id) }}', 'Kamu yakin !!')">
                                    <i class="fas fa-sync-alt fa-sm"></i> Kembalikan
                                </a>
                                <a href="{{ url('admin/transaksi/batalkan-transaksi/' . $transaksi->id) }}" class="btn btn-danger {{ in_array($transaksi->status, [1,2,3]) ? 'disabled':'' }}" onclick="event.preventDefault(); confirmAction('{{ url('admin/transaksi/batalkan-transaksi/' . $transaksi->id) }}', 'Kamu yakin membatalkan transaksi !!')">
                                    <i class="fas fa-times fa-sm"></i> Batal
                                </a>
                            </div>
                        </div>
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
                            <h3>Detail Biaya</h3>
                            <div class="mb-2">
                                <table class="table table-hover">
                                    <tr>
                                        <th>Harga</th>
                                        <th></th>
                                        <th>Rp {{ number_format($transaksi->harga) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Denda</th>
                                        <th></th>
                                        <th>Rp {{ number_format($transaksi->denda) }}</th>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th class="text-white {{ $transaksi->status == 3 ? 'bg-secondary':'bg-success' }}">
                                            @if($transaksi->status == 3)
                                            <del> Rp {{ number_format($transaksi->harga + $transaksi->denda) }}</del>
                                            @else
                                            Rp {{ number_format($transaksi->harga + $transaksi->denda) }}
                                            @endif
                                        </th>
                                    </tr>
                                </table>
                            </div>
                            <hr>
                            <h3>Detail Pelanggan</h3>
                            <table class="table table-hover">
                                <tr>
                                    <th>NIK</th>
                                    <th></th>
                                    <th>{{ $transaksi->pelanggan->nik }}</th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th></th>
                                    <th>{{ $transaksi->pelanggan->nama }}</th>
                                </tr>
                                <tr>
                                    <th>No Telp</th>
                                    <th></th>
                                    <th>{{ $transaksi->pelanggan->notlp }}</th>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <th></th>
                                    <th>{{ $transaksi->pelanggan->alamat }}</th>
                                </tr>
                                <tr>
                                    <th>Foto KTP</th>
                                    <th></th>
                                    <th>
                                        <img src="{{ asset('storage/pelanggan/' . $transaksi->pelanggan->foto_ktp) }}" width="150px">
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h3>Detail Transaksi</h3>
                            <table class="table table-hover">
                                <tr>
                                    <th>Faktur</th>
                                    <th></th>
                                    <th>#{{ $transaksi->faktur }}</th>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th></th>
                                    <th>{!! $transaksi->status_label !!}</th>
                                </tr>
                                <tr>
                                    <th>Jaminan</th>
                                    <th></th>
                                    <th>
                                        <p>{{ $transaksi->jaminan }}</p>
                                        <img src="{{ asset('storage/transaksi/' . $transaksi->foto_jaminan) }}" width="150px">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Tgl Pinjam / Kembali</th>
                                    <th></th>
                                    <th>{{ $transaksi->tgl_pinjam->format('d-m-Y') }} / {{ $transaksi->tgl_kembali->format('d-m-Y') }}</th>
                                </tr>
                                <tr>
                                    <th>Tgl Dikembalikan</th>
                                    <th></th>
                                    <th>{{ $transaksi->tgl_dikembalikan }}</th>
                                </tr>
                                <tr>
                                    <th>Barang</th>
                                    <th></th>
                                    <th>
                                        <p>{{ $transaksi->produk->varian }} / {{ $transaksi->produk->merk }} ({{ $transaksi->produk->plat }})</p>
                                        <img src="{{ asset('storage/produk/' . $transaksi->produk->gambar) }}" width="200px">
                                    </th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Tambahkan SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmAction(url, message) {
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
@endpush