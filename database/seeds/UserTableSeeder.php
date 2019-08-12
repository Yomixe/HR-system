<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Roles;
use App\Contact;
use App\Employee;
use App\Departments;
class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    
    $admin=User::create([
        'first_name'=>'Jan',
        'last_name'=>'Nowak',
        'email'=>'jan@example.com',
        'username'=>'janek123',
        'password'=>hash::make('!QAZ2wsx'),
        
        'date_of_birth'=>'1998-10-18',
      
        'status'=>1,
    ]);
   $admin ->roles() ->attach(Roles::where('name','Admin')->first());
  

    $manager=User::create([
        'first_name'=>'Janusz',
        'last_name'=>'Milik',
        'email'=>'janusz@example.com',
        'username'=>'janusz123',
        'password'=>hash::make('!QAZ2wsx'),
        'department_id'=>2,
        'date_of_birth'=>'1998-10-18',
       
    ]); 
    $manager->roles()->attach(Roles::where('name','Kierownik')->first());
    
    $employee=User::create([
        'first_name'=>'Janina',
        'last_name'=>'Nowakowska',
        'email'=>'janina@example.com',
        'username'=>'janina',
        'password'=>Hash::make('!QAZ2wsx'),
        'department_id'=>2,
        'date_of_birth'=>'1998-10-18',
       
    ]);
    $employee->roles()->attach(Roles::where('name','Pracownik')->first());
    
    factory(Employee::class,20)->create();
    factory(Contact::class, 20)->create();
    
    


    factory(User::class, 6)->create()->each(function ($user) {
        $user->roles()->attach(Roles::where('id',2)->first());
    });
    factory(User::class, 14)->create()->each(function ($user) {
        $user->roles()->attach(Roles::where('id',3)->first());
       
    });
   
    }
}
