<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Rental Mobil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .invoice h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin-bottom: 30px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .invoice-table th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <h2>Invoice Rental Mobil</h2>
        <div class="invoice-details">
            <p><strong>Nama:</strong> John Doe</p>
            <p><strong>Tanggal:</strong> 20 April 2024</p>
            <p><strong>No. Invoice:</strong> INV123456</p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mobil Toyota Avanza</td>
                    <td>$50/hari</td>
                    <td>3 hari</td>
                    <td>$150</td>
                </tr>
                <tr>
                    <td>Mobil Honda Civic</td>
                    <td>$70/hari</td>
                    <td>2 hari</td>
                    <td>$140</td>
                </tr>
            </tbody>
        </table>
        <div class="total">
            <p><strong>Total:</strong> $290</p>
        </div>
    </div>
</body>

</html>