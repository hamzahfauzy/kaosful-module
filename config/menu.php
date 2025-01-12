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
    [
        'label' => 'kaosful.menu.order_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-receipt',
        'activeState' => [
            'kaosful.orders.new',
            'kaosful.orders.administration',
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.new_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('kaosful/orders/new'),
                'activeState' => 'kaosful.orders.new'
            ],
            [
                'label' => 'kaosful.menu.pic_administration',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/orders/administration'),
                'activeState' => 'kaosful.orders.administration'
            ],
        ]
    ],
    [
        'label' => 'kaosful.menu.payment_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-cash-register',
        'activeState' => [
            'kaosful.trn_payments'
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.payment_input',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('crud/index',['table' => 'trn_payments']),
                'activeState' => 'kaosful.mst_payments'
            ],
        ]
    ],
    [
        'label' => 'kaosful.menu.job_data',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-list-check',
        'activeState' => [
            'kaosful.jobs.fulfillment',
            'kaosful.jobs.close',
            'kaosful.jobs.order_status',
            'kaosful.jobs.payment_status',
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.fulfillment_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('kaosful/jobs/fulfillment'),
                'activeState' => 'kaosful.jobs.fulfillment'
            ],
            [
                'label' => 'kaosful.menu.close_order',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/jobs/close'),
                'activeState' => 'kaosful.jobs.close'
            ],
            [
                'label' => 'kaosful.menu.update_order_status',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/jobs/order-status'),
                'activeState' => 'kaosful.jobs.order_status'
            ],
            [
                'label' => 'kaosful.menu.update_payment_status',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/jobs/payment-status', ['filter' => ['status' => 'APPROVE']]),
                'activeState' => 'kaosful.jobs.payment_status'
            ],
        ]
    ],
    [
        'label' => 'kaosful.menu.prints',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-print',
        'activeState' => [
            'kaosful.prints.order_attachment',
            'kaosful.prints.invoice',
            'kaosful.prints.order',
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.print_order_attachment',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('kaosful/prints/order'),
                'activeState' => 'kaosful.prints.order'
            ],
            [
                'label' => 'kaosful.menu.print_invoice',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/prints/invoice'),
                'activeState' => 'kaosful.prints.invoice'
            ],
        ]
    ],
    [
        'label' => 'kaosful.menu.reports',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-scroll',
        'activeState' => [
            'kaosful.reports.transaction',
            'kaosful.reports.order',
            'kaosful.reports.detail_order',
            'kaosful.reports.detail_orders_2',
            'kaosful.reports.fulfillment_order',
            'kaosful.reports.outstanding_order',
            'kaosful.reports.no_paid_off_order',
            'kaosful.reports.payment_order',
        ],
        'items' => [
            [
                'label' => 'kaosful.menu.transaction',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-compress-arrows-alt',
                'route' => routeTo('kaosful/reports/transaction'),
                'activeState' => 'kaosful.reports.transaction'
            ],
            [
                'label' => 'kaosful.menu.orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/order'),
                'activeState' => 'kaosful.reports.order'
            ],
            [
                'label' => 'kaosful.menu.detail_orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/detail-order'),
                'activeState' => 'kaosful.reports.detail_order'
            ],
            [
                'label' => 'kaosful.menu.detail_orders_2',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/detail-order-2'),
                'activeState' => 'kaosful.reports.detail_order_2'
            ],
            [
                'label' => 'kaosful.menu.fulfillment_orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/fulfillment-order'),
                'activeState' => 'kaosful.reports.fulfillment_order'
            ],
            [
                'label' => 'kaosful.menu.outstanding_orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/outstanding-order'),
                'activeState' => 'kaosful.reports.outstanding_order'
            ],
            [
                'label' => 'kaosful.menu.no_paid_off_orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/no-paid-off-order'),
                'activeState' => 'kaosful.reports.no_paid_off_order'
            ],
            [
                'label' => 'kaosful.menu.payment_orders',
                'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-stamp',
                'route' => routeTo('kaosful/reports/payment-order'),
                'activeState' => 'kaosful.reports.payment_order'
            ],
        ]
    ],
];