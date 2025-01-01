<?php

use Core\Request;

$isNew = $data->status == 'NEW';

$route = Request::getRoute();

if($isNew && $route == 'kaosful/jobs/payment-status')
{
    return (is_allowed(parsePath(routeTo('kaosful/payments/approve',['id' => $data->id])), auth()->id) ? '<a href="'.routeTo('kaosful/payments/approve',['id' => $data->id]).'" class="btn btn-success btn-sm" onclick="if(confirm(\'Apakah anda yakin akan approve data ini ?\')){return true}else{return false}">Approve</a> ' : '')
            . (is_allowed(parsePath(routeTo('kaosful/payments/cancel',['id' => $data->id])), auth()->id) ? '<a href="'.routeTo('kaosful/payments/cancel',['id' => $data->id]).'" class="btn btn-danger btn-sm" onclick="if(confirm(\'Apakah anda yakin akan cancel data ini ?\')){return true}else{return false}">Cancel</a> ' : '');
}

return '';