<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departments;
use App\User;
class DepartmentsController extends Controller
{
   

 public function index()
 {
$departments=Departments::all();

return view ('departments.index', compact('departments'));

 }
 

 public function create(Departments $department){
   
  $users=User::all();
   return view('departments.create',compact ('department'));
  
 }

public function store(Request $request,Departments $department){
    $data= $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'description' => ['required', 'string' ,'max:1000' ],
      
]); 

    $department->create($data);

    return redirect(route('departments.index'));

}
public function edit(Departments $department)
{
   
    return view('departments.edit', compact('department'));
}

public function update(Request $request,Departments $department)
    {
          
    $data=request()->validate([
          'name' => ['required', 'string', 'max:255'],
          'description' => ['required', 'string' ,'max:1000' ],
      
    ]); 
    $department->update($data);
     
      return redirect(route('departments.index'))->with('success', 'Pomyślnie zaktualizowano dane');
    }

public function destroy(Departments $department)
    {

        $department->delete();  
        return redirect(route('departments.index'))->with('success', 'Pomyślnie usunięto użytkownika');
    }    

}