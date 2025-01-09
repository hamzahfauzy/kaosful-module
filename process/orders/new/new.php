<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->update('trn_orders',[
    'status' => 'NEW'
], [
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>"Data berhasil di renew"]);

header('location:'.routeTo(Request::getPrevRoute()));
die();