<?php

use Core\Database;

$db = new Database;
$db->update('trn_orders',[
    'status' => 'APPROVE'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil diapprove"]);

header('location:'.routeTo('kaosful/orders/new'));
die();