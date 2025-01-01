<?php

use Core\Request;

$route = Request::getRoute();
$button = "";

if($route == 'kaosful/orders/new')
{
    $button = "<a href='".routeTo('kaosful/orders/new/create')."' class='btn btn-success btn-sm'><i class='fa-solid fa-plus'></i> Tambah</a>";
}

return $button;