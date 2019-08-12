<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= \Auth::user();
        return view ('employees.mydata', compact('user'));
    }

  
}
