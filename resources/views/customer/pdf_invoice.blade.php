<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Pesanan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; }
        .title { font-size: 20px; margin-bottom: 10px; }
        .line { border-top: 1px solid #ccc; margin: 15px 0; }
        .content { margin: 10px 0; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #999; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td.text-right {
            text-align: right;
        }

        td.text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>KABITA FOOD ORDER</h2>
        <p class="title">Invoice Pesanan</p>
        <div class="line"></div>
    </div>

    <div class="content">
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</p>
        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
        <p><strong>No. Antrian:</strong> {{ $order->queue_number }}</p>

        <h4>Detail Produk:</h4>
        <table>
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">Harga Satuan</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                   <td class="text-right">Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 20px;"><strong>Total Bayar:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    </div>

    <div class="line"></div>

    <div class="footer">
        Terima kasih telah memesan di Kabita Food Order.<br>
        Silakan tunjukkan invoice ini ke kasir.
    </div>
</body>
</html>
