<?php

use Core\Database;

$db = new Database;

if(
    $db->exists('mst_products', ['category_id' => $data->id]) ||
    $db->exists('mst_patterns', ['category_id' => $data->id]) ||
    $db->exists('mst_collars', ['category_id' => $data->id]) ||
    $db->exists('mst_variants', ['category_id' => $data->id]) ||
    $db->exists('mst_variants_2', ['category_id' => $data->id]) ||
    $db->exists('mst_variants_3', ['category_id' => $data->id]) ||
    $db->exists('mst_variants_4', ['category_id' => $data->id]) ||
    $db->exists('mst_variants_5', ['category_id' => $data->id])
)
{
    redirectBack(['error' => 'Data tidak bisa dihapus karena sedang digunakan!','old' => $data]);
    die;
}