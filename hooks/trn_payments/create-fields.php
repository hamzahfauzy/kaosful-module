<?php

use Core\Database;

$db = new Database;
$db->query = "SELECT * FROM trn_orders WHERE status = 'APPROVE' AND total_value <> COALESCE(total_payment, 0)";
$orders = $db->exec('all');
$orderOptions = ['- Pilih -' => 0];
foreach($orders as $order)
{
    $orderOptions[$order->order_number] = $order->id;
}

$fields['order_id']['type'] = 'options:'.json_encode($orderOptions);

$db->query = "SELECT COUNT(*) as `counter` FROM trn_payments WHERE payment_date LIKE '%".date('Y-m')."%'";
$counter = $db->exec('single')?->counter ?? 0;

$counter = sprintf("%04d", $counter+1);

$fields['code']['attr'] = [
    'readonly' => 'readonly',
    'value' => 'KWT' . date('Ym'). $counter,
];

$fields['order_id'] = [
    'label' => 'No. Order',
    'type' => 'options-obj:trn_orders,id,(CONCAT(order_number," ",FORMAT(coalesce(total_value,0)-coalesce(total_payment,0),0)))'
];

return $fields;