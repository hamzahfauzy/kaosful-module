CREATE TABLE trn_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_number VARCHAR(100) NOT NULL,
    order_date DATE DEFAULT NULL,
    order_done_date DATE DEFAULT NULL,
    order_close_date DATE DEFAULT NULL,

    employee_id INT DEFAULT NULL,
    customer_id INT DEFAULT NULL,
    order_type_id INT DEFAULT NULL,
    
    total_items INT DEFAULT NULL,
    total_qty INT DEFAULT NULL,
    total_value DOUBLE(15,2) DEFAULT NULL,
    total_payment DOUBLE(15,2) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    status VARCHAR(100) NOT NULL DEFAULT 'NEW',
    pic_1 VARCHAR(100) NOT NULL,
    pic_2 VARCHAR(100) NOT NULL,


    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    created_by INT DEFAULT NULL,
    updated_by INT DEFAULT NULL,

    CONSTRAINT fk_trn_orders_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_employee_id FOREIGN KEY (employee_id) REFERENCES mst_employees(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_customer_id FOREIGN KEY (customer_id) REFERENCES mst_customers(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_order_type_id FOREIGN KEY (order_type_id) REFERENCES mst_order_types(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_orders_updated_by FOREIGN KEY (updated_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE trn_order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT DEFAULT NULL,
    ordering_number INT DEFAULT NULL,
    category_id INT DEFAULT NULL,
    size_id INT DEFAULT NULL,
    product_id INT DEFAULT NULL,
    pattern_id INT DEFAULT NULL,
    collar_id INT DEFAULT NULL,
    variant_id INT DEFAULT NULL,
    variant_2_id INT DEFAULT NULL,
    variant_3_id INT DEFAULT NULL,
    variant_4_id INT DEFAULT NULL,
    variant_5_id INT DEFAULT NULL,

    name VARCHAR(100) NOT NULL,
    price DOUBLE(15,2) DEFAULT NULL,
    qty INT DEFAULT NULL,
    qty_done INT DEFAULT NULL,
    time_done DATETIME DEFAULT NULL,
    unit VARCHAR(100) DEFAULT NULL,
    order_amount DOUBLE(15,2) DEFAULT NULL,

    CONSTRAINT fk_trn_order_items_order_id FOREIGN KEY (order_id) REFERENCES trn_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_category_id FOREIGN KEY (category_id) REFERENCES mst_categories(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_size_id FOREIGN KEY (size_id) REFERENCES mst_sizes(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_product_id FOREIGN KEY (product_id) REFERENCES mst_products(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_pattern_id FOREIGN KEY (pattern_id) REFERENCES mst_patterns(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_collar_id FOREIGN KEY (collar_id) REFERENCES mst_collars(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_variant_id FOREIGN KEY (variant_id) REFERENCES mst_variants(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_variant_2_id FOREIGN KEY (variant_2_id) REFERENCES mst_variants_2(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_variant_3_id FOREIGN KEY (variant_3_id) REFERENCES mst_variants_3(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_variant_4_id FOREIGN KEY (variant_4_id) REFERENCES mst_variants_4(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_items_variant_5_id FOREIGN KEY (variant_5_id) REFERENCES mst_variants_5(id) ON DELETE SET NULL
);

CREATE TABLE trn_order_names (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT DEFAULT NULL,
    order_item_id INT DEFAULT NULL,
    product_id INT DEFAULT NULL,
    variant_id INT DEFAULT NULL,
    size_id INT DEFAULT NULL,

    order_number INT DEFAULT NULL,
    name VARCHAR(100) DEFAULT NULL,
    number_description VARCHAR(100) DEFAULT NULL,
    description TEXT DEFAULT NULL,

    CONSTRAINT fk_trn_order_names_order_id FOREIGN KEY (order_id) REFERENCES trn_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_names_order_item_id FOREIGN KEY (order_item_id) REFERENCES trn_order_items(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_names_product_id FOREIGN KEY (product_id) REFERENCES mst_products(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_names_variant_id FOREIGN KEY (variant_id) REFERENCES mst_variants(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_order_names_size_id FOREIGN KEY (size_id) REFERENCES mst_sizes(id) ON DELETE SET NULL
);

CREATE TABLE trn_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT DEFAULT NULL,
    bank_id INT DEFAULT NULL,
    code VARCHAR(100) DEFAULT NULL,
    payment_date DATE DEFAULT NULL,
    payment_type VARCHAR(100) DEFAULT NULL,
    payment_method VARCHAR(100) DEFAULT NULL,
    order_object JSON DEFAULT NULL,
    total DOUBLE(15,2) DEFAULT NULL,
    status VARCHAR(100) DEFAULT 'NEW',
    description TEXT DEFAULT NULL,

    CONSTRAINT fk_trn_payments_order_id FOREIGN KEY (order_id) REFERENCES trn_orders(id) ON DELETE SET NULL,
    CONSTRAINT fk_trn_payments_bank_id FOREIGN KEY (bank_id) REFERENCES mst_banks(id) ON DELETE SET NULL
);