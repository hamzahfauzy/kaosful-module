
<table border="1" cellspacing="0">
    <tr>
        <td style="border:0;">
            <img src="<?=imageToBase64(asset('assets/kaosful/img/logo.jpg'))?>" alt="" width="100" height="100">
        </td>
        <td style="text-align: center;padding-top:5;padding-bottom:5;border:0;">
            <b>KAOSFUL</b><br>
            <span>
                CUSTOM APPAREL & PRINTING<br>
                Jl. Cemara Boulevard no. 23 Komplek Cemara Asri<br>
                Medan 20371, Indonesia<br>
                0812221500 | 08122225656
            </span>
        </td>
        <td colspan="2" style="border:0;padding-left:10;">
            Tanggal <?=\Core\Form::getData('date',$order->order_date)?> / <?=$order->order_number?><br>
            Kepada YTH <?=$order->customer->name?><br>
            No HP <?=$order->customer->phone?>
        </td>
    </tr>
    <tr style="background-color: #632018;color:#FFF;">
        <td style="font-weight: bold;padding:5;" width="100">Banyaknya</td>
        <td style="font-weight: bold;padding:5;" width="300">Nama Barang</td>
        <td style="font-weight: bold;padding:5;" width="120">Harga Satuan</td>
        <td style="font-weight: bold;padding:5;" width="120">Jumlah</td>
    </tr>
    <?php $total = 0; foreach($order->items as $index => $item): $total += $item->order_amount; ?>
    <tr>
        <td style="padding:5"><?=$item->qty?> <?=$item->unit?></td>
        <td style="padding:5"><?=wordwrap($item->name, 40, '<br />', true);?></td>
        <td style="padding:5">Rp. <?=number_format($item->price)?></td>
        <td style="padding:5">Rp. <?=number_format($item->order_amount)?></td>
    </tr>
    <?php endforeach ?>
    <tr>
        <td colspan="2"></td>
        <td style="padding:5;background-color: #632018;color:#FFF;">Total</td>
        <td style="padding:5">Rp. <?=number_format($total)?></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td style="padding:5;background-color: #632018;color:#FFF;">DP</td>
        <td style="padding:5">Rp. <?=number_format($order->total_payment)?></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td style="padding:5;background-color: #632018;color:#FFF;">Sisa</td>
        <td style="padding:5">Rp. <?=number_format($total-$order->total_payment)?></td>
    </tr>
</table>
<br><br>
<table>
    <tr>
        <td width="200" style="font-weight: bold;">
            Tanda Terima,
            <br><br><br><br><br><br>
        </td>
        <td width="200" style="font-weight: bold;">
            Hormat Kami,
            <br><br><br><br><br><br>
        </td>
        <td rowspan="2">
            <b><?=wordwrap("PERHATIAN !!! Barang yang sudah dibeli Tidak dapat ditukar dan dikembalikan",30,"<br>")?></b>
        </td>
    </tr>
    <tr>
        <td><?= $order->customer->name?></td>
        <td>(..........................................)</td>
    </tr>
</table>