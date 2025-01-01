<?php

use Core\Request;

$route = Request::getPrevRoute();
$button = "";
$message = "Data berhasil dihapus";

if($route == 'kaosful/orders/new')
{
    $message = "New Order berhasil dihapus";
}

set_flash_msg(['success'=>$message]);
header('location:'.routeTo($route));
die();