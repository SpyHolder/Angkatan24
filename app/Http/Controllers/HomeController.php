<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\News;
use App\Models\Login;
use App\Models\MemberPicture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function news()
    {
        $data = News::with('login')->get();
        return view('Main.news',compact('data'),[
            'title' => 'News'
        ]);
    }
    public function detailNews($id){
        $dataDetail = News::with('login')->findOrFail($id);
        $dataNews = News::with('login')->get();
        return view('Main.detailNews',compact('dataDetail','dataNews'),['title'=> 'Detail News']);
    }
    public function members()
    {
        $datas = Member::with('relasiMany')->get();
        return view('Main.members',[
            'title' => 'Members',
            'datas'=>$datas,
        ]);
    }
    public function aboutUs(){
        $data = [];
        return view('Main.aboutUs',compact('data'),['title'=>'About Us']);
    }
    public function login()
    {
        return view('login',['title' => 'User Members']);
    }
    public function loginAuth(Request $req)
    {

        $validasi = $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = Login::where('email', $req->email)->first();
        
        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // Regenerasi session untuk keamanan
            $req->session()->put('sessionID',$user['login_id']); 

            // Redirect ke halaman sesuai role
            if ($user->isAdmin()) {
                return redirect()->route('member-index');
            } else if ($user->isMember()) {

                $dataLogin = Member::find(session('sessionID'));

                return redirect()->route('member-add',compact('dataLogin'));
            }
        }

            return redirect('/login');

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();

        return redirect('/login');
    }

    public function regis(){
        return view('regis');
    }
    public function prosesRegis(Request $req){
        $validasi = $req->validate([
            'username'=>'required|unique:Logins,username',
            'email'=> 'required|unique:Logins,email',
            'password'=>'required|confirmed',
        ],[
            'username.unique'=>'Username sudah dimiliki orang',
            'email.unique'=>'Email sudah dimiliki orang',
            'password.confirmed'=>'Password tidak sesuai',
        ]);

        $crete = Login::create([
            'username'=>$validasi['username'],
            'email'=>$validasi['email'],
            'password'=>Hash::make($validasi['password']),
            'role'=>'member',
        ]);

        if ($crete) {
            return redirect()->route('login')->with('sukses', 'Berhasil Teregister');
        } else {
            return redirect()->route('regis')->with('Gagal', 'Gagal Teregister');
        }
    }
    


    public function user(){
        $dataLogin = Login::all();
        return view('Users.user', [
            'title' => 'User Login',
            'dataLogin'=>$dataLogin]);
    }
    public function destroyUser(string $id)
    {
        $login = Login::findOrFail($id);
        
        if ($login->delete()) {
            return redirect()->route('user-index')->with('sukses', 'Berhasil menghapus user');
        } else {
            return redirect()->route('user-index')->with('gagal', 'Gagal menghapus user');
        }
    }

}
