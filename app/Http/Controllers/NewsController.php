<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Login;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{

    //! Hak Admin
    public function newsAdmin()
    {
        $loginNews = News::with('login')->get();
        return view('Admins.news', [
            'loginNews' => $loginNews,
            
            'title' => 'User News'
        ]);
    }

    //! Hak Publisher
    public function newsPublisher()
    {
        $loginNews = News::with('login')->where('login_id',session('sessionID'))->get();
        return view('Admins.news', [
            'loginNews' => $loginNews,
            'title' => 'User News'
        ]);
    }

    //! Hak Admin
    public function loginInfo($id){
        $loginInfo = Login::where('login_id',$id)->get()->toArray();

        return response()->json($loginInfo);
    }

    //! Hak Admin & Publisher
    public function addNewsAdmin()
    {
        $loginInfo = Login::findOrFail(session('sessionID'));
        // dd($loginInfo);
        return view('Admins.addnews', [
            'loginID'=>$loginInfo,
            'title' => 'User News',
        ]);
    }

    //! Hak Admin & Publisher
    public function storeNewsAdmin(Request $request)
    {
        // dd($request);
        // Validasi inputan kosong
        $validasi = $request->validate([
            'headline' => 'required',
            'covarage' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'thumbnail.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        /* Memasukkan gambar ke folder public/img/berita 
        Memasukkan alamat gambar ke dalam table fotoberita di database */
        $gambar = $request->file('thumbnail');
            //Mengubah nama file inputan
            $imageName = time() . '-' . uniqid() . '.' . $gambar->getClientOriginalExtension();
            //Memindahkan file inputan ke folder img
            $gambar->move(public_path('img/news'), $imageName);

        //memasukkan data ke database
        $berita = News::create([
            'headline_news' => $validasi['headline'],
            'login_id' => session('sessionID'),
            'covarage_area' => $validasi['covarage'],
            'date_publish' => $validasi['tanggal'],
            'time_publish' => $validasi['waktu'],
            'content_news' => $validasi['content'],
            'picture_news' => $imageName,
        ]);

        // Validasi jika berhasil memasukkan data ke database
        if ($berita) {
            return redirect()->route('news-index-admin')->with('sukses', 'Berita berhasil ditambahkan');
        } else {
            return redirect()->route('news-index-admin')->with('gagal', 'Berita gagal ditambahkan');
        }
    }

    //! Hak Admin
    public function konfirmasiNewsAdmin(string $id)
    {
        $berita = News::findOrFail($id);

        $validasi = $berita->update([
            'status'=>'1',
        ]);
        if ($validasi) {
            return redirect()->route('news-index-admin')->with('sukses', 'Berhasil mengkonfirmasi berita');
        } else {
            return redirect()->route('news-index-admin')->with('gagal', 'Gagal mengkonfirmasi berita');
        }
    }

    //! Hak Admin & Publisher
    public function updateNewsAdmin(Request $request, string $id)
    {
        // Validasi inputan kosong
        $validasi = $request->validate([
            'headline' => 'required',
            'covarage' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'content' => 'required',
        ]);

        $beritas = News::findOrFail($id);

        $beritas->update([
            'headline_news' => $request->headline,
            'login_id' => session('sessionID'),
            'covarage_area' => $request->covarage,
            'date_publish' => $request->tanggal,
            'time_publish' => $request->waktu,
            'content_news' => $validasi['content'],
        ]);

        $oldThumb = $request->input('oldThumbnail');
        $newThumb = $request->file('thumbnail');

        if (!empty($newThumb)) {
            unlink(public_path('img/news/'.$oldThumb));

            $imageName = time() . '-' . uniqid() . '.' . $newThumb->getClientOriginalExtension();
            $newThumb->move(public_path('img/news'), $imageName);

            $beritas->update([
                'picture_news'=>$imageName,
            ]);
        }

        return redirect()->route('news-index-admin')->with('sukses', 'Berita berhasil diubah');
    
    }

    //! Hak Admin & Publisher
    public function destroyNewsAdmin(string $id)
    {
        $beritas = News::findOrFail($id);
        if (File::exists(public_path('img/news/'.$beritas->picture_news))) {
            unlink(public_path('img/news/' . $beritas->picture_news));
        }

        if ($beritas->delete()) {
            return redirect()->route('news-index-admin')->with('sukses', 'Berhasil menghapus berita');
        } else {
            return redirect()->route('news-index-admin')->with('gagal', 'Gagal menghapus berita');
        }
    }
}
