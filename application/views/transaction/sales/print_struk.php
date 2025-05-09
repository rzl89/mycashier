<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myPos</title>
    <style type="text/css">
        html {
            font-family: "Verdana, Arial";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <b>< BSC-MART></BSC-MART></b><br>
            Jl. Raya taktakan, cilowong, kec. taktakan<br>
            SMKN 5 KOTA SERANG<br>
            <hr style="border-top:1px dashed #000; margin:8px 0;">
        </div>
        <div style="text-align:center; margin-top:5px;">
            Tanggal: <?= date('d/m/Y', strtotime($sale->date)); ?><br>
            Waktu: <?= date('H:i:s', strtotime($sale->sale_created)); ?>
        </div>
        <hr style="border-top:1px dashed #000; margin:8px 0;">
        <table style="width:100%; font-size:12px;">
            <tr>
                <th align="left">Barang</th>
                <th align="center">Jml</th>
                <th align="right">Harga</th>
            </tr>
            <?php foreach ($sale_detail as $sd) { ?>
            <tr>
                <td><?= $sd->name; ?></td>
                <td align="center"><?= $sd->qty; ?></td>
                <td align="right">Rp <?= number_format(($sd->price - $sd->discount_item) * $sd->qty,0,',','.'); ?></td>
            </tr>
            <?php } ?>
        </table>
        <hr style="border-top:1px dashed #000; margin:8px 0;">
        <table style="width:100%; font-size:12px;">
            <tr>
                <td>Subtotal:</td>
                <td align="right">Rp <?= number_format($sale->total_price,0,',','.'); ?></td>
            </tr>
            <tr>
                <td>Pajak:</td>
                <td align="right">Rp 0</td>
            </tr>
            <tr>
                <td><b>Total:</b></td>
                <td align="right"><b>Rp <?= number_format($sale->final_price,0,',','.'); ?></b></td>
            </tr>
        </table>
        <hr style="border-top:1px dashed #000; margin:8px 0;">
        <table style="width:100%; font-size:12px;">
            <tr>
                <td>Metode Pembayaran:</td>
                <td align="right">Tunai</td>
            </tr>
            <tr>
                <td>Jumlah Diterima:</td>
                <td align="right">Rp <?= number_format($sale->cash,0,',','.'); ?></td>
            </tr>
            <tr>
                <td>Kembalian:</td>
                <td align="right">Rp <?= number_format($sale->uang_kembalian,0,',','.'); ?></td>
            </tr>
        </table>
        <hr style="border-top:1px dashed #000; margin:8px 0;">
        <div style="text-align:center; margin:10px 0;">
            
        </div>
        <div class="thanks">
            Terima kasih telah berbelanja<br>dengan kami!
        </div>
        <div style="text-align:center; font-size:10px; margin-top:8px;">
            This receipt is evidence of a transaction<br>and should be kept for your records.
        </div>
    </div>
</body>

</html>