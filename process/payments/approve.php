<?php

use Core\Database;

$db = new Database;
$payment = $db->single('trn_payments', [
    'id' => $_GET['id']
]);

$order = $db->single('trn_orders', [
    'id' => $payment->order_id
]);

// validation
$total_payment = $order->total_payment + $payment->total;
if($order->total_value < $total_payment)
{
    set_flash_msg(['error'=>"Data gagal diapprove. Nominal pembayaran lebih besar dari sisa yang harus dibayar"]);

    header('location:'.routeTo('crud/index', ['table' => 'trn_payments']));
    die();
}

$db->update('trn_payments',[
    'status' => 'APPROVE'
], [
    'id' => $payment->id
]);

$db->update('trn_orders',[
    'total_payment' => $total_payment
], [
    'id' => $order->id
]);

set_flash_msg(['success'=>"Data berhasil diapprove"]);

header('location:'.routeTo('crud/index', ['table' => 'trn_payments']));
die();