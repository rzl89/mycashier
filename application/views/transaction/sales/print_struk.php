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
            font-size: 10px;
            table-layout: fixed;
        }
        th, td {
            word-break: break-all;
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
            <b>BSC-MART</b><br>
            Jl. Raya Taktakan, Cilowong<br>
            SMKN 5 KOTA SERANG<br>
            Tanggal: <?= date('d/m/Y', strtotime($sale->date)) ?><br>
            Waktu: <?= date('H:i:s', strtotime($sale->sale_created)) ?> <br>
        </div>
        <hr style="border:1px dashed #000; margin:8px 0;">
        <table width="100%" style="font-size:12px;">
            <tr><th align="left">Barang</th><th>Jml</th><th align="right">Harga</th></tr>
            <tr><td colspan="3"><hr style="border:1px dashed #000; margin:4px 0;"></td></tr>
            <?php foreach ($sale_detail as $sd) { ?>
            <tr>
                <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;max-width:80px;"><?= $sd->name; ?></td>
                <td align="center"><?= $sd->qty; ?></td>
                <td align="right">Rp <?= number_format($sd->price,0,',','.'); ?></td>
            </tr>
            <?php } ?>
            <tr><td colspan="3"><hr style="border:1px dashed #000; margin:4px 0;"></td></tr>
        </table>
        <table width="100%" style="font-size:12px;">
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
        <hr style="border:1px dashed #000; margin:8px 0;">
        <table width="100%" style="font-size:12px;">
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
        <hr style="border:1px dashed #000; margin:8px 0;">
        <div style="text-align:center; margin:10px 0;">
            <?php
            // Barcode logic
            $barcode_path = isset($sale->invoice) ? base_url('uploads/barcode/struk-'.$sale->invoice.'.png') : '';
            if(file_exists(FCPATH.'uploads/barcode/struk-'.$sale->invoice.'.png')) {
                echo '<img src="'.$barcode_path.'" style="width:140px; height:40px;">';
            } else {
                // fallback jika file tidak ada
                echo '<div style="width:140px;height:40px;border:1px dashed #ccc;display:inline-block;"></div>';
            }
            ?>
        </div>
        <div style="text-align:center; font-size:13px; margin-top:10px;">
            Terima kasih telah berbelanja<br>dengan kami!
        </div>
        <div style="font-size:10px; text-align:center; margin-top:10px;">
            This receipt is evidence of a transaction<br>and should be kept for your records.
        </div>
    </div>
</body>

</html>