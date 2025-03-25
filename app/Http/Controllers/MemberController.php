<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberPicture;
use App\Models\Login;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    //! Hak Admin
    public function memberAdmin(){
        $users = Member::all();
        $usersPicture = MemberPicture::all();
        return view('Admins.member',[
            'user'=> $users,
            'userPicture'=> $usersPicture,
            'title'=>'User Members'
        ]);
    }

    //! Hak Admin
    public function memberImg($id){
        $memberPicture = MemberPicture::where('member_id',$id)->get()->toArray();
        return response()->json($memberPicture);
    }

    //! Hak Admin
    public function addMemberAdmin(){
        return view('Admins.addmember',['title'=>'User Members']);
    }

    //! Hak Member
    public function memberAddMembers(){

        $dataLogin = Member::where('login_id',session('sessionID'))->first();
        return view('Members.addmember',compact('dataLogin'),['title'=>'User Members']);
    }

    //! Hak Admin & Member
    public function storeMember(Request $request){
        $validasi = $request->validate([
            'fullname' => 'required',
            'nim' => 'required',
            'description' => 'required',
            'quote' => 'required',
            'yearin' => 'required',
            'memberImage.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'memberImage.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $dataAnggota = array_filter([
            'login_id'=>session('sessionID'),
            'full_name' => $validasi['fullname'],
            'nim' => $validasi['nim'],
            'description' => $validasi['description'],
            'quote' => $validasi['quote'],
            'year_in' => $validasi['yearin'],
            'year_out' => $request->yearout,
            'rarity' => $request->rarity,
            'rank' => $request->rank,
            'instagram' => $request->instagram,
            'github' => $request->github,
            'linkedid' => $request->linkedid,
            'website' => $request->website,
        ], fn($value) => !empty($value));

        $inputAnggota = Member::create($dataAnggota);

        $idAnggota = $inputAnggota->member_id;
        foreach ($request->memberImage as $foto) {
            $fotoName = time() . '-' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('img/member'), $fotoName);

            MemberPicture::create([
                'member_id' => $idAnggota,
                'member_picture' => $fotoName,
            ]);
        }

        if ($inputAnggota) {
            if (Auth::user()->isAdmin()) {
                return redirect()->route('member-index')->with('sukses', 'Berhasil menambah member');
            } else {
                return redirect()->route('member-add-member')->with('sukses', 'Berhasil menambah member');
            }
        } else {
            if (Auth::user()->isAdmin()) {
                return redirect()->route('member-index')->with('gagal', 'Gagal menambah member');
            } else {
                return redirect()->route('member-add-member')->with('gagal', 'Gagal menambah member');
            }
        }
    }

    //! Hak Admin
    function destroyMemberAdmin($id){
        $gambarMember = MemberPicture::where('member_id',$id)->get();
        $dataMember = Member::findOrFail($id);
        // dd($dataLogin);
        
        $validasiPicture = false;
        foreach ($gambarMember as $detelePicture) {
            if (File::exists(public_path('img/member/'.$detelePicture->member_picture))) {
                unlink(public_path('img/member/' . $detelePicture->member_picture));
            }
            $validasiPicture = $detelePicture->delete();
        }
        if ($dataMember->delete()||$validasiPicture) {
            return redirect()->route('member-index-admin')->with('sukses', 'Berhasil menghapus member');
        } else {
            return redirect()->route('member-index-admin')->with('gagal', 'Gagal menghapus member');
        }
    }

    //! Hak Admin
    function konfirmasiMemberAdmin($id){
        $dataMember = Member::findOrFail($id);
        
        $dataMember->update([
            'status'=>'1',
        ]);
        
        if ($dataMember) {
            return redirect()->route('member-index-admin')->with('sukses', 'Berhasil terkonfirmasi');
        } else {
            return redirect()->route('member-index-admin')->with('gagal', 'Gagal terkonfirmasi');
        }
    }

    public function updateMemberAdmin(Request $req,$id){

    }
}
