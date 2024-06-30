@extends('layouts.backend.app',[
'title' => 'Ubah Produk'
])

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush


@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Produk</h1>
        <a href="{{ url('admin/produk') }}" class="d-none d-sm-inline-block btn btn-md btn-primary shadow-sm"><i class="fas fa-reply fa-sm text-white-50"></i> Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <form action="{{ url('admin/produk/update/'. $produk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input name="varian" type="text" class="form-control {{ $errors->has('varian') ? 'is-invalid':'' }}" value="{{ $produk->varian }}">
                                    <p class="text-danger">{{ $errors->first('varian') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Merk</label>
                                    <input name="merk" type="text" class="form-control {{ $errors->has('merk') ? 'is-invalid':'' }}" value="{{ $produk->merk }}">
                                    <p class=" text-danger">{{ $errors->first('merk') }}</p>
                                </div>
                                <label for="tipe">Tipe</label>
                                <select name="tipe" class="form-control {{ $errors->has('tipe') ? 'is-invalid':'' }}">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Sedan" {{ $produk->tipe == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="SUV" {{ $produk->tipe == 'SUV' ? 'selected' : '' }}>SUV</option>
                                    <option value="MPV" {{ $produk->tipe == 'MPV' ? 'selected' : '' }}>MPV</option>
                                    <option value="Hatchback" {{ $produk->tipe == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                    <option value="Bus" {{ $produk->tipe == 'Bus' ? 'selected' : '' }}>Bus</option>
                                    <option value="Mini Bus" {{ $produk->tipe == 'Mini Bus' ? 'selected' : '' }}>Mini Bus</option>
                                    <option value="LCGC" {{ $produk->tipe == 'LCGC' ? 'selected' : '' }}>LCGC</option>
                                    <option value="Hybride" {{ $produk->tipe == 'Hybride' ? 'selected' : '' }}>Hybride</option>
                                    <option value="Off Road" {{ $produk->tipe == 'Off Road' ? 'selected' : '' }}>Off Road</option>
                                    <option value="Listrik" {{ $produk->tipe == 'Listrik' ? 'selected' : '' }}>Listrik</option>
                                    <option value="Sport" {{ $produk->tipe == 'Sport' ? 'selected' : '' }}>Sport</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('tipe') }}</p>
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input name="warna" type="text" class="form-control {{ $errors->has('warna') ? 'is-invalid':'' }}" value="{{ $produk->warna }}">
                                    <p class="text-danger">{{ $errors->first('warna') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Plat</label>
                                    <input name="plat" type="text" class="form-control {{ $errors->has('plat') ? 'is-invalid':'' }}" value="{{ $produk->plat }}">
                                    <p class=" text-danger">{{ $errors->first('plat') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Deskripsi</label>
                                    <textarea name="keterangan" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}">{{ old('keterangan', $produk->keterangan ?? '') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('keterangan') }}</p>
                                </div>
                                <label for="feature">Feature</label>
                                <select id="feature" name="feature[]" multiple="multiple" class="form-control {{ $errors->has('feature') ? 'is-invalid' : '' }}">
                                    <option value="AC" {{ in_array('AC', $features) ? 'selected' : '' }}>AC</option>
                                    <option value="Airbag" {{ in_array('Airbag', $features) ? 'selected' : '' }}>Airbag</option>
                                    <option value="Sunroof" {{ in_array('Sunroof', $features) ? 'selected' : '' }}>Sunroof</option>
                                    <option value="GPS" {{ in_array('GPS', $features) ? 'selected' : '' }}>GPS</option>
                                    <option value="Child-Seat" {{ in_array('Child-Seat', $features) ? 'selected' : '' }}>Child-Seat</option>
                                    <option value="Luggage" {{ in_array('Luggage', $features) ? 'selected' : '' }}>Luggage</option>
                                    <option value="Music" {{ in_array('Music', $features) ? 'selected' : '' }}>Music</option>
                                    <option value="Seat-Belt" {{ in_array('Seat-Belt', $features) ? 'selected' : '' }}>Seat-Belt</option>
                                    <option value="Sleeping-Bed" {{ in_array('Sleeping-Bed', $features) ? 'selected' : '' }}>Sleeping-Bed</option>
                                    <option value="Water" {{ in_array('Water', $features) ? 'selected' : '' }}>Water</option>
                                    <option value="Bluetooth" {{ in_array('Bluetooth', $features) ? 'selected' : '' }}>Bluetooth</option>
                                    <option value="Onboard-Computer" {{ in_array('Onboard-Computer', $features) ? 'selected' : '' }}>Onboard-Computer</option>
                                    <option value="Audio-Input" {{ in_array('Audio-Input', $features) ? 'selected' : '' }}>Audio-Input</option>
                                    <option value="Long-Term-Trips" {{ in_array('Long-Term-Trips', $features) ? 'selected' : '' }}>Long-Term-Trips</option>
                                    <option value="Car-Kit" {{ in_array('Car-Kit', $features) ? 'selected' : '' }}>Car-Kit</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('feature') }}</p>
                                <img src="{{ asset('storage/produk/' . $produk->gambar) }}" class="img-responsive" width="150px">
                                <div class="form-group">
                                    <input type="file" name="gambar" class="form-control {{ $errors->has('gambar') ? 'is-invalid':'' }}">
                                    {{ $errors->first('gambar') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bbm">BBM</label>
                                    <input name="bbm" type="text" class="form-control {{ $errors->has('bbm') ? 'is-invalid':'' }}" value="{{ $produk->bbm }}">
                                    <p class="text-danger">{{ $errors->first('bbm') }}</p>
                                </div>
                                <label for="transmisi">Transmisi</label>
                                <select name="transmisi" class="form-control {{ $errors->has('transmisi') ? 'is-invalid':'' }}">
                                    <option value="" selected disabled hidden>Choose here</option>
                                    <option value="Manual" {{ $produk->transmisi == 'Manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="Matic" {{ $produk->transmisi == 'Matic' ? 'selected' : '' }}>Matic</option>
                                    <option value="Hybride" {{ $produk->transmisi == 'Hybride' ? 'selected' : '' }}>Hybride</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('transmisi') }}</p>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input name="tahun" type="number" class="form-control {{ $errors->has('tahun') ? 'is-invalid':'' }}" value="{{ $produk->tahun }}">
                                    <p class="text-danger">{{ $errors->first('tahun') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="jarak_tempuh">Jarak Tempuh</label>
                                    <input name="jarak_tempuh" type="number" class="form-control {{ $errors->has('jarak_tempuh') ? 'is-invalid':'' }}" value="{{ $produk->jarak_tempuh }}">
                                    <p class="text-danger">{{ $errors->first('jarak_tempuh') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_duduk">Tempat Duduk</label>
                                    <input name="tempat_duduk" type="number" class="form-control {{ $errors->has('tempat_duduk') ? 'is-invalid':'' }}" value="{{ $produk->tempat_duduk }}">
                                    <p class="text-danger">{{ $errors->first('tempat_duduk') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="bagasi">Bagasi</label>
                                    <input name="bagasi" type="number" class="form-control {{ $errors->has('bagasi') ? 'is-invalid':'' }}" value="{{ $produk->bagasi }}">
                                    <p class="text-danger">{{ $errors->first('bagasi') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Unit</label>
                                    <input name="unit" type="number" class="form-control {{ $errors->has('unit') ? 'is-invalid':'' }}" value="{{ $produk->unit }}">
                                    <p class="text-danger">{{ $errors->first('unit') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg mr-4 mb-3 float-right"><i class="fas fa-plus-square fa-sm text-white-50"></i> Ubah Produk</button>
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