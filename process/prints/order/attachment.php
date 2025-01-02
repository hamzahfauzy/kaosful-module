<?php

use Core\Database;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

$db = new Database;
$order_number = $_GET['order_number'];
$order = $db->single('trn_orders',[
    'order_number' => $order_number
]);

$items = $db->all('trn_order_names', [
    'order_id' => $order->id
]);

foreach($items as $index => $name)
{
    $item = $db->single('trn_order_items',['id' => $name->order_item_id]);
    $name->item = $item;
}

$order->items = $items;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    
    $content = view('kaosful/views/prints/order/attachment', compact('order'));

    $html2pdf->writeHTML($content);
    $html2pdf->output($order_number.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}