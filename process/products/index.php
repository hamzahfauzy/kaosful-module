<?php

use Core\Database;
use Core\Request;
use Core\Response;

$db = new Database;
$filter  = Request::get('filter', []);

$having = "";

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

$db->query = "SELECT * FROM mst_products $having";
$products = $db->exec('all');

return Response::json($products, 'products retrieved');