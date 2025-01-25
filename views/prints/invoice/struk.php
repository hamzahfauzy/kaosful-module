<?php 
$date = \Core\Form::getData('date',$order->order_date); 
$doneDate = \Core\Form::getData('date',$order->order_done_date); 
?>
<pre>
<?= centerText("KAOSFUL", 32) ?>

<?= centerText("CUSTOM APPAREL & PRINTING", 32) ?>

<?= centerText("Jl. Cemara Boulevard no. 23 Komplek", 32) ?>

<?= centerText("Cemara Asri, Medan 20371, Indonesia", 32) ?>

<?= centerText("0812221500 / 08122225656", 32) ?>


<?= centerText("INVOICE", 32) ?>

--------------------------------
NO ORDER : #<?=$order->order_number?> <?= renderRight($order->customer->name, 31-strlen("NO ORDER : #".$order->order_number)) ?>

<?=$date?> <?= renderRight($order->customer->phone, 31-strlen($date)) ?>

Tgl. Est. Selesai : <?=$doneDate?>

--------------------------------
<?= centerText("Item(s) Order", 32) ?>

--------------------------------
<?php $total = 0; $qty = 0; foreach($order->items as $index => $item): $total += $item->order_amount; $qty += $item->qty; ?>
#<?=wordwrap($item->name, 32, "\n", true);?>

x <?=$item->qty?> <?=$item->unit?> @<?=number_format($item->price)?> <?=renderRight("Rp. ".number_format($item->order_amount), 31-strlen('x '.$item->qty.' '.$item->unit.' @'.number_format($item->price)))?>

................................
<?php endforeach ?>


Total Items <?=renderRight(count($order->items).' Item(s)', 20)?>

Total Qty <?=renderRight($qty, 22)?>

--------------------------------
Grand Total <?=renderRight('Rp. '.number_format($total), 20)?>

--------------------------------
Total Bayar <?=renderRight('Rp. '.number_format($order->total_payment), 20)?>

Sisa <?=renderRight('Rp. '.number_format($total-$order->total_payment), 27)?>

--------------------------------
<?=centerText('Terima kasih sudah berbelanja disini', 32) ?>

<?=centerText(date('d-m-Y H:i:s'), 32) ?>
</pre>