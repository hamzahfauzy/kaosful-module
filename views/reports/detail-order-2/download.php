<table border="1" cellspacing="0">
    <tr>
        <td style="padding:5px" width="150">No. Order</td>
        <td style="padding:5px" width="180"><?=$order->order_number?></td>
        <td style="padding:5px" width="150">Jenis Order</td>
        <td style="padding:5px" width="180"><?=$order->order_type->name?></td>
    </tr>
    <tr>
        <td style="padding:5px">Tgl. Order</td>
        <td style="padding:5px"><?=\Core\Form::getData('date', $order->order_date)?></td>
        <td style="padding:5px">Tgl. Est Selesai</td>
        <td style="padding:5px"><?=\Core\Form::getData('date', $order->order_done_date)?></td>
    </tr>
    <tr>
        <td style="padding:5px">Customer</td>
        <td style="padding:5px">
        <?=$order->customer->id?> - <?=$order->customer->name?>
        <?=$order->customer->phone?>
        </td>
        <td style="padding:5px">Karyawan</td>
        <td style="padding:5px"><?=$order->employee->id?> - <?=$order->employee->name?></td>
    </tr>
    <tr>
        <td style="padding:5px">Total Nilai Order</td>
        <td style="padding:5px">
        Rp. <?=number_format($order->total_value)?>
        </td>
        <td style="padding:5px">Keterangan</td>
        <td style="padding:5px"><?=$order->description?></td>
    </tr>
    <tr>
        <td style="padding:5px">Total Pembayaran</td>
        <td style="padding:5px">
        Rp. <?=number_format($order->total_payment ?? 0)?>
        </td>
        <td style="padding:5px">Total Items / Qty</td>
        <td style="padding:5px"><?=$order->total_items?> Items / <?=$order->total_qty?> Qty</td>
    </tr>
    <tr>
        <td style="padding:5px">Foto Depan</td>
        <td style="padding:5px">
            <?php if($order->pic_1): ?>
                <a href="<?=asset($order->pic_1)?>" target="_blank" class="btn btn-info">Download</a>
            <?php endif ?>
        </td>
        <td style="padding:5px">Foto Belakang</td>
        <td style="padding:5px">
            <?php if($order->pic_2): ?>
                <a href="<?=asset($order->pic_2)?>" target="_blank" class="btn btn-info">Download</a>
            <?php endif ?>
        </td>
    </tr>
</table>
<hr>

<table border="1" cellspacing="0">
    <tr>
        <td style="padding:5px" width="30">No</td>
        <td style="padding:5px">Deskripsi</td>
        <td style="padding:5px" width="100">@Harga</td>
        <td style="padding:5px" width="50">Qty</td>
        <td style="padding:5px" width="70">Satuan</td>
        <td style="padding:5px" width="100">Jumlah Order</td>
    </tr>
    <?php foreach($order->items as $no => $item): ?>
    <tr>
        <td style="padding:5px"><?=$no+1?></td>
        <td style="padding:5px"><?=wordwrap($item->name, 40, '<br />', true);?></td>
        <td style="padding:5px">Rp. <?=number_format($item->price)?></td>
        <td style="padding:5px"><?=number_format($item->qty)?></td>
        <td style="padding:5px"><?=$item->unit?></td>
        <td style="padding:5px">Rp. <?=number_format($item->order_amount)?></td>
    </tr>
    <?php endforeach ?>
</table>

<hr>

<table border="1" cellspacing="0">
    <tr>
        <td style="padding:5px" width="30">No</td>
        <td style="padding:5px">Keterangan</td>
        <td style="padding:5px" width="100">Nama</td>
        <td style="padding:5px" width="50">Nomor</td>
        <td style="padding:5px" width="200">Catatan</td>
    </tr>
    <?php foreach($order->names as $no => $name): ?>
    <tr>
        <td style="padding:5px"><?=$no+1?></td>
        <td style="padding:5px"><?=wordwrap($name->item->name, 40, '<br />', true);?></td>
        <td style="padding:5px"><?=$name->name?></td>
        <td style="padding:5px"><?=$name->number_description?></td>
        <td style="padding:5px"><?=$name->description?></td>
    </tr>
    <?php endforeach ?>
</table>
<hr>

<table border="1" cellspacing="0">
    <tr>
        <td style="padding:5px" width="85">No. Bayar</td>
        <td style="padding:5px" width="70">Tgl. Bayar</td>
        <td style="padding:5px" width="120">Tipe Bayar</td>
        <td style="padding:5px" width="80">Jenis Bayar</td>
        <td style="padding:5px" width="80">Bank</td>
        <td style="padding:5px" width="80">Nilai Bayar</td>
        <td style="padding:5px" width="70">Status</td>
    </tr>
    <?php foreach($order->payments as $no => $payment): ?>
    <tr>
        <td style="padding:5px"><?=$payment->code?></td>
        <td style="padding:5px"><?=\Core\Form::getData('date', $payment->payment_date)?></td>
        <td style="padding:5px"><?=$payment->payment_type?></td>
        <td style="padding:5px"><?=$payment->payment_method?></td>
        <td style="padding:5px"><?=$payment->bank_name?></td>
        <td style="padding:5px"><?=$payment->total?></td>
        <td style="padding:5px"><?=$payment->status?></td>
    </tr>
    <?php endforeach ?>
</table>