<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 


    public function authorization()
    {
        if(auth()->user()->hasRole('admin'))
        {
            return view('admin');
        } 
        elseif(auth()->user()->hasRole('kierownik'))
        {
            return view('kierownik');
        } 
        elseif(auth()->user()->hasRole('pracownik'))
        {
            return view('pracownik');
        }
        
    }

    public function FormChangePassword()
    {
            return view('auth.changepassword');
    }
    public function ChangePassword(Request $request)
    { 
      
        $user = User::find(Auth::id());
      
        if (!(Hash::check($request->current, $user->password))) {
        
            return redirect()->back()->with("error","Hasło, które wprowadziłeś nie zgadza się z obecnym. Spróbuj jeszcze raz.");
        }
        if(strcmp($request->current, $request->password )== 0){
        
            return redirect()->back()->with("error","Nowe hasło nie może być takie samo jak poprzednie.");
        }
         $request->validate([
            'current' => ['required'],
            'password' => ['required', 'string', 'min:8','max:255','confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
            'password_confirmation' => 'required'
            ]);
        
           
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");

    }

}