@extends('layouts.backend.app',[
'title' => 'Pelanggan'
])

@push('css')
@endpush


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pelanggan</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="offset-md-9 col-md-3 mb-4">
                        <form action="{{ url('admin/pelanggan') }}" method="get">
                            <input type="text" name="q" class="form-control" placeholder="Cari data..." value="{{ request()->q }}">
                        </form>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"">
                        {{ session('success') }}
                        <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nik</th>
                                    <th>Nama</th>
                                    <th>No Tlp</th>
                                    <th>Alamat</th>
                                    <th>Poin</th>
                                    <th>Poin Digunakan</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($pelanggan as $key => $item)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{ url('admin/pelanggan/show/'. $item->id) }}">{{ $item->nik }}</a></td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->notlp }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->poin }}</td>
                                    <td>{{ $item->poinused }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right">
                        {!! $pelanggan->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush