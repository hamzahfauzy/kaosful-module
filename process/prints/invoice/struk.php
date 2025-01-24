<?php

use Core\Database;

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

return view('kaosful/views/prints/invoice/struk', compact('order'));