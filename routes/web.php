<?php


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
Route::get('/zmienhaslo','HomeController@formchangepassword');
Route::post('/zmienhaslo','HomeController@changepassword')->name('changepassword');
Route::resource('/kalendarz','CalendarController');
Route::get('wykresy/urlopy',"ChartController@leaves")->name('wykresy.urlopy');
Route::resource('/mojedane','MyDataController');
Route::resource('schedule', 'ScheduleController'); 
});
Route::group([
  'roles'=>['Admin',],
  'middleware'=>['roles','auth',]
], function(){
Route::resource('departments', 'DepartmentsController');   
Route::resource('users', 'UsersController') ;  

Route::get('users/{users}/create', 'UsersController@createDetails')->name('users.createDetails');
Route::patch('users/create/{users}', 'UsersController@storeDetails')->name('users.storeDetails');
Route::get('wykresy/nowiuzytkownicy',"ChartController@newusers");


});
Route::group([
  'roles'=>['Admin','Kierownik'],
  'middleware'=>['roles','auth',]
], function(){

Route::resource('/typurlopu','LeaveTypeController');
Route::resource('/urlopy','LeaveController');
Route::post('urlopy/{urlopy}/potwierdz','LeaveController@confirm');
Route::get('wykresy/urlopypracownikow',"ChartController@leavesforManager")->name('wykresy.urlopypracownikow');

});
Route::group([
  'roles'=>['Kierownik'],
  'middleware'=>['roles','auth',]
], function(){
  Route::resource('/pracownicy', 'EmployeesController') ;  


});
Route::group([
  'roles'=>['Pracownik'],
  'middleware'=>['roles','auth',]
], function(){

Route::resource('/mojeurlopy','EmployeeLeaveController');


});

Auth::routes(['register' => true]);



