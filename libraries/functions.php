<?php

use Core\Database;
use Modules\Crud\Libraries\Sdk\CrudGuardIndex;

CrudGuardIndex::set('kaosful', 'crud/edit', function(){

    if($_GET['table'] == 'trn_payments')
    {
        $db = new Database;
        $receive = $db->exists('trn_payments', [
            'status' => 'NEW',
            'id' => $_GET['id']
        ]);
        
        if(!$receive)
        {
            redirectBack(['error' => 'Maaf, tidak bisa Edit Pembayaran.. Karena Status bukan NEW lagi..']);
            return;
        }
    }
    
});

CrudGuardIndex::set('kaosful', 'crud/delete', function(){

    if($_GET['table'] == 'trn_payments')
    {
        $db = new Database;
        $receive = $db->exists('trn_payments', [
            'status' => 'NEW',
            'id' => $_GET['id']
        ]);
        
        if(!$receive)
        {
            redirectBack(['error' => 'Maaf, tidak bisa Hapus Pembayaran.. Karena Status bukan NEW lagi..']);
            return;
        }
    }

});