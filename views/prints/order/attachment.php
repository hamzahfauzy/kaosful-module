<table width="100%">
    <tr>
        <td width="700">
            <b>Gambar Desain</b>
        </td>
    </tr>
    <tr>
        <td>
            <?php if($order->pic_1): ?>
            <img src="<?=imageToBase64(asset(str_replace(' ','%20',$order->pic_1)))?>" alt="" width="150px" height="200px" style="object-fit:contain">
            <?php endif ?>
            <?php if($order->pic_2): ?>
            <img src="<?=imageToBase64(asset(str_replace(' ','%20',$order->pic_2)))?>" alt="" width="150px" height="200px" style="object-fit:contain">
            <?php endif ?>
        </td>
    </tr>
</table>
<br>
<b>Data Informasi</b>
<table width="100%">
    <tr>
        <td style="font-weight: bold;" width="50">No</td>
        <td style="font-weight: bold;" width="400">Item</td>
        <td style="font-weight: bold;" width="100">Nama</td>
        <td style="font-weight: bold;" width="50">Nomor</td>
        <td style="font-weight: bold;" width="50">Catatan</td>
    </tr>
    <?php foreach($order->items as $index => $item): ?>
    <tr>
        <td><?=$index+1?></td>
        <td><?=wordwrap($item->item?->name, 50, '<br>')?></td>
        <td><?=$item->name?></td>
        <td><?=$item->number_description?></td>
        <td><?=$item->description?></td>
    </tr>
    <?php endforeach ?>
</table>