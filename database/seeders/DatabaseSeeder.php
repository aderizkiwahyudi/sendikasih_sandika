<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            unitSeeder::class,
            yearSeeder::class,
            roleSeeder::class,
            statusSeeder::class,
            classSeeder::class,
            moreSettingSeeder::class,
            categorySeeder::class,
            pageSeeder::class,
            newsSeeder::class,
            pagefileSeeder::class,
            recruitmentSettingSeeder::class,
            gallerySeeder::class,
            ContributionSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
