<?php

namespace Database\Seeders;

use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            ['unit_id' => 1, 'title' => 'Tepak Sirih', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'tepak-sirih', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'title' => 'Sejarah', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'sejarah', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'title' => 'Visi & Misi', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'visi-misi', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'title' => 'Lambang', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'lambang', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'title' => 'Struktur Pimpinan', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'struktur-pimpinan', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'title' => 'Lokasi Kantor Pusat', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'lokasi-kantor-pusat', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
