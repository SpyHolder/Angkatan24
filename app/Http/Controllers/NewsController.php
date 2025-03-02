<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function news()
    {
        $news = News::all();
        // dd($news);
        return view('Users.news', [
            'news' => $news,
            'title' => 'User News'
        ]);
    }
    public function addNews()
    {
        return view('Users.addnews', ['title' => 'User News']);
    }

    public function storeNews(Request $request)
    {
        // Validasi inputan kosong
        $validasi = $request->validate([
            'headline' => 'required',
            'publisher' => 'required',
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
            'publisher' => $validasi['publisher'],
            'covarage_area' => $validasi['covarage'],
            'date_publish' => $validasi['tanggal'],
            'time_publish' => $validasi['waktu'],
            'content_news' => $validasi['content'],
            'picture_news' => $imageName,
        ]);

        // Validasi jika berhasil memasukkan data ke database
        if ($berita) {
            return redirect()->route('news-index')->with('sukses', 'Berita berhasil ditambahkan');
        } else {
            return redirect()->route('news-index')->with('gagal', 'Berita gagal ditambahkan');
        }
    }

    public function konfirmasiNews(string $id)
    {
        $berita = News::findOrFail($id);

        $validasi = $berita->update([
            'status'=>'1',
        ]);
        if ($validasi) {
            return redirect()->route('news-index')->with('sukses', 'Berhasil mengkonfirmasi berita');
        } else {
            return redirect()->route('news-index')->with('gagal', 'Gagal mengkonfirmasi berita');
        }
    }

    public function updateNews(Request $request, string $id)
    {
        // Validasi inputan kosong
        $validasi = $request->validate([
            'headline' => 'required',
            'publisher' => 'required',
            'covarage' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'content' => 'required',
        ]);

        $beritas = News::findOrFail($id);

        $beritas->update([
            'headline_news' => $request->headline,
            'publisher' => $request->publisher,
            'covarage_area' => $request->covarage,
            'data_publish' => $request->tanggal,
            'time_publish' => $request->waktu,
            'content_news' => $request->content,
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

        return redirect()->route('news-index')->with('sukses', 'Berita berhasil diubah');
    
    }

    public function destroyNews(string $id)
    {
        $beritas = News::findOrFail($id);
        if (File::exists(public_path('img/news/'.$beritas->picture_news))) {
            unlink(public_path('img/news/' . $beritas->picture_news));
        }

        if ($beritas->delete()) {
            return redirect()->route('news-index')->with('sukses', 'Berhasil menghapus berita');
        } else {
            return redirect()->route('news-index')->with('gagal', 'Gagal menghapus berita');
        }
    }
}
