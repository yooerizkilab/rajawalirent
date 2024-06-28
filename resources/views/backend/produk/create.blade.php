@extends('layouts.backend.app',[
'title' => 'Tambah Produk'
])

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
        <a href="{{ url('admin/produk') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-md">
            <div class="card border-left-primary shadow h-100 py-2">
                <form action="{{ url('admin/produk') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="varian">Nama</label>
                                    <input name="varian" id="varian" type="text" class="form-control {{ $errors->has('varian') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('varian') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="merk">Merk</label>
                                    <input name="merk" id="merk" type="text" class="form-control {{ $errors->has('merk') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('merk') }}</p>
                                </div>
                                <label for="tipe">Tipe</label>
                                <select name="tipe" class="form-control {{ $errors->has('tipe') ? 'is-invalid':'' }}">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                    <option value="MPV">MPV</option>
                                    <option value="Hatchback">Hatchback</option>
                                    <option value="Bus">Bus</option>
                                    <option value="Mini Bus">Mini Bus</option>
                                    <option value="LCGC">LCGC</option>
                                    <option value="Hybride">Hybride</option>
                                    <option value="Off Road">Off Road</option>
                                    <option value="Listrik">Listrik</option>
                                    <option value="Sport">Sport</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('tipe') }}</p>
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input name="warna" id="warna" type="text" class="form-control {{ $errors->has('warna') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('warna') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="plat">Plat</label>
                                    <input name="plat" id="plat" type="text" class="form-control {{ $errors->has('plat') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('plat') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Deskripsi</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid':'' }}"></textarea>
                                    <p class=" text-danger">{{ $errors->first('keterangan') }}</p>
                                </div>
                                <label for="feature">Feature</label>
                                <select id="feature" name="feature[]" multiple="multiple" class="form-control {{ $errors->has('feature') ? 'is-invalid':'' }}">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="AC">AC</option>
                                    <option value="Airbag">Airbag</option>
                                    <option value="Sunroof">Sunroof</option>
                                    <option value="GPS">GPS</option>
                                    <option value="Child-Seat">Child-Seat</option>
                                    <option value="Luggage">Luggage</option>
                                    <option value="Music">Music</option>
                                    <option value="Seat-Belt">Seat-Belt</option>
                                    <option value="Sleeping-Bed">Sleeping-Bed</option>
                                    <option value="Water">Water</option>
                                    <option value="Bluetooth">Bluetooth</option>
                                    <option value="Onboard-Computer">Onboard-Computer</option>
                                    <option value="Audio-Input">Audio-Input</option>
                                    <option value="Long-Term-Trips">Long-Term-Trips</option>
                                    <option value="Car-Kit">Car-Kit</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('feature') }}</p>
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control {{ $errors->has('gambar') ? 'is-invalid':'' }}">
                                    {{ $errors->first('gambar') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bbm">BBM</label>
                                    <input name="bbm" id="bbm" type="text" class="form-control {{ $errors->has('bbm') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('bbm') }}</p>
                                </div>
                                <label for="transmisi">Transmisi</label>
                                <select name="transmisi" class="form-control {{ $errors->has('transmisi') ? 'is-invalid':'' }}">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Manual">Manual</option>
                                    <option value="Matic">Matic</option>
                                    <option value="Hybride">Hybride</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('transmisi') }}</p>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input name="tahun" id="tahun" type="number" class="form-control {{ $errors->has('tahun') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('tahun') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jarak_tempuh">Jarak Tempuh</label>
                                    <input name="jarak_tempuh" id="jarak_tempuh" type="number" class="form-control {{ $errors->has('jarak_tempuh') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('jarak_tempuh') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_duduk">Tempat Duduk</label>
                                    <input name="tempat_duduk" id="tempat_duduk" type="number" class="form-control {{ $errors->has('tempat_duduk') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('tempat_duduk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="bagasi">Bagasi</label>
                                    <input name="bagasi" id="bagasi" type="number" class="form-control {{ $errors->has('bagasi') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('bagasi') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="unit">Unit</label>
                                    <input name="unit" id="unit" type="number" class="form-control {{ $errors->has('unit') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('unit') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg mr-4 mb-3 float-right"><i class="fas fa-plus-square fa-sm text-white-50"></i> Simpan Produk</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#feature').select2();
    });
</script>
@endpush