<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name'=>'admin','display_name' => 'Quản trị hệ thống'],
            ['name'=>'employee','display_name' => 'Nhân viên'],
            ['name'=>'developer','display_name' => 'Phát triển hệ thống'],
        ]);
    }
}
