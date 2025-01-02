<table width="100%">
    <tr>
        <td colspan="2" width="350">
            <h4>DETAIL ORDER / PESANAN</h4>
        </td>
        <td width="150">
            No Order
        </td>
        <td width="200">
            <?= $order->order_number?>
        </td>
    </tr>
    <tr>
        <td>
            Nama Pemesan
        </td>
        <td>
            <?= $order->customer->name?>
        </td>
        <td>
            Tgl Order
        </td>
        <td>
            <?= \Core\Form::getData('date', $order->order_date)?>
        </td>
    </tr>
    <tr>
        <td>
            No. Telp Pemesan
        </td>
        <td>
        <?= $order->customer->phone?>
        </td>
        <td>
            Tgl. Estimasi Selesai
        </td>
        <td>
            <?= \Core\Form::getData('date', $order->order_done_date)?>
        </td>
    </tr>
    <tr>
        <td>
            Jumlah Pemesanan
        </td>
        <td>
            <?= $order->total_items ?> Items / <?= $order->total_qty ?> Qty
        </td>
        <td>
            Keterangan
        </td>
        <td>
            <?= $order->description?>
        </td>
    </tr>
</table>
<hr>
<table width="100%">
    <tr>
        <td style="font-weight: bold;" width="<?= 700 - (75-(count($sizes)+1))?>">Total / Ukuran</td>
        <?php foreach($sizes as $size): ?>
        <td style="font-weight: bold;text-align: center;" width="50">- <?=$size->name?> -</td>
        <?php endforeach ?>
    </tr>
    <tr>
        <td><?= count($order->items) ?> / <?= count(array_unique(array_column((array) $order->items, 'size_id'))) ?></td>
        <?php foreach($sizes as $size): ?>
        <td style="text-align: center;"><?=array_count_values(array_column((array) $order->items, 'size_id'))[$size->id] ?? 0?></td>
        <?php endforeach ?>
    </tr>
</table>
<hr>
<table width="100%">
    <tr>
        <td style="font-weight: bold;" width="50">No</td>
        <td style="font-weight: bold;" width="50">Size</td>
        <td style="font-weight: bold;" width="200">Kategori</td>
        <td style="font-weight: bold;" width="350">Keterangan Order</td>
        <td style="font-weight: bold;" width="50">Qty</td>
    </tr>
    <?php foreach($order->items as $index => $item): ?>
    <tr>
        <td><?=$index+1?></td>
        <td><?=$item->size->name?></td>
        <td><?=$item->category->name?></td>
        <td><?=$item->name?></td>
        <td><?=$item->qty?> <?=$item->unit?></td>
    </tr>
    <?php endforeach ?>
</table>
<br><br>
<table>
    <tr>
        <td width="200" style="font-weight: bold;">
            Pemesan,
            <br><br><br><br><br><br>
        </td>
        <td width="200" style="font-weight: bold;">
            Diketahui Oleh,
            <br><br><br><br><br><br>
        </td>
    </tr>
    <tr>
        <td><?= $order->customer->name?></td>
        <td>(..........................................)</td>
    </tr>
</table>