<?php

use Core\Request;

$isNew = $data->status == 'NEW';

$route = Request::getRoute();
$button = "";

if($route == 'kaosful/jobs/payment-status')
{
    $button = $data->status == 'APPROVE' ? '<a href="'.routeTo('kaosful/payments/cancel',['id' => $data->id]).'" class="btn btn-danger btn-sm" onclick="if(confirm(\'Apakah anda yakin akan cancel data ini ?\')){return true}else{return false}">Cancel</a>' : '';
    // $button = '<a href="'.routeTo('kaosful/payments/new',['id' => $data->id]).'" class="btn btn-success btn-sm" onclick="if(confirm(\'Apakah anda yakin akan renew data ini ?\')){return true}else{return false}">New</a> 
    // <a href="'.routeTo('kaosful/payments/approve',['id' => $data->id]).'" class="btn btn-success btn-sm" onclick="if(confirm(\'Apakah anda yakin akan approve data ini ?\')){return true}else{return false}">Approve</a> 
    // <a href="'.routeTo('kaosful/payments/cancel',['id' => $data->id]).'" class="btn btn-danger btn-sm" onclick="if(confirm(\'Apakah anda yakin akan cancel data ini ?\')){return true}else{return false}">Cancel</a>
    // ';
}
else
{
    if($isNew)
    {
        $button = (is_allowed(parsePath(routeTo('kaosful/payments/approve',['id' => $data->id])), auth()->id) ? '<a href="'.routeTo('kaosful/payments/approve',['id' => $data->id]).'" class="btn btn-success btn-sm" onclick="if(confirm(\'Apakah anda yakin akan approve data ini ?\')){return true}else{return false}">Approve</a> ' : '');
    }
}

return $button;