<?php

namespace App\Http\Controllers;
use App\Employee;
use App\User;
use App\Contact;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $employee=Employee::all();
        $contacts=Contact::all();
        $users=User::all();
        $current= \Auth::user();
  return view ('employees.index', compact('employee','contacts','users','current'));
    }

   
      public function show($id)
      {
        $user= User::findOrFail($id);
          return view('employees.show', compact('user','employee'));
      }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        $user=User::FindOrFail($id);
        $user->employees->delete();
        $user->contacts->delete();

        return redirect(route('pracownicy.index'))->with('success', 'Pomyślnie usunięto dane');
    }

    
}
