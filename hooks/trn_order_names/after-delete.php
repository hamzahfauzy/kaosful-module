<?php

set_flash_msg(['success'=>"Item berhasil dihapus"]);

header('location:'.routeTo('kaosful/orders/administration/create',['id' => $data->order_id]));
die();