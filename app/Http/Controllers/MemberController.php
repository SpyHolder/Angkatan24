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

        $dataLogin = Member::with('relasiMany')->where('login_id',session('sessionID'))->first();
        // dd($dataLogin);
        return view('Members.addmember',compact('dataLogin'),['title'=>'User Members']);
    }

    //! Hak Admin, Member, & Publisher
    public function storeMember(Request $request){
        $validasi = $request->validate([
            'fullname' => 'required',
            'nim' => 'required|unique:members,nim',
            'description' => 'required',
            'quote' => 'required',
            'yearin' => 'required',
            'memberImage.*' => 'required|image|mimes:jpeg,png,jpg,svg',
            'memberImage.*' => 'required|image|mimes:jpeg,png,jpg,svg',
        ],[
            'nim.unique' => 'NIM sudah dimiliki orang',
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
                return redirect()->route('member-index-admin')->with('sukses', 'Berhasil menambah member');
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

    public function updateMember(Request $req,$id){

        $validasi = $req->validate([
            'fullname' => 'required',
            'nim' => 'required',
            'description' => 'required',
            'quote' => 'required',
            'yearin' => 'required',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,svg',
        ]);
        $dataAnggota = array_filter([
            'full_name' => $validasi['fullname'],
            'nim' => $validasi['nim'],
            'description' => $validasi['description'],
            'quote' => $validasi['quote'],
            'year_in' => $validasi['yearin'],
            'year_out' => $req->yearout,
            'rarity' => $req->rarity,
            'rank' => $req->rank,
            'instagram' => $req->instagram,
            'github' => $req->github,
            'linkedid' => $req->linkedid,
            'website' => $req->website,
        ], fn($value) => !empty($value));

        
        
        $item = Member::findOrFail($id);

        // **1. Hapus Gambar yang Dipilih**
        if ($req->has('delete_images')) {
            foreach ($req->delete_images as $imageId) {
                $image = MemberPicture::find($imageId);
                if ($image) {
                    if (File::exists(public_path('img/member/' . $image->member_picture))) {
                        unlink(public_path('img/member/' . $image->member_picture));
                    }
                    $image->delete();
                }
            }
        }

        // **2. Upload Gambar Baru**
        // dd($req->hasFile('new_images'));
        if ($req->hasFile('new_images')) {
            foreach ($req->file('new_images') as $file) {

                $fotoName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('img/member'), $fotoName);

                // Simpan ke database
                MemberPicture::create([
                    'member_id' => $item->member_id,
                    'member_picture' => $fotoName,
                ]);
            }
        }
        $item->update($dataAnggota);

        return redirect()->back()->with('sukses', 'Member berhasil diperbarui.');
    }
}
