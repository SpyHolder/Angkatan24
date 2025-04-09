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

//! Start Hak Akses All Role
    public function news()
    {
        $data = News::with('login')->orderBy('created_at','desc')->get();
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
        $datas = Member::with('relasiMany')
            ->orderByRaw("
            CASE 
            WHEN members.rank is null THEN 6
            WHEN members.rank = 'Ketua Angkatan' THEN 1
            WHEN members.rank = 'Wakil Ketua Angkatan' THEN 2
            WHEN members.rank = 'Bendahara' THEN 3
            WHEN members.rank = 'Seketaris' THEN 4
            ELSE 5
        END
    ")->get();

        return view('Main.members',[
            'title' => 'Members',
            'datas'=>$datas,
        ]);
    }
    public function aboutUs(){
        $data = [];
        return view('Main.aboutUs',compact('data'),['title'=>'Diversi-TI']);
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

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email salah.',
            ]);
        } else if (!Hash::check($validasi['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah.',
            ]);
        }

        if (Auth::attempt($credentials)) {

            // Regenerasi session untuk keamanan
            $req->session()->put('sessionID',$user['login_id']); 

            // Redirect ke halaman sesuai role
            if ($user->isAdmin()) {
                return redirect()->route('member-index-admin');
            } else if ($user->isMember()) {
                return redirect()->route('member-add-member');
            } else if($user->isPublisher()){
                return redirect()->route('news-index-publisher');
            }
        }

            return redirect('/regis');

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('login');
    }

    public function regis(){
        return view('regis');
    }
    public function prosesRegis(Request $req){
        // dd($req);
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
//! End Hak Akses All Role

//! Start Hak Akses ADMIN
    public function userAdmin(){
        $dataLogin = Login::all();
        return view('Admins.user', [
            'title' => 'User Login',
            'dataLogin'=>$dataLogin]);
    }
    public function destroyUserAdmin(string $id)
    {
        $login = Login::findOrFail($id);
        
        if ($login->delete()) {
            return redirect()->route('user-index-admin')->with('sukses', 'Berhasil menghapus user');
        } else {
            return redirect()->route('user-index-admin')->with('gagal', 'Gagal menghapus user');
        }
    }
    public function editUserAdmin(Request $req,$id){
        $user = Login::findOrFail($id);

        $validasi = $req->validate([
            'username' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $data = [
            'username' => $validasi['username'],
            'email' => $validasi['email'],
            'role' => $validasi['role'],
        ];
        if(!empty($req['newPassword'])){
            $data = array_merge($data,[
                'password'=> Hash::make($req['newPassword'])
            ]);
        }

        $user->update($data);
        return redirect()->route('user-index-admin')->with('sukses', 'User berhasil diubah');
    }
//! End Hak Akses ADMIN

    public function ricroll(){
        return redirect()->away('https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');
    }
    public function judol(){
        return redirect()->away('https://www.youtube.com/shorts/afz_Lo47gsc?feature=share');
    }

}
