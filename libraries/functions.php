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

function centerText($text, $width) {
    // Memecah teks menjadi beberapa baris dengan panjang maksimal $width
    $lines = wordwrap($text, $width, "\n", true);
    $linesArray = explode("\n", $lines);

    $centeredLines = array_map(function($line) use ($width) {
        // Hitung panjang padding untuk menempatkan teks di tengah
        $padding = str_repeat(' ', floor(($width - strlen($line)) / 2));
        return $padding . $line;
    }, $linesArray);

    return implode("\n", $centeredLines);
}

function renderCenter($text)
{
    $counter = strlen($text);
    $half = floor($counter/2);
    $base_center = 16;
    $num_of_space = $base_center - $half;
    $num_of_space = $num_of_space < 0 ? 0 : $num_of_space;

    return str_repeat(' ', $num_of_space) . $text ."\n";
}

function renderRight($text, $base = 32)
{
    $counter = strlen($text);
    $num_of_space = $base - $counter;
    $num_of_space = $num_of_space < 0 ? 0 : $num_of_space;

    return str_repeat(' ', $num_of_space) . $text;
}