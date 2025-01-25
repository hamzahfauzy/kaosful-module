<?php

use Core\Database;
use Core\Request;
use Core\Response;

if(Request::isMethod('POST'))
{
    $db = new Database;
    $data = $_POST['customer'];
    $customer = $db->insert('mst_customers', $data);

    return Response::json($customer, 'success');
}