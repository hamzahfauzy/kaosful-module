<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
table.table td, table.table th {
    white-space:nowrap;
}
tr td:nth-child(7) {
    text-align: right;
}
</style>
<div class="card mb-3">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Laporan Detail Order 1</p>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <form action="" onsubmit="window.reportDetailOrder.draw(); return false" class="d-flex flex-wrap" style="gap:10px;">
            <div class="form-group mb-1">
                <label for="">Dari Tgl</label>
                <input type="date" name="start_date" id="" class="form-control w-100" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group mb-1">
                <label for="">Sampai Tgl</label>
                <input type="date" name="end_date" id="" class="form-control w-100" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group mb-1">
                <label for="">Size</label><br>
                <?= \Core\Form::input('options-obj:mst_sizes,name,name', 'size', ['class' => 'form-control w-100']) ?>
            </div>
            <div class="form-group mb-1">
                <label for="">Kategori</label><br>
                <?= \Core\Form::input('options-obj:mst_categories,name,name', 'category', ['class' => 'form-control w-100']) ?>
            </div>
            <div class="form-group mb-1">
                <label for="">Produk</label><br>
                <?= \Core\Form::input('options-obj:mst_products,id,name', 'product', ['class' => 'form-control w-100']) ?>
            </div>
            <div class="form-group mb-1">
                <label for="">Status</label><br>
                <?= \Core\Form::input('options:- Pilih -|NEW|APPROVE|CANCEL', 'status', ['class' => 'form-control w-100']) ?>
            </div>
            <div class="form-group mb-1">
                <label for="">&nbsp;</label>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary w-100">Submit</button>
                    &nbsp;
                    <button type="button" class="btn btn-secondary w-100" onclick="downloadReportDetailOrder()">Download</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped datatable-report-detail-order" style="width:100%">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <?php 
                        foreach($fields as $field): 
                            $label = $field;
                            if(is_array($field))
                            {
                                $label = $field['label'];
                            }
                            $label = _ucwords($label);
                        ?>
                        <th><?=$label?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>
