<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Items</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active">Data Items</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">&nbsp;</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="formku" class="eventInsForm" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="barcode" class="col-form-label">Barcode <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="barcode" id="barcode" class="form-control mb-2" maxlength="100" autofocus onkeyup="this.value = this.value.capitalize()">
                                            <input type="hidden" name="item_id" id="item_id">
                                            <input type="hidden" name="gambar_lama" id="gambar_lama">
                                            <div class="invalid-feedback inv-barcode">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="nama_produk" class="col-form-label">Name Product <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="text" name="nama_produk" id="nama_produk" class="form-control mb-2" maxlength="100">
                                            <div class="invalid-feedback inv-name">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="category" class="col-form-label">Category <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <select name="category" id="category" class="form-control mb-2">
                                                <option value="" selected>--Pilih--</option>
                                                <?php foreach ($category as $c) { ?>
                                                    <option value="<?= $c->category_id ?>"><?= $c->name ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback inv-category">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="unit" class="col-form-label">Unit <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <select name="unit" id="unit" class="form-control mb-2">
                                                <option value="" selected>--Pilih--</option>
                                                <?php foreach ($unit as $u) { ?>
                                                    <option value="<?= $u->unit_id ?>"><?= $u->name ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback inv-unit">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="price" class="col-form-label">Price <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="number" name="price" id="price" class="form-control mb-2">
                                            <div class="invalid-feedback inv-price">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="stock" class="col-form-label">Stock <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="number" name="stock" id="stock" class="form-control mb-2">
                                            <div class="invalid-feedback inv-stock">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="cost" class="col-form-label">Cost <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="number" name="cost" id="cost" class="form-control mb-2">
                                            <div class="invalid-feedback inv-cost">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="profit" class="col-form-label">Profit <font color="#f00">*</font></label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <input type="number" name="profit" id="profit" class="form-control mb-2" readonly>
                                            <div class="invalid-feedback inv-profit">&nbsp;</div>
                                        </div>
                                    </div>
                                    <div class="form-row" id="input_photo" style="display:none;">
                                        <div class="col-md-4 col-xs-4">
                                            <label for="gambar" class="col-form-label">Photo Product</label>
                                        </div>
                                        <div class="col-md-8 col-xs-8">
                                            <div class="fileinput fileinput-new myline" data-provides="fileinput" style="margin-bottom:5px">
                                                <div class="input-group input-small">
                                                    <div class="form-control uneditable-input" data-trigger="fileinput">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file">
                                                        <span class="fileinput-new">Select file </span>
                                                        <span class="fileinput-exists">Change </span>
                                                        <input type="file" name="gambar" id="gambar">
                                                    </span>
                                                    <a href="javascript:;" class="input-group-addon btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row" id="edit_photo" style="display:none;">
                                        <div class="col-md-4">
                                            <label class="col-form-label">Photo Product</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" id="photo_url" name="photo_url" class="form-control mb-2" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="#" onclick="new_file();" class="btn btn-circle btn-success btn-sm">
                                                <i class="fa fa-edit"></i> Change
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-8"><small><i>Recommended 128 x 128 pixels (jpg, png, jpeg)</i></small></div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                                <button type="button" class="btn btn-primary" onclick="simpandata()"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="float-sm-right">
                            <a onclick="tambahData()" class="btn btn-success btn-sm text-white"><i class="fa fa-plus"></i> Create</a>
                        </div>
                    </div>
                    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan') ?>"></div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">No.</th>
                                    <th>Barcode</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Photo Product</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($item as $i) { ?>
                                <tr>
                                    <td><?= $no++ . '.' ?></td>
                                    <td>
                                        <?= $i->barcode ?><br>
                                        <a href="<?= site_url('item/barcode_qrcode/' . $i->item_id) ?>" class="btn btn-warning btn-sm">
                                            Generate <i class="fa fa-barcode"></i>
                                        </a>
                                    </td>
                                    <td><?= $i->name ?></td>
                                    <td><?= $i->name_category ?></td>
                                    <td><?= $i->name_unit ?></td>
                                    <td><?= indo_currency($i->price) ?></td>
                                    <td align="center">
                                        <img src="<?= base_url('/uploads/product/' . $i->gambar) ?>" style="width: 50px; height:50px;">
                                    </td>
                                    <td><?= $i->stock ?></td>
                                    <td class="text-center" style="width:200px;">
                                        <a onclick="editData(<?= $i->item_id ?>)" class="btn btn-primary btn-sm mb-2 text-white"><i class="fa fa-edit"></i></a>
                                        <form action="<?= site_url('item/delete') ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="item_id" value="<?= $i->item_id ?>">
                                            <button class="btn btn-danger btn-sm tombol-hapus mb-2" type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
  String.prototype.capitalize = function() { return this.charAt(0).toUpperCase() + this.slice(1); };

  $(function() {
    setTimeout(function() { $('.alert-success, .invalid-feedback').hide(300); }, 3000);
  });

  function tambahData() {
    dsState = "Input";
    $('#formku')[0].reset();
    $('#item_id, #gambar_lama').val('');
    $('#input_photo').show();
    $('#edit_photo').hide();
    $("#myModal .modal-title").text('Add Item');
    $("#myModal").modal('show');
  }

  function simpandata() {
    var fields = [
      { sel: '#barcode', fb: '.inv-barcode', msg: 'Barcode tidak boleh kosong!' },
      { sel: '#nama_produk', fb: '.inv-name', msg: 'Nama Produk tidak boleh kosong!' },
      { sel: '#category', fb: '.inv-category', msg: 'Category tidak boleh kosong!' },
      { sel: '#unit', fb: '.inv-unit', msg: 'Unit tidak boleh kosong!' },
      { sel: '#price', fb: '.inv-price', msg: 'Price tidak boleh kosong!' },
      { sel: '#stock', fb: '.inv-stock', msg: 'Stock tidak boleh kosong!' },
      { sel: '#cost', fb: '.inv-cost', msg: 'Cost tidak boleh kosong!' }
    ];
    for (var f of fields) {
      if (!$.trim($(f.sel).val())) { showInvalid(f.sel, f.fb, f.msg); return; }
    }
    if (dsState === "Input") {
      $.post("<?= site_url('item/cek_barcode') ?>", { data: $('#barcode').val() })
        .done(function(res) {
          if (res === "ADA") showInvalid('#barcode', '.inv-barcode', 'Barcode sudah terdaftar!');
          else $('#formku').attr('action', "<?= site_url('item/save') ?>").submit();
        });
    } else {
      $('#formku').attr('action', "<?= site_url('item/update') ?>").submit();
    }
  }

  function editData(item_id) {
    dsState = 'Edit';
    $.post("<?= site_url('item/edit') ?>", { item_id: item_id }, function(r) {
      $('#barcode').val(r.barcode);
      $('#nama_produk').val(r.name);
      $('#category').val(r.category_id);
      $('#unit').val(r.unit_id);
      $('#price').val(r.price);
      $('#stock').val(r.stock);
      $('#cost').val(r.cost);
      $('#profit').val(r.profit);
      $('#item_id').val(r.item_id);
      $('#photo_url').val(r.gambar);
      $('#gambar_lama').val(r.gambar);
      $('#input_photo').hide();
      $('#edit_photo').show();
      $("#myModal .modal-title").text('Edit Item');
      $("#myModal").modal('show');
    }, 'json');
  }

  function showInvalid(sel, fb, msg) {
    $(fb).text(msg).show();
    $(sel).addClass('is-invalid');
    setTimeout(function() { $(fb).hide(); $(sel).removeClass('is-invalid'); }, 3000);
  }

  function hitungProfit() {
    var p = parseFloat($('#price').val())||0;
    var c = parseFloat($('#cost').val())||0;
    $('#profit').val(p - c);
  }

  $(document).ready(function() {
    $('#price, #cost').on('input', hitungProfit);
    hitungProfit();
  });
</script>
