<?php

use Core\Database;
use Core\Response;

$item_id = $_GET['id'];
$db = new Database;
$db->query = "SELECT trn_order_items.*, mst_sizes.name size_name FROM trn_order_items JOIN mst_sizes ON mst_sizes.id = trn_order_items.size_id WHERE trn_order_items.id = $item_id";
$sizes = $db->exec('single');

return Response::json($sizes, 'success');