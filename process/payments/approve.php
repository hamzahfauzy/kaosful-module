<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_payments',[
    'status' => 'APPROVE'
], [
    'id' => $_GET['id']
]);

$payment = $db->single('trn_payments', [
    'id' => $_GET['id']
]);

$order = $db->single('trn_orders', [
    'id' => $payment->order_id
]);

$db->update('trn_orders',[
    'total_payment' => $order->total_payment + $payment->total
], [
    'id' => $order->id
]);

set_flash_msg(['success'=>"Data berhasil diapprove"]);

header('location:'.routeTo('crud/index', ['table' => 'trn_payments']));
die();