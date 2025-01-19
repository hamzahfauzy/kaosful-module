<?php

use Core\Database;
use Core\Request;

$route = Request::getRoute();
$button = "";
$db = new Database;

$isApproved = $data->status == 'APPROVE';
$isCancel = $data->status == 'CANCEL';
$isNew = $data->status == 'NEW';

if($route == 'kaosful/orders/new')
{
  $isValid = $data->is_valid == 'VALID';
    $button = '<div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Aksi
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/view', ['id' => $data->id]).'"><i class="fa-solid fa-eye"></i> Detail</a>
    '.($isNew ? '
    '. ($route == 'kaosful/orders/new' ? '<a class="dropdown-item" href="'.routeTo('kaosful/orders/new/edit', ['id' => $data->id]).'"><i class="fa-solid fa-pencil"></i> Edit</a>' : '') .'
    <a class="dropdown-item '.($isValid ? 'text-success' : 'text-danger').'" href="'.($isValid ? routeTo('kaosful/orders/new/approve', ['id' => $data->id]) : 'javascript:void(0)').'" onclick="'.($isValid ? 'if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}' : 'alert(\'Maaf! Data tidak valid\')').'"><i class="fa-solid fa-square-check"></i> Approve</a>
    '.(is_allowed(parsePath(routeTo('kaosful/orders/new/cancel')), auth()->id) ? '<a class="dropdown-item" href="'.routeTo('kaosful/orders/new/cancel', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengcancel data ini ?\')){return true}else{return false}"><i class="fa-solid fa-ban"></i> Cancel</a>' : '') : '') .'
    '.(($isApproved) && $route == 'kaosful/orders/new' ? '
    <a class="dropdown-item" href="'.routeTo('kaosful/prints/order/view', ['order_number' => $data->order_number]).'" target="_blank"><i class="fa-solid fa-print"></i> Order</a>
    <a class="dropdown-item" href="'.routeTo('kaosful/prints/invoice/view', ['order_number' => $data->order_number]).'" target="_blank"><i class="fa-solid fa-print"></i> Invoice</a>
    ' : '') . '
    '.($isNew ? '
    '. ($route == 'kaosful/orders/new' ? '<a class="dropdown-item text-danger" onclick="if(confirm(\'Apakah anda yakin akan menghapus data ini ?\')){return true}else{return false}" href="'.routeTo('crud/delete', ['table' => 'trn_orders','id' => $data->id]).'"><i class="fa-solid fa-trash"></i> Delete</a>' : '') .'
    ': '').'
  </div>
</div>';
}

if($route == 'kaosful/jobs/order-status')
{
    $button = '<div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Aksi
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/new', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan renew data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> New</a>
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/approve', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengapprove data ini ?\')){return true}else{return false}"><i class="fa-solid fa-square-check"></i> Approve</a>
    <a class="dropdown-item" href="'.routeTo('kaosful/orders/new/cancel', ['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan mengcancel data ini ?\')){return true}else{return false}"><i class="fa-solid fa-ban"></i> Cancel</a>
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
    <a class="dropdown-item '.($data->pic_1 ? 'text-success' : 'text-danger').'" href="'.($data->pic_1 ? asset($data->pic_1) : "javascript:void(0)").'"><i class="fa-solid fa-image"></i> Foto Depan</a>
    <a class="dropdown-item '.($data->pic_2 ? 'text-success' : 'text-danger').'" href="'.($data->pic_2 ? asset($data->pic_2) : "javascript:void(0)").'"><i class="fa-solid fa-image"></i> Foto Belakang</a>
    <a class="dropdown-item text-success" href="'.routeTo('kaosful/orders/administration/create', ['id' => $data->id]).'"><i class="fa-solid fa-check"></i> Administrasi</a>
  </div>
</div>';
}

if($route == 'kaosful/jobs/close')
{
  // $db->query = "SELECT SUM(qty_done) total_qty FROM trn_order_items WHERE order_id = $data->id";
  // $item = $db->exec('single');

  if($data->complete_status == 'COMPLETED')
  {
    // show close order
    $button = '<a href="'.routeTo('kaosful/orders/new/close',['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan close order ini ?\')){return true}else{return false}" class="btn btn-success btn-sm">Close</a>';
  }
}

if($route == 'kaosful/jobs/fulfillment' && empty($data->order_close_date))
{
  $db->query = "SELECT SUM(qty_done) total_qty FROM trn_order_items WHERE order_id = $data->id";
  $item = $db->exec('single');

  if($data->total_qty != $item->total_qty)
  {
    $button = 'ON PROGRESS <br>
              <a href="'.routeTo('kaosful/jobs/fulfillment-job',['id' => $data->id]).'" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i> Edit</a> 
              <a href="'.routeTo('kaosful/orders/new/completed',['id' => $data->id]).'" onclick="if(confirm(\'Apakah anda yakin akan menyelesaikan order ini ?\')){return true}else{return false}" class="btn btn-success btn-sm">Completed</a>';
  }
  else
  {
    $button = 'COMPLETED';
  }
}

return $button;