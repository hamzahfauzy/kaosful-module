<?php

use Core\Database;

$db = new Database;
$db->update('trn_orders',[
    'status' => 'CANCEL'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil dicancel"]);

header('location:'.routeTo('kaosful/orders/new'));
die();