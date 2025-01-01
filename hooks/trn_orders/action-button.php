<?php

use Core\Request;

$route = Request::getRoute();
$button = "";

$isApproved = $data->status == 'APPROVE';
$isCancel = $data->status == 'CANCEL';
$isNew = $data->status == 'NEW';

if($route == 'kaosful/orders/new')
{
    $button = '<div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Aksi
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/view', ['id' => $data->id]).'"><i class="fa-solid fa-eye"></i> Detail</a>
    '.($isNew ? '
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/edit', ['id' => $data->id]).'"><i class="fa-solid fa-pencil"></i> Edit</a>
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/approve', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> Approve</a>
    '.(is_allowed(parsePath(routeTo('kaosful/orders/new/cancel')), auth()->id) ? '<a class="dropdown-item" href="'.routeTo('kaosful/orders/new/cancel', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengcancel data ini ?\')){return true}else{return false}"><i class="fa-solid fa-ban"></i> Cancel</a>' : '') : '') .'
    '.($isApproved || $isCancel ? '
    <a class="dropdown-item" href="#"><i class="fa-solid fa-print"></i> Order</a>
    <a class="dropdown-item" href="#"><i class="fa-solid fa-print"></i> Invoice</a>
    ' : '') . '
    '.($isNew ? '
    <a class="dropdown-item text-danger" onclick="if(confirm(\'Apakah anda yakin akan menghapus data ini ?\')){return true}else{return false}" href="'.routeTo('crud/delete', ['table' => 'trn_orders','id' => $data->id]).'"><i class="fa-solid fa-trash"></i> Delete</a>
    ': '').'
  </div>
</div>';
}

if($route == 'kaosful/orders/administration')
{
    $button = '<div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Aksi
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    '.($isNew ? '<a class="dropdown-item d-none" href="'.routeTo('kaosful/orders/new/edit', ['id' => $data->id]).'"><i class="fa-solid fa-pencil"></i> Edit</a>' : '') .'
    <a class="dropdown-item '.($data->pic_1 ? 'text-success' : 'text-danger').'" href=""><i class="fa-solid fa-times"></i> Foto Depan</a>
    <a class="dropdown-item '.($data->pic_2 ? 'text-success' : 'text-danger').'" href=""><i class="fa-solid fa-times"></i> Foto Belakang</a>
    <a class="dropdown-item text-success" href="'.routeTo('kaosful/orders/administration/create', ['id' => $data->id]).'"><i class="fa-solid fa-check"></i> Administrasi</a>
  </div>
</div>';
}

return $button;