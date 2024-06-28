@extends('layouts.backend.app',[
'title' => 'Laporan'
])

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan</h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form action="{{ url('admin/report') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="">Dari</label>
                                    <input type="date" name="start" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Ke</label>
                                    <input type="date" name="end" class="form-control">
                                </div>
                                <div class="float-right">
                                    <button class="btn btn-primary btn-md"><i class="fas fa-download fa-sm text-white-50"></i> Export Laporan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection