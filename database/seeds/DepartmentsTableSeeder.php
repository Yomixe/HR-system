<?php

use Illuminate\Database\Seeder;
use App\Departments;
class DepartmentsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    Departments::create([
    'name'=>"Informatyczny",
    'description'=>"IT"
    ]);
    Departments::create([
    'name'=>"Finanse",
    'description'=>"Finanse",
    ]);
    Departments::create([
    'name'=>"Organizacja",
    'description'=>"Organizacja",
    ]);
       
    Departments::create([
    'name'=>"Reklama",
    'description'=>"Dział reklamowy",
    ]);
    }
}
