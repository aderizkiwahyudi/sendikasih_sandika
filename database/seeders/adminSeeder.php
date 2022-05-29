<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => rand(999, 999999) . time(),
                'role_id' => 1,
                'unit_id' => 1,
                'username' => 'admin',
                'email' => 'admin@sendikasihsandika.or.id',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => rand(999, 999999) . time(),
                'role_id' => 1,
                'unit_id' => 2,
                'username' => 'admin.mi',
                'email' => 'admin.mi@sendikasihsandika.or.id',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => rand(999, 999999) . time(),
                'role_id' => 1,
                'unit_id' => 3,
                'username' => 'admin.smp',
                'email' => 'admin.smp@sendikasihsandika.or.id',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => rand(999, 999999) . time(),
                'role_id' => 1,
                'unit_id' => 4,
                'username' => 'admin.sma',
                'email' => 'admin.sma@sendikasihsandika.or.id',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
