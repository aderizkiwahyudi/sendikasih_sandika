<?php

namespace Database\Seeders;

use App\Models\Year;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class moreSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('more_setting')->insert([
            'id' => 1,
            'year_id' => Year::latest('created_at')->first()->id,
            'facebook' => '#',  
            'twitter' => '#',  
            'youtube' => '#',  
        ]);
    }
}
