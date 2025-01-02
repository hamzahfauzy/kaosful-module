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

$order->customer = $db->single('mst_customers', [
    'id' => $order->customer_id
]);

$items = $db->all('trn_order_items', [
    'order_id' => $order->id
]);

$items = array_map(function($item) use ($db){
    $item->category = $db->single('mst_categories', [
        'id' => $item->category_id
    ]);
    
    $item->size = $db->single('mst_sizes', [
        'id' => $item->size_id
    ]);

    return $item;
}, $items);

$order->items = $items;

$sizes = $db->all('mst_sizes');


try {
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    
    $content = view('kaosful/views/prints/order/view', compact('order','sizes'));

    $html2pdf->writeHTML($content);
    $html2pdf->output($order_number.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}