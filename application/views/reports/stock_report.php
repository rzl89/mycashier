<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan Stok</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Stok</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Stok Produk</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $batas_minimum = 5;
                        if(isset($items) && count($items) > 0) {
                            foreach($items as $item) { 
                                $is_low = $item->stock <= $batas_minimum;
                        ?>
                        <tr<?= $is_low ? ' style="background-color:#fff3cd;"' : '' ?>>
                            <td><?= $no++ ?></td>
                            <td><?= $item->barcode ?></td>
                            <td><?= $item->name ?></td>
                            <td><?= $item->name_category ?></td>
                            <td><?= $item->name_unit ?></td>
                            <td>
                                <?= $item->stock ?>
                                <?php if($is_low): ?>
                                    <span class="badge badge-warning ml-2">Stok Menipis!</span>
                                <?php endif; ?>
                            </td>
                            <td><?= indo_currency($item->price) ?></td>
                        </tr>
                        <?php }} else { ?>
                        <tr><td colspan="7" class="text-center">Tidak ada data stok.</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>