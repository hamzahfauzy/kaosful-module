<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
table.table td, table.table th {
    white-space:nowrap;
}
tr td:nth-child(9) {
    text-align: right;
}
</style>
<div class="card mb-3">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0">Laporan Pembayaran</p>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <form action="" onsubmit="window.reportPayment.draw(); return false" class="d-flex flex-wrap" style="gap:10px;">
            <div class="form-group mb-1">
                <label for="">Dari Tgl</label>
                <input type="date" name="start_date" id="" class="form-control w-100" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group mb-1">
                <label for="">Sampai Tgl</label>
                <input type="date" name="end_date" id="" class="form-control w-100" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group mb-1">
                <label for="">Tipe Bayar</label><br>
                <?= \Core\Form::input('options:- Pilih -|DP / Tanda Jadi|Pelunasan', 'payment_type', ['class' => 'form-control w-100']) ?>
            </div>
            <div class="form-group mb-1">
                <label for="">Jenis Bayar</label><br>
                <?= \Core\Form::input('options:- Pilih -|CASH|TRANSFER|E-MONEY|BG (BILYET GIRO)', 'payment_method', ['class' => 'form-control w-100']) ?>
            </div>
            <div class="form-group mb-1">
                <label for="">Bank</label><br>
                <?= \Core\Form::input('options-obj:mst_banks,id,name', 'bank', ['class' => 'form-control w-100']) ?>
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
                    <button type="button" class="btn btn-secondary w-100" onclick="downloadReportPayment()">Download</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped datatable-report-payment" style="width:100%">
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
