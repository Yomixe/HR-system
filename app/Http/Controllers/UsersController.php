<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Departments;
use App\Contact;
use App\Employee;

use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{
public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
       $users=User::all();
       
        return view('users.index', compact('users'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
   */
    public function show(User $user)
    {
        //
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles= Roles::all();
        $departments=Departments::all();
        return view('users.edit', compact('user','roles','departments'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    
    
     $data=$request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string' ,'max:255' ],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'date_of_birth' => ['date', 'nullable'],
            'status'=>['boolean','nullable'],
            'department_id'=>['nullable'],
        ]); 
        $user->update($data);
        $currentid = \Auth::user()->id;
      
     if($currentid == $user->id and $user->roles()->detach([1]))
            { 
                $user->roles()->attach([1]);
                
              return redirect(route('users.index'))->with('error', 'Nie możesz edytować swoich uprawnień!');   
            }
    else

           { $user->roles()->sync($request->role);  
               return redirect(route('users.index'))->with('succes',"Pomyślnie zaktualizowano dane");}
         
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currentid = \Auth::user()->id;
        if($currentid != $id)
            {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users')->with('succes', 'Pomyślnie usunięto użytkownika');
            }
        else
        {return redirect('/users')->with('error', 'Nie możesz usunąć swojego konta!');}
    }

    public function createDetails(User $user,Contact $contact, Employee $employee){
   
    
        return view('users.create',compact ('user','employee','contact'));
       
      }
    
    public function storeDetails(Request $request,$id){


        $ContractData= $request->validate([
           
            'start_job_date'=>['date','required'],
            'salary'=>['nullable','integer'],
            'working_hours'=>['required'],
            'tax_office'=>['required'],
            'health_exam_from'=>['date','required'],
            'health_exam_to'=>['date','required'],
            'position'=>['string'],
           
      ]);  
       $ContactData=$request->validate([
        'street'=>['required', 'max:255',],
        'number'=>['required','integer'],
        'flat_number'=>['nullable','integer'],
        'city'=>['required','string',],
        'country'=>['required','string'],
        'postal_code'=>['required','string','max:6','min:6'],
        'phone_number'=>['required', 'max:9','min:9']
       

      ]);
      $user = User::with('employees','contacts')->findOrFail($id);


      if ($user->employees === null && $user->contacts === null)

      {
          $employee = new Employee($ContractData);
          $user->employees()->save($employee);

         $contact = new Contact($ContactData);
          $user->contacts()->save($contact);
          
      }
      else
      {

        $user->employees->update($ContractData);
        $user->contacts->update($ContactData);
      }

   
  
      return redirect(route('users.edit',[$id]))->with('success', 'Pomyślnie dodano dane');
     
   }












}
