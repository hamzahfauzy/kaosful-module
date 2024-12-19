<?php

return array (
  'mst_customers' => 
  array (
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'address' => 
    array (
      'label' => 'Alamat',
      'type' => 'textarea',
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
    ),
    'address_2' => 
    array (
      'label' => 'Alamat 2',
      'type' => 'textarea',
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
    ),
    'city' => 
    array (
      'label' => 'Kota',
      'type' => 'text',
    ),
    'phone' => 
    array (
      'label' => 'No. HP',
      'type' => 'text',
    ),
    'description' => 
    array (
      'label' => 'Deskripsi',
      'type' => 'textarea',
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_banks' => 
  array (
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_categories' => 
  array (
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    '_userstamp' => true,
  ),
  'mst_collars' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_employees' => 
  array (
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'address' => 
    array (
      'label' => 'Alamat',
      'type' => 'textarea',
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
    ),
    'address_2' => 
    array (
      'label' => 'Alamat',
      'type' => 'textarea',
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
    ),
    'city' => 
    array (
      'label' => 'Kota',
      'type' => 'text',
    ),
    'phone' => 
    array (
      'label' => 'No. HP',
      'type' => 'text',
    ),
    'description' => 
    array (
      'label' => 'description',
      'type' => 'textarea',
      'attr' => 
      array (
        'class' => 'form-control select2-search__field',
      ),
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_order_types' => 
  array (
    'name' => 
    array (
      'label' => 'nama',
      'type' => 'text',
    ),
    '_userstamp' => true,
  ),
  'mst_patterns' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_products' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'min_order' => 
    array (
      'label' => 'Min. Order',
      'type' => 'number',
    ),
    'max_order' => 
    array (
      'label' => 'Max. Order',
      'type' => 'number',
    ),
    'unit' => 
    array (
      'label' => 'Satuan',
      'type' => 'text',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_sizes' => 
  array (
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    '_userstamp' => true,
  ),
  'mst_variants' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_variants_2' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_variants_3' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_variants_4' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
  'mst_variants_5' => 
  array (
    'category_id' => 
    array (
      'label' => 'Kategori',
      'type' => 'options-obj:mst_categories,id,name',
    ),
    'name' => 
    array (
      'label' => 'Nama',
      'type' => 'text',
    ),
    'price' => 
    array (
      'label' => 'Harga',
      'type' => 'number',
    ),
    'status' => 
    array (
      'label' => 'Status',
      'type' => 'options:ACTIVE|INACTIVE',
    ),
    '_userstamp' => true,
  ),
);