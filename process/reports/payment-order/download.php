<?php

use Core\Database;
use Core\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$db = new Database;

$tableName  = 'trn_payments';
$fields     = [
    'code' => [
        'label' => 'No. Bayar',
        'type' => 'text'
    ],
    'payment_date' => [
        'label' => 'Tgl. Bayar',
        'type' => 'date'
    ],
    'payment_type' => [
        'label' => 'Tipe Bayar',
        'type' => 'text'
    ],
    'payment_method' => [
        'label' => 'Jenis Bayar',
        'type' => 'text'
    ],
    'bank' => [
        'label' => 'Bank',
        'type' => 'text'
    ],
    'order_number' => [
        'label' => 'No. Order',
        'type' => 'text'
    ],
    'customer' => [
        'label' => 'Customer',
        'type' => 'text'
    ],
    'total' => [
        'label' => 'Nilai Bayar',
        'type' => 'number'
    ],
    'status' => [
        'label' => 'Status',
        'type' => 'text'
    ]
];

$draw    = Request::get('draw', 1);
$start   = Request::get('start', 0);
$length  = Request::get('length', 20);
$search  = Request::get('search.value', '');
$order   = Request::get('order', [['column' => 1,'dir' => 'asc']]);
$filter  = Request::get('filter', []);

$searchByDate = Request::get('searchByDate', ['startDate' => date('Y-m-d'), 'endDate' => date('Y-m-d')]);

$columns = [];
$search_columns = [];
foreach($fields as $key => $field)
{
    $columns[] = is_array($field) ? $key : $field;
    if(is_array($field) && isset($field['search']) && !$field['search']) continue;
    $search_columns[] = is_array($field) ? $key : $field;
}

$where = "";

if(!empty($search))
{
    $_where = [];
    foreach($search_columns as $col)
    {
        $_where[] = "$col LIKE '%$search%'";
    }

    $where = "WHERE (".implode(' OR ',$_where).")";
}

if($searchByDate)
{
    $where = (empty($where) ? "WHERE " : " AND ") . " payment_date BETWEEN '$searchByDate[startDate]' AND '$searchByDate[endDate]'";
}

$col_order = $order[0]['column']-1;
$col_order = $col_order < 0 ? 'id' : $columns[$col_order];

$having = "";

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        if($f_key == 'status' && $f_value == '- Pilih -') continue;
        if($f_key == 'payment_method' && $f_value == '- Pilih -') continue;
        if($f_key == 'payment_type' && $f_value == '- Pilih -') continue;
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    if($filter_query)
    {
        $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
    }
}

$where = $where ." ". $having;

$order_clause = "ORDER BY ".$col_order." ".$order[0]['dir'];

$query = "SELECT 
            $tableName.*, 
            C.name customer,
            D.name bank,
            B.order_number
        FROM $tableName 
        Left Join trn_orders B On B.id = $tableName.order_id 
        Left Join mst_customers C On C.id = B.customer_id 
        Left Join mst_banks D On D.id = $tableName.bank_id 
        $where";

$db->query = "$query $order_clause LIMIT $start,$length";
$data  = $db->exec('all');

$filename = "payment-download-".date('Y-m-d H:i:s').".xlsx";

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'No');
$i=1;
foreach($fields as $index => $field)
{
    $sheet->setCellValue(chr($i+65).'1', $field['label']);
    $i++;
}

foreach($data as $no => $d)
{
    $cell = $no + 2;
    $sheet->setCellValue('A'.$cell, $no+1);
    $i=1;
    foreach($fields as $index => $field)
    {
        $sheet->setCellValue(chr($i+65).$cell, $d->{$index});
        $i++;
    }
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet, 'Xlsx');
$writer->save('php://output');

// header('location:'.$filename);

// use exit to get rid of unexpected output afterward
exit();