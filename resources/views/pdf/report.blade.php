<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Transaksi</title>
</head>

<body>
    <h4 style="text-align: center;">
        <span>PT Rajawali Penanggungan</span><br>
        <span>Jl Kembangan Kembang Ringit</span><br>
        <span>Tlp: 080-12121-211</span><br>
        ==================================
    </h4>
    <h4 style="text-align: center;">laporan Penghasilan</h4>
    <p style="text-align: center;">Periode {{ $start }} s/d {{ $end }}</p>
    <table width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Penghasilan</th>
                <th>Sewa</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $key => $row)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $row->tgl_pinjam->format('d-m-Y') }}</td>
                <td>Rp {{ number_format($row->total) }}</td>
                <td>Rp {{ number_format($row->sewa) }}</td>
                <td>Rp {{ number_format($row->total_denda) }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</body>

</html>