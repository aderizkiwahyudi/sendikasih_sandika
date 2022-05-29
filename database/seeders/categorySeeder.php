<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['unit_id' => 1, 'name' => 'Akademik', 'slug' => 'akademik', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'name' => 'Nonakademik', 'slug' => 'nonakademik', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'name' => 'Publikasi Karya', 'slug' => 'publikasi-karya', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'name' => 'Beasiswa', 'slug' => 'beasiswa', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            
            ['unit_id' => 2, 'name' => 'Prestasi', 'slug' => 'prestasi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 2, 'name' => 'Agenda', 'slug' => 'agenda', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 2, 'name' => 'Pengumuman', 'slug' => 'pengumuman', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

            ['unit_id' => 3, 'name' => 'Prestasi', 'slug' => 'prestasi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 3, 'name' => 'Agenda', 'slug' => 'agenda', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 3, 'name' => 'Pengumuman', 'slug' => 'pengumuman', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],

            ['unit_id' => 4, 'name' => 'Prestasi', 'slug' => 'prestasi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 4, 'name' => 'Agenda', 'slug' => 'agenda', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 4, 'name' => 'Pengumuman', 'slug' => 'pengumuman', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
