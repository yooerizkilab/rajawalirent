<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
</head>

<body>
    <h1>Invoice</h1>
    <p>Nama: {{ $transaksi->pelanggan->nama }}</p>
    <p>Harga: {{ $transaksi->harga }}</p>
    <p>Status: {{ $transaksi->status }}</p>
    <p>Order ID: {{ $transaksi->order_id }}</p>
</body>

</html>