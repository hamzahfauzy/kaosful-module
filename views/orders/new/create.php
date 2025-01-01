<?php 
get_header() ;
$attr  = ['class'=>"form-control"];
?>
<style>.select2 {width:100% !important}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <a href="<?= routeTo('kaosful/orders/new') ?>" class="btn btn-warning btn-sm">
                <?= __('crud.label.back') ?>
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if($error_msg): ?>
        <div class="alert alert-danger"><?=$error_msg?></div>
        <?php endif ?>
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">No. Order</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', 'trn_orders[order_number]', array_merge($attr, ['placeholder' => 'No. Order'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Order</label>
                        <div class="col-8">
                            <?= \Core\Form::input('date', 'trn_orders[order_date]', array_merge($attr, ['placeholder' => 'Tgl. Order'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Customer</label>
                        <div class="col-8">
                            <?= \Core\Form::input('options-obj:mst_customers,id,name', 'trn_orders[customer_id]', array_merge($attr, ['placeholder' => 'Pilih Customer'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Total Nilai Order</label>
                        <div class="col-8">
                            <?= \Core\Form::input('text', 'trn_orders[total_value]', array_merge($attr, ['placeholder' => 'Total Nilai Order','readonly'=>'readonly'])) ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Jenis Order</label>
                        <div class="col-8">
                            <?= \Core\Form::input('options-obj:mst_order_types,id,name', 'trn_orders[order_type_id]', array_merge($attr, ['placeholder' => 'Jenis Order'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Tgl. Est Selesai</label>
                        <div class="col-8">
                            <?= \Core\Form::input('date', 'trn_orders[order_done_date]', array_merge($attr, ['placeholder' => 'Tgl. Est Selesai'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Karyawan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('options-obj:mst_employees,id,name', 'trn_orders[employee_id]', array_merge($attr, ['placeholder' => 'Pilih Customer'])) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="mb-2 col-4">Keterangan</label>
                        <div class="col-8">
                            <?= \Core\Form::input('textarea', 'trn_orders[description]', array_merge($attr, ['placeholder' => 'Keterangan','class' => 'form-control select2-search__field'])) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <table class="table table-bordered table-item">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Deskripsi Keterangan Order</th>
                            <th>@Harga</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Jumlah Order</th>
                            <th><button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#itemModal">Tambah Item</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="empty_item">
                            <td colspan="7" class="text-center"><i>Belum ada item</i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Simpan Order</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="itemModalLabel">Form Item</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Kategori</label>
            <?= \Core\Form::input('options-obj:mst_categories,id,name', 'category', array_merge($attr, ['class' => 'form-control select2insidemodal', 'placeholder' => 'Pilih Kategori'])) ?>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Size</label>
            <?= \Core\Form::input('options-obj:mst_sizes,id,name', 'size', array_merge($attr, ['class' => 'form-control select2insidemodal', 'placeholder' => 'Pilih Size'])) ?>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Produk</label>
            <select name="product" id="product-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Pola</label>
            <select name="pattern" id="pattern-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Kerah</label>
            <select name="collar" id="collar-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Variasi 1</label>
            <select name="variant" id="variant-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Variasi 2</label>
            <select name="variant_2" id="variant_2-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Variasi 3</label>
            <select name="variant_3" id="variant_3-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Variasi 4</label>
            <select name="variant_4" id="variant_4-select" class="form-control select2insidemodal"></select>
        </div>
        <div class="form-group mb-3">
            <label class="mb-2 w-100">Variasi 5</label>
            <select name="variant_5" id="variant_5-select" class="form-control select2insidemodal"></select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add-item-button">Tambahkan</button>
      </div>
    </div>
  </div>
</div>
<?php get_footer() ?>
