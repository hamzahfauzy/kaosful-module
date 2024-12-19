<?php

return [
    [
        'label' => 'kaosful.menu.master_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
        'activeState' => [
            'kaosful.mst_order_types',
            'kaosful.mst_employees',
            'kaosful.mst_customers',
            'kaosful.mst_banks',            
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.order_types',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stream',
                'route' => routeTo('crud/index',['table' => 'mst_order_types']),
                'activeState' => 'kaosful.mst_order_types'
            ],
            [
                'label' => 'kaosful.menu.employees',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_employees']),
                'activeState' => 'kaosful.mst_employees'
            ],
            [
                'label' => 'kaosful.menu.customers',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_customers']),
                'activeState' => 'kaosful.mst_customers'
            ],
            [
                'label' => 'kaosful.menu.banks',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_banks']),
                'activeState' => 'kaosful.mst_banks'
            ],
            
        ]
    ],
    [
        'label' => 'kaosful.menu.product_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-tshirt',
        'activeState' => [
            'kaosful.mst_categories',
            'kaosful.mst_sizes',
            'kaosful.mst_products',
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.categories',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('crud/index',['table' => 'mst_categories']),
                'activeState' => 'kaosful.mst_categories'
            ],
            [
                'label' => 'kaosful.menu.sizes',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('crud/index',['table'=>'mst_sizes']),
                'activeState' => 'kaosful.mst_sizes'
            ],
            [
                'label' => 'kaosful.menu.products',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-th-large',
                'route' => routeTo('crud/index',['table'=>'mst_products']),
                'activeState' => 'kaosful.mst_products'
            ],
            
        ]
    ],
    [
        'label' => 'kaosful.menu.variant_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-boxes',
        'activeState' => [
            'kaosful.mst_patterns',
            'kaosful.mst_collars',
            'kaosful.mst_variants',
            'kaosful.mst_variants_2',
            'kaosful.mst_variants_3',
            'kaosful.mst_variants_4',
            'kaosful.mst_variants_5',
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.patterns',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_patterns']),
                'activeState' => 'kaosful.mst_patterns'
            ],
            [
                'label' => 'kaosful.menu.collars',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_collars']),
                'activeState' => 'kaosful.mst_collars'
            ],
            [
                'label' => 'kaosful.menu.variants',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_variants']),
                'activeState' => 'kaosful.mst_variants'
            ],
            [
                'label' => 'kaosful.menu.variants_2',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_variants_2']),
                'activeState' => 'kaosful.mst_variants_2'
            ],
            [
                'label' => 'kaosful.menu.variants_3',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_variants_3']),
                'activeState' => 'kaosful.mst_variants_3'
            ],
            [
                'label' => 'kaosful.menu.variants_4',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_variants_4']),
                'activeState' => 'kaosful.mst_variants_4'
            ],
            [
                'label' => 'kaosful.menu.variants_5',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-fill-drip',
                'route' => routeTo('crud/index',['table'=>'mst_variants_5']),
                'activeState' => 'kaosful.mst_variants_5'
            ],
            
        ]
    ],
];