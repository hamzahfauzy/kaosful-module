<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_orders',[
    'order_close_date' => date('Y-m-d')
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil diapprove"]);

header('location:'.routeTo(Request::getPrevRoute()));
die();