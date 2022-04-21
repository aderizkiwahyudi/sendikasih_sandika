<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class newsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert([
            ['unit_id' => 1, 'show' => 1, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 1, 'title' => 'Lorem Title News', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-4', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'show' => 1, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 1, 'title' => 'Lorem Title News', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-5', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'show' => 1, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 1, 'title' => 'Lorem Title News', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-6', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'show' => 0, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 2, 'title' => 'Lorem Title Akademik', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'show' => 0, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 3, 'title' => 'Lorem Title Nonakademik', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-2', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'show' => 0, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 4, 'title' => 'Lorem Title Publikasi Karya', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['unit_id' => 1, 'show' => 1, 'thumbnail' => 'https://99designs-blog.imgix.net/blog/wp-content/uploads/2017/12/attachment_64213588-e1511649923389.jpg?auto=format&q=60&fit=max&w=930', 'category_id' => 5, 'title' => 'Lorem Title News', 'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, quis voluptatibus enim nesciunt saepe, fugiat animi, ad delectus quaerat molestias deserunt dolores! Tempora rem ea in commodi officiis numquam ipsa.', 'slug' => 'slug-6', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
