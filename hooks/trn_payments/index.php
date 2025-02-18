<?php

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

$this->db->query = "SELECT $this->table.*, mst_customers.name customer_name FROM $this->table LEFT JOIN trn_orders ON trn_orders.id = $this->table.order_id LEFT JOIN mst_customers ON mst_customers.id = trn_orders.customer_id $where ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$total = $this->db->exists($this->table,$where);

return compact('data', 'total');