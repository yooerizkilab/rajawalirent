@extends('layouts.backend.app',[
'title' => 'Detail Pelanggan'
])

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pelanggan</h1>
        <a href="{{ url('admin/pelanggan') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Detail Pelanggan</h3>
                            <div class="mb-2">
                                <table class="table table-borderless table-hover">
                                    <tr>
                                        <th width="15%">Nik</th>
                                        <td width="5%">:</td>
                                        <td>{{ $pelanggan->nik }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>:</td>
                                        <td>{{ $pelanggan->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telp</th>
                                        <td>:</td>
                                        <td>{{ $pelanggan->notlp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>:</td>
                                        <td>{{ $pelanggan->alamat }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <h3>Total Poin</h3>
                                <h1><i class="fas fa-fw fa-gift"></i> {{ $pelanggan->poin }}</h1>
                                <hr>
                                <h4>Poin Digunakan</h4>
                                <h1><i class="fas fa-fw fa-box-open"></i> {{ $pelanggan->poinused }}</h1>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3">Riwayat Mutasi Poin</h4>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Poin</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pelanggan->mutasi as $key => $row)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{!! $row->type_label !!} {{ $row->poin }}</td>
                                            <td>{{ $row->keterangan }} </td>
                                            @if($row->type == 1)
                                            <td><span class="badge badge-pill badge-success">Poin Plus</span></td>
                                            @else
                                            <td><span class="badge badge-pill badge-danger">Poin Minus</span></td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada riwayat</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3 text-center">Claim Reward Poin</h4>
                            @if(session('success'))
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert"">
                                {{ session('success') }}
                                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert"">
                                {{ session('error') }}
                                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <form action="{{ url('admin/pelanggan/reward/'. $pelanggan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-10">
                                        <label for="">Reward</label>
                                        <select class="form-control" name="reward" required>
                                            <option value="" selected disabled hidden>Choose here</option>
                                            @foreach($reward as $row)
                                            <option value="{{ $row->id }}">{{ $row->title }} - {{ $row->poin }} Poin</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('reward') }}</p>
                                </div>
                                <div class="col-md-11">
                                    <button class="btn btn-primary float-right">Claim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection