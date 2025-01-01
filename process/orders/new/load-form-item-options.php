<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);

$having = "HAVING category_id = $_GET[category_id]";

$db->query = "SELECT * FROM mst_products $having";
$products = $db->exec('all');

$db->query = "SELECT * FROM mst_patterns $having";
$patterns = $db->exec('all');

$db->query = "SELECT * FROM mst_collars $having";
$collars = $db->exec('all');

$db->query = "SELECT * FROM mst_variants $having";
$variants = $db->exec('all');
$db->query = "SELECT * FROM mst_variants_2 $having";
$variants_2 = $db->exec('all');
$db->query = "SELECT * FROM mst_variants_3 $having";
$variants_3 = $db->exec('all');
$db->query = "SELECT * FROM mst_variants_4 $having";
$variants_4 = $db->exec('all');
$db->query = "SELECT * FROM mst_variants_5 $having";
$variants_5 = $db->exec('all');

return Response::json(compact('products','patterns','collars','variants','variants','variants_2','variants_3','variants_4','variants_5'), 'item options loaded');