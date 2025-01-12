<?php

use Core\Database;
use Core\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$db = new Database;

$tableName  = 'trn_orders';
$fields     = [
    'order_number' => [
        'label' => 'No. Order',
        'type' => 'text'
    ],
    'order_date' => [
        'label' => 'Tgl. Order',
        'type' => 'date'
    ],
    'order_type' => [
        'label' => 'Jenis Order',
        'type' => 'text'
    ],
    'customer' => [
        'label' => 'Customer',
        'type' => 'text'
    ],
    'employee' => [
        'label' => 'Karyawan',
        'type' => 'text'
    ],
    'category' => [
        'label' => 'Kategori',
        'type' => 'text'
    ],
    'total_items' => [
        'label' => 'Jumlah',
        'type' => 'text'
    ],
    'order_amount' => [
        'label' => 'Nilai Order',
        'type' => 'number'
    ],
    'status' => [
        'label' => 'Status',
        'type' => 'options:NEW|APPROVE|CANCEL'
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

$col_order = $order[0]['column']-1;
$col_order = $col_order < 0 ? 'id' : $columns[$col_order];

$having = "";

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        if($f_key == 'status' && $f_value == '- Pilih -') continue;
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
            ($tableName.total_value-coalesce($tableName.total_payment,0)) sisa
        FROM $tableName
        $where";

$db->query = "$query $order_clause LIMIT $start,$length";
$data  = $db->exec('all');

$filename = "transaction-download-".date('Y-m-d H:i:s').".xlsx";

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