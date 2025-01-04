<?php

use Core\Database;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

$db = new Database;
$tableName = 'trn_orders';
$module = 'kaosful';

$order_number = $_GET['order_number'];
$order = $db->single($tableName, [
    'order_number' => $order_number
]);

$order->customer = $db->single('mst_customers', ['id' => $order->customer_id]);
$order->employee = $db->single('mst_employees', ['id' => $order->employee_id]);
$order->order_type = $db->single('mst_order_types', ['id' => $order->order_type_id]);

$order->items = $db->all('trn_order_items', ['order_id' => $order->id]);
$names = $db->all('trn_order_names', ['order_id' => $order->id]);

$names = array_map(function($name) use ($db){
    $name->item = $db->single('trn_order_items', ['id' => $name->order_item_id]);
    return $name;
}, $names);

$order->names = $names;

$db->query = "SELECT trn_payments.*, mst_banks.name bank_name FROM trn_payments LEFT JOIN mst_banks ON mst_banks.id = trn_payments.bank_id WHERE trn_payments.order_id = $order->id";
$order->payments = $db->exec('all');


try {
    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    
    $content = view('kaosful/views/reports/detail-order-2/download', compact('order'));

    $html2pdf->writeHTML($content);
    $html2pdf->output($order_number.'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
