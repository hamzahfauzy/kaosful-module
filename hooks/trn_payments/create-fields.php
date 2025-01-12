<?php

use Core\Database;

$db = new Database;
$db->query = "SELECT * FROM trn_orders WHERE status = 'APPROVE' AND total_value <> total_payment";
$orders = $db->exec('all');
$orderOptions = [];
foreach($orders as $order)
{
    $orderOptions[$order->order_number] = $order->id;
}

$fields['order_id']['type'] = 'options:'.json_encode($orderOptions);

return $fields;