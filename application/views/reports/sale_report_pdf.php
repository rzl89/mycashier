<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Penjualan</h2>
    <p><b>Tanggal Hari Ini:</b> <?= isset($tanggal_hari_ini) ? $tanggal_hari_ini : date('Y-m-d'); ?></p>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Invoice</th>
                <th>Tanggal & Waktu</th>
                <th>Kasir</th>
                <th>Pelanggan</th>
                <th>Total Sebelum Diskon</th>
                <th>Diskon</th>
                <th>Pajak</th>
                <th>Total Bayar</th>
                <th>Harga Modal (Cost)</th>
                <th>Keuntungan (Profit)</th>
                <th>Jumlah Transaksi</th>
                <th>Total Penjualan Hari Ini</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $tanggal_hari_ini = isset($tanggal_hari_ini) ? $tanggal_hari_ini : date('Y-m-d');
            foreach ($sales as $s) { 
                $is_today = isset($s->date) && date('Y-m-d', strtotime($s->date)) == $tanggal_hari_ini;
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $s->invoice; ?></td>
                <td><?= isset($s->date) ? date('Y-m-d H:i', strtotime($s->date)) : '-'; ?></td>
                <td><?= $s->user_name; ?></td>
                <td><?= $s->customer_name != null ? $s->customer_name : "Umum"; ?></td>
                <td><?= isset($s->total_price) ? indo_currency($s->total_price) : '-'; ?></td>
                <td><?= isset($s->discount) ? indo_currency($s->discount) : '-'; ?></td>
                <td><?= isset($s->tax) ? indo_currency($s->tax) : '0'; ?></td>
                <td><?= isset($s->final_price) ? indo_currency($s->final_price) : '-'; ?></td>
                <td><?= isset($s->cost) ? indo_currency($s->cost) : '-'; ?></td>
                <td><?= (isset($s->final_price) && isset($s->cost)) ? indo_currency($s->final_price - $s->cost) : '-'; ?></td>
                <td><?= $is_today ? 1 : 0; ?></td>
                <td><?= $is_today ? indo_currency($s->final_price) : '-'; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="9" style="text-align:right;"><b>Total Transaksi Hari Ini</b></td>
                <td><b><?= $jumlah_transaksi ?></b></td>
                <td><b><?= indo_currency($total_penjualan_hari_ini) ?></b></td>
            </tr>
        </tbody>
    </table>
</body>
</html>