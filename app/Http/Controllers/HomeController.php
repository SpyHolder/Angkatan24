<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Main.index');
    }
    public function login()
    {
        return view('login',['title' => 'User Members']);
    }
    public function loginAuth(Request $req)
    {
        return view();
    }
    
}
