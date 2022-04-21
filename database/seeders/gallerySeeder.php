<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('galleries')->insert([
            ['id' => 16217162183, 'unit_id' => 1, 'title' => 'Kegiatan Yasinan Rutin Yayasan', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'kegiatan-yasinan-rutin-yayasan', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);

        DB::table('gallery_photos')->insert([
            ['gallery_id' => 16217162183, 'url' => 'https://pict-a.sindonews.net/dyn/620/content/2015/03/23/151/980070/budayakan-yasinan-bersama-setiap-jumat-s96-thumb.jpg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['gallery_id' => 16217162183, 'url' => 'https://kalteng.kemenag.go.id/file/fotoberita/500168.jpg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['gallery_id' => 16217162183, 'url' => 'https://jambi.kemenag.go.id/img/507348.jpg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
