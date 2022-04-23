<?php 

function tanggal($date)
{
    $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    $tgl = date('d', strtotime($date));
    $bln = $bulan[date('n', strtotime($date))];
    $thn = date('Y', strtotime($date));

    return $tgl . ' ' . $bln . ' ' . $thn;
}

function hari($date)
{
    $hari = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    return $hari[date('N', strtotime($date))];
}

function tanggal_berita($date){
    return hari($date) . ', ' . tanggal($date);
}

function textToUnit($text){
    $unit = ['mi' => 2, 'mts' => 3, 'sma' => 4];
    return $unit[$text];
}

function unitToText($id){
    $unit = ['', 'yayasan', 'mi', 'mts', 'sma'];
    return $unit[$id];
}