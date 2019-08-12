<?php

use App\User;
use App\Departments;
use App\Role;
use App\Contact;
use App\Employee;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
   
   $departments=Departments::all();
     $lastName = $faker->lastName;
    if(substr($lastName,-1)=='a')  $firstName=$faker->firstNameFemale;
    
    else $firstName = $faker->firstNameMale;
  
    return [
        'first_name' => $firstName,
        'last_name'=>$lastName,
        'username'=>$firstName.".".$lastName,
        'email' =>$firstName.".".$lastName."@firmark.pl",
        'date_of_birth'=>$faker->dateTimeBetween(1960,2000),
        'password' => hash::make('!QAZ2wsx'), // password
        'remember_token' => Str::random(10),
        'department_id'=>rand(1,count($departments)),
        'status'=>rand(0,1),
        'employee_id' => $faker->unique(true)->numberBetween(1, Employee::count()),
        'contact_id' => $faker->unique(true)->numberBetween(1, Contact::count()),
      
    ];
    
});
$factory->define(Contact::class, function (Faker $faker) use ($factory){
   
  
     return [
         'street' => $faker->streetName,
         'number' => $faker->numberBetween(1,200),
    
         'postal_code'=>$faker->postcode,
         'city'=>"Nowy Sącz",
         'country' => "Polska", 
         'phone_number' => $faker->phoneNumber,
         'phone_number2' => $faker->phoneNumber,
        
       
     ];
     
 });
 $factory->define(Employee::class, function (Faker $faker) use ($factory){
  
    
     return [
         'start_job_date' => $faker->dateTime('now'),
         'salary' => $faker->numberBetween(2000,10000),
         'working_hours'=>1/1,
         'tax_office'=>"Urząd Skarbowy w Nowym Sączu ",
         'health_exam_from' =>$faker->dateTimeBetween('now','2019-08-12'),
         'health_exam_to' => $faker->dateTimeBetween('2019-08-12','2023-08-12'),
         'bank_account'=>$faker->bankAccountNumber,
         'position'=>$faker->jobTitle,
        
       
     ];
     
 });