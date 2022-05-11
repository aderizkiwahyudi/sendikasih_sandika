<?php

use App\Models\Classroom;
use App\Models\Role;
use App\Models\Status;
use App\Models\Unit;
use FontLib\Table\Type\name;
use Illuminate\Support\Str;

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

function unit_name($id)
{
    if(is_string($id)){
        $unit = Unit::where('name', 'like', '%'. $id .'%')->first();
        return $unit->id;
    }

    $unit = Unit::where('id', $id)->first();
    return ucwords($unit->name ?? '');
}

function get_role($id)
{
    $eng = ['admin' => 'admin','siswa' => 'student', 'guru' => 'teacher', 'staff' => 'staff'];
    $role = Role::where('name', $eng[$id])->first();
    return $role->id ?? '';
}

function get_status($name){
    if(is_string($name)){
        $status = Status::where('name', $name)->first();
        return $status->id ?? '';
    }

    $status = Status::where('id', $name)->first();
    $status->name == 'active' ? $status->name = 'aktif' : ($status->name == 'nonactive' ? $status->name = 'nonaktif' : $status->name = 'recruitment');
    return $status->name ?? '';
}

function get_classroom($id){
    $classroom = Classroom::where('id', $id)->first();
    return $classroom->name ?? '';
}

function file_upload($file)
{
    if($file){
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $name = pathinfo($name, PATHINFO_FILENAME);
        $rename = time() . '-' . Str::slug($name) . ".{$ext}";
        $file->move('img', $rename);
        return asset('img/' . $rename);
    }

    return false;
}