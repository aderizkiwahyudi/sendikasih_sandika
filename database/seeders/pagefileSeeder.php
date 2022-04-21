<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pagefileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('page_files')->insert([
            ['id' => 1, 'unit_id' => 1, 'title' => 'Files 1', 'description' => 'Keterangan Files 1', 'url' => 'https://himafiaunsri.com/public/file/2022418095955.pdf', 'slug'=> 'files-1', 'category' => 'rencana-strategis'],
            ['id' => 2, 'unit_id' => 1, 'title' => 'Files 2', 'description' => 'Keterangan Files 1', 'url' => 'https://himafiaunsri.com/public/file/2022418095955.pdf', 'slug'=> 'files-1', 'category' => 'rencana-strategis'],
            ['id' => 3, 'unit_id' => 1, 'title' => 'Files 1', 'description' => 'Keterangan Files 1', 'url' => 'https://himafiaunsri.com/public/file/2022418095955.pdf', 'slug'=> 'files-1', 'category' => 'perjanjian-strategis'],
            ['id' => 4, 'unit_id' => 1, 'title' => 'Files 1', 'description' => 'Keterangan Files 1', 'url' => 'https://himafiaunsri.com/public/file/2022418095955.pdf', 'slug'=> 'files-1', 'category' => 'perjanjian-strategis'],
        ]);
    }
}
