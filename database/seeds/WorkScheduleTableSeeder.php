<?php

use Illuminate\Database\Seeder;
use App\PlanPracy;
class WorkScheduleTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     DB::table('Work_Schedule')->insert([
    
    'date'=>"2019-01-01",
    'type_of_day'=>"Święto",
    'start'=>"7:00",
    'end'=>'15:00',
    
    ]);
   
    }
}
