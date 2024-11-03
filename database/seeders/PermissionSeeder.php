<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'assign user'],
            ['name' => 'activate user'],
            ['name' => 'desactivate user'],
            ['name' => 'edit user'],
            ['name' => 'new user'],
            ['name' => 'new task'],
            ['name' => 'edit task'],
            ['name' => 'delete task']
        ]);
    }
}
