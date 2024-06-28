@extends('layouts.frontend.app',[
'title' => 'Detail Pesanan'

])

@push('css')
<!-- Tambahkan SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

@section('content')
<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('carbook-master') }}/images/bg_3.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="{{ url('/cars') }}">Cars <i class="ion-ios-arrow-forward"></i></a></span> <span>Detail Pesanan<i class="ion-ios-arrow-forward"></i></span></p>
                <h1 class="mb-3 bread">Detail Pesanan Anda</h1>
            </div>
        </div>
    </div>
</section>


<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">

            <div class="col-md-4">
                <div class="car-wrap rounded ftco-animate">
                    <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/produk/' . $transaksi->produk->gambar) }}');">
                    </div>
                    <div class="text">
                        <h2 class="mb-0">
                            <a href="">{{ $transaksi->produk->varian }}</a>
                        </h2>
                        <div class="d-flex mb-3">
                            <span class="cat">{{ $transaksi->produk->merk }}</span>
                            <p class="price ml-auto">Rp {{ number_format($produkHarga->harga) }}<span style="font-weight:bold;color:#5cb85c">/ {{ $produkHarga->deskripsi }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 block-9 mb-md-5">

                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">{{ session('success') }}</h4>
                </div>
                @endif

                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <h2>Detail Pesanan Anda</h2>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informasi Pelanggan</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Nama:</dt>
                                <dd class="col-sm-8">{{ $transaksi->pelanggan->nama }}</dd>
                                <dt class="col-sm-4">Nik</dt>
                                <dd class="col-sm-8">{{ $transaksi->pelanggan->nik }}</dd>
                                <dt class="col-sm-4">Tlp:</dt>
                                <dd class="col-sm-8">{{ $transaksi->pelanggan->notlp }}</dd>
                                <dt class="col-sm-4">Alamat:</dt>
                                <dd class="col-sm-8">{{ $transaksi->pelanggan->alamat }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h5>Informasi Transaksi</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Produk:</dt>
                                <dd class="col-sm-8">{{ $transaksi->produk->varian }}</dd>
                                <dt class="col-sm-4">Tanggal Pinjam:</dt>
                                <dd class="col-sm-8">{{ $transaksi->tgl_pinjam->format('d M Y') }}</dd>
                                <dt class="col-sm-4">Tanggal Kembali:</dt>
                                <dd class="col-sm-8">{{ $transaksi->tgl_kembali->format('d M Y') }}</dd>
                                <dt class="col-sm-4">Status Pesanan:</dt>
                                <dd class="col-sm-8">{!! $transaksi->status_label !!}</dd>
                                <dt class="col-sm-4">Status Pembayaran:</dt>
                                @if($transaksi->pay == 'success')
                                <dd class="col-sm-8"><span class="badge badge-success">Success</span></dd>
                                @elseif($transaksi->pay == 'cancel')
                                <dd class="col-sm-8"><span class="badge badge-warning">Cencel</span></dd>
                                @elseif($transaksi->pay == 'error')
                                <dd class="col-sm-8"><span class="badge badge-danger">Error</span></dd>
                                @else
                                <dd class="col-sm-8"><span class="badge badge-secondary">Witing</span></dd>
                                @endif
                                <dt class="col-sm-4">Harga:</dt>
                                <dd class="col-sm-8">Rp {{ number_format($transaksi->harga) }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col text-right">
                            @if($transaksi->pay != 'success' ?? 'cancle')
                            <form id="payment-form" action="{{ url('cars/pay') }}" method="post" class="d-inline">
                                @csrf
                                <input type="hidden" name="nama" value="{{ $transaksi->pelanggan->nama }}">
                                <input type="hidden" name="harga" value="{{ $transaksi->harga }}">
                                <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                                <button type="button" class="btn btn-success btn-lg" id="pay-button">Bayar</button>
                            </form>
                            @else
                            <form id="invoice-form" action="{{ url('cars/invoice') }}" method="post">
                                @csrf
                                <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                                <button type="button" class="btn btn-info mr-2 btn-lg" id="invoice-button">Invoice</button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            <p style="color:red;">"Struk harap dibawa saat Pengambilan/Pengembalian kendaraan"</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@push('scripts')
<!-- Tambahkan SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<!-- midtrasn -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();

        $.ajax({
            url: "{{ url('cars/pay') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                nama: $('input[name=nama]').val(),
                harga: $('input[name=harga]').val(),
                transaksi_id: $('input[name=transaksi_id]').val(),
            },
            success: function(data) {
                snap.pay(data.snapToken, {
                    onSuccess: handlePaymentResult('success'),
                    onPending: handlePaymentResult('pending'),
                    onError: handlePaymentResult('error')
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    function handlePaymentResult(status) {
        return function(result) {
            $.ajax({
                url: "{{ url('cars/pay/notification') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    transaksi_id: $('input[name=transaksi_id]').val(),
                    pay: status
                },
                success: function(response) {
                    let title, text, icon;
                    switch (status) {
                        case 'success':
                            title = 'Success';
                            text = 'Payment was successful!';
                            icon = 'success';
                            break;
                        case 'pending':
                            title = 'Pending';
                            text = 'Your payment is pending.';
                            icon = 'question';
                            break;
                        case 'error':
                            title = 'Error';
                            text = 'There was an error processing your payment.';
                            icon = 'error';
                            break;
                    }
                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "{{ url('cars/orders-detail/') }}/" + $('input[name=transaksi_id]').val();
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            console.log(result);
        }
    }

    $('#invoice-button').click(function() {
        $('#invoice-form').submit();
    });
</script>
@endpush