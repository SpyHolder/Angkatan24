<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberPicture;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    public function member(){
        $users = Member::all();
        return view('Users.member',[
            'user'=> $users,
            'title'=>'User Members'
        ]);
    }
    public function addMember(){
        return view('Users.addmember',['title'=>'User Members']);
    }

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

        $dataAnggota = [
            'login_id'=>'1',
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
        ];

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
            return redirect()->route('member-index')->with('sukses', 'Berhasil menambah member');
        } else {
            return redirect()->route('member-index')->with('gagal', 'Gagal menambah member');
        }
    }
    function destroyMember($id){
        $gambarMember = MemberPicture::where('member_id',$id)->get();
        $dataMember = Member::findOrFail($id);
        
        $validasiPicture = false;
        foreach ($gambarMember as $detelePicture) {
            if (File::exists(public_path('img/member/'.$detelePicture->member_picture))) {
                unlink(public_path('img/member/' . $detelePicture->member_picture));
            }
            $validasiPicture = $detelePicture->delete();
        }
        if ($dataMember->delete()||$validasiPicture) {
            return redirect()->route('member-index')->with('sukses', 'Berhasil menghapus member');
        } else {
            return redirect()->route('member-index')->with('gagal', 'Gagal menghapus member');
        }
    }
    function konfirmasiMember($id){
        $dataMember = Member::findOrFail($id);
        
        $dataMember->update([
            'status'=>'1',
        ]);
        
        if ($dataMember) {
            return redirect()->route('member-index')->with('sukses', 'Berhasil terkonfirmasi');
        } else {
            return redirect()->route('member-index')->with('gagal', 'Gagal terkonfirmasi');
        }
    }
}
