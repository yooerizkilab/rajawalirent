@extends('layouts.backend.app',[
'title' => 'Data Transaksi'
])

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Transaksi</h1>
        <a href="{{ url('admin/transaksi/form-transaksi') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-plus-square fa-sm text-white-50"></i> Tambah Transaksi</a>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="col-md-3 offset-md-9">
                        <form action="{{ url('admin/transaksi/data-transaksi') }}" method="get">
                            <div class="form-group">
                                <input type="text" name="q" class="form-control" placeholder="Cari data..." value="{{ request()->q }}">
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Faktur</td>
                                    <td>Nama Pelanggan - Nik</td>
                                    <td>Tgl Pinjam / Kembali</td>
                                    <td>Harga</td>
                                    <td>Status</td>
                                    <td>Payment</td>
                                    <td width="20%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transaksi as $key =>$row)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><strong>#{{ $row->faktur }}</strong></td>
                                    <td>{{ $row->pelanggan->nama }} ({{ $row->pelanggan->nik }})</td>
                                    <td>{{ $row->tgl_pinjam->format('d-m-Y') }} / {{ $row->tgl_kembali->format('d-m-Y') }}</td>
                                    <td>Rp {{ number_format($row->harga) }}</td>
                                    <td>{!!$row->status_label !!}</td>
                                    @if($row->pay == 'success')
                                    <td><span class="badge badge-success">Dibayar</span></td>
                                    @elseif($row->pay== 'cancel')
                                    <td><span class="badge badge-warning">Batal</span></td>
                                    @elseif($row->pay == 'error')
                                    <td><span class="badge badge-danger">Error</span></td>
                                    @else
                                    <td><span class="badge badge-secondary">Witing</span></td>
                                    @endif
                                    <td>
                                        <form action="{{ url('admin/transaksi/hapus-transaksi/' . $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('admin/transaksi/print-transaksi/' . $row->id) }}" class="btn btn-primary btn-sm {{ $row->status != 2 ? 'disabled':'' }}" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
                                            <a href="{{ url('admin/transaksi/detail-transaksi/'. $row->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye fa-sm text-white-50"></i> Lihat</a>
                                            <a href="" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt fa-sm text-white-50"></i> Ubah</a>
                                            <button class="btn btn-danger btn-sm" {{ $row->status != 3 ? 'disabled':'' }}><i class="fas fa-trash fa-sm text-white-50"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak Ada Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {!! $transaksi->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection