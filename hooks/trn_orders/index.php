<?php

use Core\Request;

$route = Request::getRoute();

$having = "";

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
    $this->db->query = "SELECT trn_orders.*, 
                                CONCAT(trn_orders.order_date, ' <br> ', trn_orders.order_done_date) as tgl_order, 
                                CONCAT(trn_orders.total_items, ' Items / ', trn_orders.total_qty, ' Qty ', '<br> Rp. ', FORMAT(total_value, 0)) as total_item,
                                CONCAT(mst_customers.id, ' - ', mst_customers.name,' <br>', mst_order_types.name) as customer
                        FROM $this->table $where 
                        LEFT JOIN mst_order_types ON mst_order_types.id = trn_orders.order_type_id
                        LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id
                        LIMIT $start,$length";
                        
    $data  = $this->db->exec('all');
    $total = $this->db->exists($this->table,$where);
}

return compact('data', 'total');