<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Sale Report</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">History Sale</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="<?= site_url('reports/export_excel'); ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i> Export Excel</a>
                    <a href="<?= site_url('reports/export_csv'); ?>" class="btn btn-info btn-sm"><i class="fa fa-file-csv"></i> Export CSV</a>
                    <a href="<?= site_url('reports/export_pdf'); ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Export PDF</a>
                </div>
            </div>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>">
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Invoice</th>
                            <th>Tanggal & Waktu</th>
                            <th>Kasir</th>
                            <th>Pelanggan</th>
                            <th>Total Sebelum Diskon</th>
                            <th>Diskon</th>
                            <th>Pajak</th>
                            <th>Harga Modal (Cost)</th>
                            <th>Keuntungan (Profit)</th>
                            <th>Total Bayar</th>
                            <th>Jumlah Transaksi</th>
                            <th>Total Penjualan Hari Ini</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $total_penjualan_hari_ini = 0;
                        $jumlah_transaksi = 0;
                        $tanggal_hari_ini = date('Y-m-d');
                        foreach ($sale as $s) { 
                            $is_today = isset($s->date) && date('Y-m-d', strtotime($s->date)) == $tanggal_hari_ini;
                            if ($is_today) {
                                $total_penjualan_hari_ini += isset($s->final_price) ? $s->final_price : 0;
                                $jumlah_transaksi++;
                            }
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td id="invoice"><?= $s->invoice; ?></td>
                                <td><?= isset($s->date) ? date('Y-m-d H:i', strtotime($s->date)) : '-'; ?></td>
                                <td style="text-align: center;"><span class="badge badge-secondary"><?= $s->user_name; ?></span></td>
                                <td style="text-align: center;"><?= $s->customer_name != null ? $s->customer_name : "Umum"; ?></td>
                                <td><?= isset($s->total_price) ? indo_currency($s->total_price) : '-'; ?></td>
                                <td><?= isset($s->discount) ? indo_currency($s->discount) : '-'; ?></td>
                                <td><?= isset($s->tax) ? indo_currency($s->tax) : '0'; ?></td>
                                <td><?= isset($s->cost) ? indo_currency($s->cost) : '-'; ?></td>
                                <td><?= isset($s->profit) ? indo_currency($s->profit) : (isset($s->final_price) && isset($s->cost) ? indo_currency($s->final_price - $s->cost) : '-'); ?></td>
                                <td><?= isset($s->final_price) ? indo_currency($s->final_price) : '-'; ?></td>
                                <td><?= $is_today ? 1 : 0; ?></td>
                                <td><?= $is_today ? indo_currency($s->final_price) : '-'; ?></td>
                                <td>
                                    <form action="<?= site_url('reports/delete_sale/'.$s->invoice) ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="11" style="text-align:right;"><b>Total Transaksi Hari Ini</b></td>
                            <td><b><?= $jumlah_transaksi ?></b></td>
                            <td><b><?= indo_currency($total_penjualan_hari_ini) ?></b></td>
                            <td></td> <!-- Kosongkan kolom Aksi agar tetap total 14 -->
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-detail">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Stock</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Item Name</th>
                                <td>:</td>
                                <td>
                                    <span id="item_name">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>:</td>
                                <td>
                                    <span id="price">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Qty</th>
                                <td>:</td>
                                <td>
                                    <span id="qty">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Discount Item </th>
                                <td>:</td>
                                <td>
                                    <span id="disc">&nbsp;</span>
                                </td>
                            </tr>
                            <tr>
                                <th>total </th>
                                <td>:</td>
                                <td>
                                    <span id="total">&nbsp;</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showDetail(sale_id) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('reports/detail'); ?>",
            data: {
                sale_id: sale_id
            },
            dataType: "json",
            success: function(result) {
                // console.log(result)
                $('#item_name').text(result['name']);
                $('#price').text(result['price']);
                $('#qty').text(result['qty']);
                $('#disc').text(result['discount_item']);
                $('#total').text(result['total']);
                $('#sale_id').val(result['sale_id']);

                $('#modal-detail').modal('show')
            }
        });
    }

    function printSale(sale_id) {

    }
</script>