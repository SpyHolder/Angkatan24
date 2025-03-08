<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\News;
use App\Models\MemberPicture;

class HomeController extends Controller
{
    public function news()
    {
        $data = News::all();
        return view('Main.news',compact('data'),[
            'title' => 'News'
        ]);
    }
    public function members()
    {
        $data = Member::all();
        return view('Main.members',compact('data'),[
            'title' => 'Members'
        ]);
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
