<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        .body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        #receipt {
            width: 300px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }

        h2 {
            text-align: center;
            font-size: 1.2em;
        }

        span {
            text-align: center;
            font-size: 14px;
        }

        p.span {
            text-align: center;
            font-size: 12px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        #total {
            font-weight: bold;
            margin-top: 10px;
        }

        #printButton {
            margin-top: 10px;
            display: block;
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .total {
            background: rgb(1, 147, 1);
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .total p {
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>

<body class="body" onload="window.print()">
    <div id="receipt"class="receipt">
        <h2>Coffeshop Katanya</h2>
        <p class="span">Jln Sama Aku mau ga</p>
        <div class="item">
            <p class="span">{{ $transaksi->order->no_order }}</p>
            <p class="span">@customDateFormat($transaksi->waktu_bayar)</p>
        </div>
        <div class="item" style="margin-top: 16px">
            <span>Item</span>
            <span>Qty</span>
            <span>Harga</span>
        </div>
        <hr style="border-top: 1px dashed #5b5b5b;">
        @foreach ($transaksi->order->orderdetail as $detail)
            <div class="item">
                <span>{{ $detail->menu->nama }}</span>
                <span>{{ $detail->jumlah }} </span>
                <span>x @currency($detail->menu->harga)</span>

            </div>
        @endforeach
        <hr style="border-top: 1px dashed #5b5b5b;">
        <div id="item">
            <span>{{ $transaksi->status }}</span>
            <span style="float: right;">@currency($transaksi->uang)</span>
        </div>
        <div id="item">
            <span>Total:</span>
            <span style="float: right;">@currency($transaksi->total)</span>
        </div>
        <hr style="border-top: 1px dashed #5b5b5b;">

        <div id="item">
            <span>Kembalian:</span>
            <span style="float: right;">@currency($transaksi->kembalian)</span>
        </div>



        <hr style="border-top: 1px dashed #5b5b5b;">

        <div class="item">
            <span>Terima Kasih sudah belanja ditempat kami, semoga sehat selalu :)</span>

        </div>
        <div class="item">

            <p class="span">Ig : @katanya</p>
            <p class="span">Titktok : @katanya</p>
        </div>

        {{-- <button id="printButton" onclick="printReceipt()">Print Struk</button> --}}


    </div>




</body>

</html>
