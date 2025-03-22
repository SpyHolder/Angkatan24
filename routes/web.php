<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;


// ALL ROLE
Route::get('/members',[HomeController::class,'members'])->name('members');
Route::get('/about-us',[HomeController::class,'aboutUs'])->name('about-us');
Route::get('/detail-news/{id}',[HomeController::class,'detailNews'])->name('detail-news');
Route::get('/news', [HomeController::class, 'news'])->name('news');

Route::get('/login',[HomeController::class,'login'])->name('login');
Route::post('/login', [HomeController::class, 'loginAuth'])->name('loginAuth');
Route::post('/logout',[HomeController::class,'logout'])->name('logout');
Route::get('/regis',[HomeController::class,'regis'])->name('regis');
Route::post('/proses-regis',[HomeController::class,'prosesRegis'])->name('proses-regis');


// Route khusus admin
Route::middleware(['auth', 'authRole:admin'])->group(function () {
    Route::get('/member-home', [MemberController::class, 'member'])->name('member-index');
    Route::get('/news-home', [NewsController::class, 'news'])->name('news-index');
    Route::get('/user-home', [HomeController::class, 'user'])->name('user-index');

    Route::get('/member-add', [MemberController::class, 'addMember'])->name('member-add');
    Route::get('/news-add', [NewsController::class, 'addNews'])->name('news-add');
    Route::get('/user-add', [HomeController::class, 'addUser'])->name('user-add');
    
    Route::post('/news-store', [NewsController::class, 'storeNews'])->name('news-store');
    Route::post('/member-store', [MemberController::class, 'storeMember'])->name('member-store');
    
    Route::delete('/user-destroy/{id}', [HomeController::class, 'destroyUser'])->name('user-destroy');

    Route::put('/news-update/{id}', [NewsController::class, 'updateNews'])->name('news-update');
    Route::delete('/news-destroy/{id}', [NewsController::class, 'destroyNews'])->name('news-destroy');
    Route::put('/news-konfirmasi/{id}', [NewsController::class, 'konfirmasiNews'])->name('news-konfirmasi');
    
    Route::put('/member-update/{id}', [MemberController::class, 'updateMember'])->name('member-update');
    Route::delete('/member-destroy/{id}', [MemberController::class, 'destroyMember'])->name('member-destroy');
    Route::put('/member-konfirmasi/{id}', [MemberController::class, 'konfirmasiMember'])->name('member-konfirmasi');

});
Route::get('/login-info/{id}', [NewsController::class, 'loginInfo'])->name('login-info');
Route::get('/member-img-info/{id}', [MemberController::class, 'memberImg'])->name('member-img-info');

// Route khusus member
Route::middleware(['auth', 'authRole:member'])->group(function () {
    Route::get('/member-add-member', [MemberController::class, 'memberAdd'])->name('member-add');
});

// Route khusus publisher
Route::middleware(['auth', 'authRole:publisher'])->group(function () {
    
});