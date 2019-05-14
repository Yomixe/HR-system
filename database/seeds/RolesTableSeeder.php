<?php

use Illuminate\Database\Seeder;
use App\Roles;
class RolesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    Roles::create([
    'name'=>"Admin",
    ]);
    Roles::create([
    'name'=>"Kierownik",
    ]);
    Roles::create([
    'name'=>"Pracownik",
        ]);
    }
}
