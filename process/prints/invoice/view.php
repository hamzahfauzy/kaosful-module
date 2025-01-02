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

$db->query = "SELECT SUM(total) total_payment FROM trn_payments WHERE order_id=$order->id AND status = 'APPROVE'";
$payment = $db->exec('single');
$order->total_payment = $payment->total_payment;

$items = $db->all('trn_order_items', [
    'order_id' => $order->id
]);

$order->items = $items;

try {
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    
    $content = view('kaosful/views/prints/invoice/view', compact('order'));

    $html2pdf->writeHTML($content);
    $html2pdf->output($order_number.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}