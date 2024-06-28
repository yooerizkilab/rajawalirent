<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi</title>
</head>

<body>
    <h4 style="text-align: center;">
        <span>PT Rajawali Penanggungan</span><br>
        <span>Jl Kembangan Kembang Ringit</span><br>
        <span>Tlp: 080-12121-211</span><br>
        ==================================
    </h4>
    <table width="50%">
        <tr>
            <td width="50%">Faktur</td>
            <td>:</td>
            <td><strong>{{ $transaksi->faktur }}</strong></td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $transaksi->pelanggan->nik }}</td>
        </tr>
        <tr>
            <td>Nama Customer</td>
            <td>:</td>
            <td>{{ $transaksi->pelanggan->nama }}</td>
        </tr>
        <tr>
            <td>Barang Pinjam</td>
            <td>:</td>
            <td>{{ $transaksi->produk->varian }} / {{ $transaksi->produk->merk }} ({{ $transaksi->produk->plat }})</td>
        </tr>
        <tr>
            <td>Tgl Pinjam / Kembali</td>
            <td>:</td>
            <td>{{ $transaksi->tgl_pinjam->format('d-m-Y') }} / {{ $transaksi->tgl_kembali->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Tgl Dikembalikan</td>
            <td>:</td>
            <td>{{ $transaksi->tgl_kembali }}</td>
        </tr>
        <tr>
            <td>Jaminan</td>
            <td>:</td>
            <td>{{ $transaksi->jaminan }}</td>
        </tr>
        <tr>
            <td>Harga Sewa</td>
            <td>:</td>
            <td>Rp {{ number_format($transaksi->harga) }}</td>
        </tr>
        <tr>
            <td>Denda</td>
            <td>:</td>
            <td>Rp {{ number_format($transaksi->denda) }}</td>
        </tr>
        <tr>
            <td>Total Sewa</td>
            <td>:</td>
            <td>Rp {{ number_format($transaksi->harga + $transaksi->denda) }}</td>
        </tr>
    </table>

</body>

</html>