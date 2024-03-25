<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //** create 3 roles */
        // ModelsRole::create(['name' => 'admin']) ;
        // ModelsRole::create(['name' => 'writer']) ;
        // ModelsRole::create(['name' => 'user']) ;
    }
}
