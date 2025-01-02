<?php

use Core\Database;
use Core\Page;
use Core\Request;

$db = new Database;

// init table fields
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
    'order_type_id' => [
        'label' => 'Jenis Order',
        'type' => 'options-obj:mst_order_types,id,name'
    ],
    'customer_id' => [
        'label' => 'Customer',
        'type' => 'options-obj:mst_customers,id,name'
    ],
    'employee_id' => [
        'label' => 'Karyawan',
        'type' => 'options-obj:mst_employees,id,name'
    ],
    'size' => [
        'label' => 'Size',
        'type' => 'text'
    ],
    'category' => [
        'label' => 'Kategori',
        'type' => 'text'
    ],
    'item_name' => [
        'label' => 'Nama Order',
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

if(isset($_GET['draw']))
{
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
                B.order_amount,
                B.name item_name,
                D.name `size`,
                C.name category
            FROM $tableName 
            INNER JOIN trn_order_items B On B.order_id = $tableName.id 
            INNER JOIN mst_categories C On C.id = B.category_id 
            INNER JOIN mst_sizes D On D.id = B.size_id 
            $where";

    $db->query = "$query $order_clause LIMIT $start,$length";
    $data  = $db->exec('all');

    $db->query = $query;
    $total = $db->exec('exists');

    $results = [];
    
    foreach($data as $key => $d)
    {
        $results[$key][] = $start+$key+1;
        foreach($columns as $col)
        {
            $field = '';
            if(isset($fields[$col]))
            {
                $field = $fields[$col];
            }
            else
            {
                $field = $col;
            }
            $data_value = "";
            if(is_array($field))
            {
                $data_value = \Core\Form::getData($field['type'],$d->{$col},true);
                if($field['type'] == 'number')
                {
                    $data_value = (int) $data_value;
                    $data_value = number_format($data_value);
                }

                if($field['type'] == 'file')
                {
                    $data_value = '<a href="'.asset($data_value).'" target="_blank">Lihat File</a>';
                }
            }
            else
            {
                $data_value = $d->{$field};
            }

            $results[$key][] = $data_value;
        }
    }

    return json_encode([
        "draw" => $draw,
        "recordsTotal" => (int)$total,
        "recordsFiltered" => (int)$total,
        "data" => $results
    ]);
}

$title = 'Laporan Order';
Page::setActive("kaosful.reports.order");
Page::setTitle($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => $title
    ]
]);

Page::pushHead('<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />');
Page::pushHead('<style>.select2,.select2-selection{height:38px!important;} .select2-container--default .select2-selection--single .select2-selection__rendered{line-height:38px!important;}.select2-selection__arrow{height:34px!important;}</style>');
Page::pushFoot('<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>');
Page::pushFoot("<script src='https://cdnjs.cloudflare.com/ajax/libs/qs/6.11.0/qs.min.js'></script>");
Page::pushFoot("<script src='".asset('assets/kaosful/js/reports.js')."'></script>");

return view('kaosful/views/reports/order/index', compact('fields'));