<?php

use Core\Request;

$route = Request::getRoute();

$having = "";

if('kaosful/orders/administration' == $route)
{
    $filter['trn_orders.status'] = 'APPROVE';
    $order[0]['dir'] = $col_order == 'id' ? 'DESC' : $order[0]['dir'];
    $col_order = $col_order == 'id' ? 'trn_orders.order_date' : $col_order; 
}

if(in_array($route, ['kaosful/jobs/close','kaosful/jobs/fulfillment']))
{
    $filter['status'] = 'APPROVE';
}

if(in_array($route, ['kaosful/jobs/close']))
{
    $where = (empty($where) ? 'WHERE ' : ' AND ') . "trn_orders.order_close_date IS NULL";
}

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

$where = $where ." ". $having;

$data = []; $total = 0;

if(in_array($route, ['kaosful/orders/new','kaosful/orders/administration','kaosful/jobs/order-status','kaosful/jobs/close','kaosful/jobs/fulfillment']))
{
    $query = "SELECT trn_orders.*, 
                                CONCAT(trn_orders.order_date, ' <br> ', trn_orders.order_done_date) as tgl_order, 
                                CONCAT(trn_orders.total_items, ' Items / ', trn_orders.total_qty, ' Qty ', '<br> Rp. ', FORMAT(total_value, 0)) as total_item,
                                CONCAT(mst_customers.id, ' - ', mst_customers.name,' <br>', mst_order_types.name) as customer,
                                CASE WHEN validator.order_id IS NULL AND items.jlh > 0 THEN 'VALID' ELSE 'NOT VALID' END is_valid,
                                CASE WHEN trn_orders.order_close_date IS NULL THEN 'OPEN' ELSE 'CLOSE' END order_status,
                                CASE WHEN item_incompleted.jlh > 0 THEN 'INCOMPLETED' ELSE 'COMPLETED' END complete_status
                        FROM $this->table 
                        LEFT JOIN mst_order_types ON mst_order_types.id = trn_orders.order_type_id
                        LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
                        LEFT JOIN (SELECT COUNT(*) as jlh, order_id FROM trn_order_items GROUP BY order_id) as items ON items.order_id = trn_orders.id
                        LEFT JOIN (SELECT COUNT(*) as jlh, order_id FROM trn_order_items WHERE time_done IS NULL GROUP BY order_id) as item_incompleted ON item_incompleted.order_id = trn_orders.id
                        LEFT JOIN (Select A.order_id, SUM(A.qty) as JlhQty, A.product_id, Coalesce(B.min_order, 0) As min_order, Coalesce(B.max_order, 0) As max_order From trn_order_items A Inner Join (Select id, min_order, max_order From mst_products) B On A.product_id = B.id Group By A.order_id, A.product_id, Coalesce(B.min_order, 0), Coalesce(B.max_order, 0) Having SUM(A.qty) < min_order And max_order > SUM(A.qty) LIMIT 1) validator ON validator.order_id = trn_orders.id
                        $where";
                        
    $this->db->query = $query . " ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
    $data  = $this->db->exec('all');

    $this->db->query = $query;
    $total = $this->db->exec('exists');
}

return compact('data', 'total');