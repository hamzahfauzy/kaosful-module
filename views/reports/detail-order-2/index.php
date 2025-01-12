<?php 
get_header() ;
$attr  = ['class'=>"form-control"];
?>
<style>.select2 {width:100% !important}.text-right{text-align:right}</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <form action="">
            <div class="form-group mb-3">
                <label for="">No Order</label>
                <?= \Core\Form::input('options:'.json_encode($orderOptions), 'order_number', ['class' => 'form-control select2', 'placeholder' => 'Pilih', 'value' => \Core\Request::get('order_number', '')]) ?>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
                <button class="btn btn-primary" type="button" onclick="download()">Export to PDF</button>
            </div>
        </form>
    </div>
</div>
<?php if($order): ?>
<div class="card mt-3" id="reportDetail">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">No. Order</label>
                    <div class="col-8">
                        <?=$order->order_number?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Tgl. Order</label>
                    <div class="col-8">
                        <?=\Core\Form::getData('date', $order->order_date)?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Customer</label>
                    <div class="col-8">
                        <?=$order->customer->id?> - <?=$order->customer->name?>
                        <?=$order->customer->phone?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Total Nilai Order</label>
                    <div class="col-8">
                        Rp. <?=number_format($order->total_value)?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Total Pembayaran</label>
                    <div class="col-8">
                        Rp. <?=number_format($order->total_payment ?? 0)?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Foto Depan</label>
                    <div class="col-8">
                        <?php if($order->pic_1): ?>
                            <a href="<?=asset($order->pic_1)?>" target="_blank" class="btn btn-info">Download</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Jenis Order</label>
                    <div class="col-8">
                        <?=$order->order_type->name?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Tgl. Est Selesai</label>
                    <div class="col-8">
                        <?=\Core\Form::getData('date', $order->order_done_date)?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Karyawan</label>
                    <div class="col-8">
                        <?=$order->employee->id?> - <?=$order->employee->name?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Keterangan</label>
                    <div class="col-8">
                        <?=$order->description?>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Total Items / Qty</label>
                    <div class="col-8">
                        <?=$order->total_items?> Items / <?=$order->total_qty?> Qty
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="mb-2 col-4 fw-bold">Foto Belakang</label>
                    <div class="col-8">
                        <?php if($order->pic_2): ?>
                            <a href="<?=asset($order->pic_2)?>" target="_blank" class="btn btn-info">Download</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No</td>
                    <td>Deskripsi</td>
                    <td>@Harga</td>
                    <td>Qty</td>
                    <td>Satuan</td>
                    <td>Jumlah Order</td>
                </tr>
                <?php foreach($order->items as $no => $item): ?>
                <tr>
                    <td><?=$no+1?></td>
                    <td><?=$item->name?></td>
                    <td class="text-right">Rp. <?=number_format($item->price)?></td>
                    <td class="text-right"><?=number_format($item->qty)?></td>
                    <td><?=$item->unit?></td>
                    <td class="text-right">Rp. <?=number_format($item->order_amount)?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>

        <hr>
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No</td>
                    <td>Keterangan</td>
                    <td>Nama</td>
                    <td>Nomor</td>
                    <td>Catatan</td>
                </tr>
                <?php foreach($order->names as $no => $name): ?>
                <tr>
                    <td><?=$no+1?></td>
                    <td><?=$name->item?->name?></td>
                    <td><?=$name->name?></td>
                    <td><?=$name->number_description?></td>
                    <td><?=$name->description?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
        <hr>
    
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>No. Bayar</td>
                    <td>Tgl. Bayar</td>
                    <td>Tipe Bayar</td>
                    <td>Jenis Bayar</td>
                    <td>Bank</td>
                    <td>Nilai Bayar</td>
                    <td>Status</td>
                </tr>
                <?php foreach($order->payments as $no => $payment): ?>
                <tr>
                    <td><?=$payment->code?></td>
                    <td><?=\Core\Form::getData('date', $payment->payment_date)?></td>
                    <td><?=$payment->payment_type?></td>
                    <td><?=$payment->payment_method?></td>
                    <td><?=$payment->bank_name?></td>
                    <td><?=$payment->total?></td>
                    <td><?=$payment->status?></td>
                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>

</div>
<?php endif ?>
<script>
function download()
{
    const orderNumber = document.querySelector('select[name=order_number]').value
    window.open('/kaosful/reports/detail-order-2/download?order_number='+orderNumber, '_blank')
}
</script>
<?php get_footer() ?>
