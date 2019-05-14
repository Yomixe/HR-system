<?php
use App\LeaveType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::group([
    'roles'=>['Admin','Kierownik', 'Pracownik'],
   'middleware'=>['roles','auth',]
], function(){
Route::get('/', 'HomeController@authorization');   
Route::get('/home','HomeController@authorization');
Route::get('/changepassword','HomeController@formchangepassword');
Route::post('/changepassword','HomeController@changepassword')->name('changepassword');
});
Route::group([
  'roles'=>['Admin',],
  'middleware'=>['roles','auth',]
], function(){
Route::resource('/departments', 'DepartmentsController');   
Route::resource('/users', 'UsersController') ;  

Route::get('users/{user}/create', 'UsersController@createDetails')->name('users.createDetails');
Route::patch('users/create/{user}', 'UsersController@storeDetails')->name('users.storeDetails');
//Route::get('/schedule/{year?month?}', 'ScheduleController@calendar')->name('schedule.calendar'); 
Route::get('/schedule', 'ScheduleController@calendar')->name('schedule.calendar'); 

});
Route::group([
  'roles'=>['Admin','Kierownik'],
  'middleware'=>['roles','auth',]
], function(){
Route::resource('/employees', 'EmployeesController') ;  
Route::resource('/schedule', 'ScheduleController'); 
Route::get('schedule/create/{schedule}', 'ScheduleController@create')->name('schedule.create');
Route::post('schedule/create/{schedule}', 'ScheduleController@store')->name('schedule.store');
Route::resource('/leavetype','LeaveTypeController');

});

Auth::routes(['register' => true]);


