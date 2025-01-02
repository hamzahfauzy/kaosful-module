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
    'category' => [
        'label' => 'Kategori',
        'type' => 'text'
    ],
    'size' => [
        'label' => 'Size',
        'type' => 'text'
    ],
    'item_name' => [
        'label' => 'item_name',
        'type' => 'text'
    ],
    'employee' => [
        'label' => 'Karyawan',
        'type' => 'text'
    ],
    'total_items' => [
        'label' => 'Qty',
        'type' => 'text'
    ],
    'fulfillment' => [
        'label' => 'Fulfillment',
        'type' => 'text'
    ],
    'sisa' => [
        'label' => 'Sisa',
        'type' => 'text'
    ],
    'order_done_date' => [
        'label' => 'Tgl. Selesai',
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
    $where = (empty($where) ? "WHERE " : " AND ") . " order_date BETWEEN '$searchByDate[startDate]' AND '$searchByDate[endDate]'";
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
            CONCAT(B.qty,' ',B.unit) total_items,
            B.name item_name,
            B.order_amount,
            CONCAT(B.qty_done,' ',B.unit) fulfillment,
            CONCAT((B.qty-B.qty_done),' ',B.unit) sisa,
            C.name category,
            D.name `size`,
            E.name employee,
            F.name customer,
            G.name order_type,
            (Case When B.time_done Is Null Then 'ON PROGRESS' Else 'COMPLETED' End) fulfillment_status
        FROM $tableName 
        Left Join trn_order_items B On B.order_id = $tableName.id 
        Left Join mst_categories C On C.id = B.category_id 
        Left Join mst_sizes D On D.id = B.size_id 
        Left Join mst_employees E On E.id = $tableName.employee_id 
        Left Join mst_customers F On F.id = $tableName.customer_id 
        Left Join mst_order_types G On G.id = $tableName.order_type_id 
        $where";

$db->query = "$query $order_clause LIMIT $start,$length";
$data  = $db->exec('all');

$filename = "fulfillment-download-".date('Y-m-d H:i:s').".xlsx";

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