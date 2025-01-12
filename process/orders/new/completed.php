<?php

use Core\Database;
use Core\Request;

$db = new Database;
$db->query = "UPDATE trn_order_items SET qty_done = qty, time_done = NOW() WHERE order_id = $_GET[id]";
$db->exec();

set_flash_msg(['success'=>"Data berhasil diselesaikan"]);

header('location:'.routeTo(Request::getPrevRoute()));
die();