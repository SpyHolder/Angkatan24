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


//! Route khusus admin
Route::middleware(['auth', 'authRole:admin'])->group(function () {
    Route::get('/member-home-admin', [MemberController::class, 'memberAdmin'])->name('member-index-admin');
    Route::get('/news-home-admin', [NewsController::class, 'newsAdmin'])->name('news-index-admin');
    Route::get('/user-home-admin', [HomeController::class, 'userAdmin'])->name('user-index-admin');

    Route::get('/member-add-admin', [MemberController::class, 'addMemberAdmin'])->name('member-add-admin');
    Route::get('/user-add-admin', [HomeController::class, 'addUserAdmin'])->name('user-add-admin');
    
    Route::post('/member-store-admin', [MemberController::class, 'storeMemberAdmin'])->name('member-store-admin');
    
    Route::delete('/user-destroy-admin/{id}', [HomeController::class, 'destroyUserAdmin'])->name('user-destroy-admin');
    
    Route::put('/news-konfirmasi-admin/{id}', [NewsController::class, 'konfirmasiNewsAdmin'])->name('news-konfirmasi-admin');
    
    Route::delete('/member-destroy-admin/{id}', [MemberController::class, 'destroyMemberAdmin'])->name('member-destroy-admin');
    Route::put('/member-konfirmasi-admin/{id}', [MemberController::class, 'konfirmasiMemberAdmin'])->name('member-konfirmasi-admin');
    Route::put('/user-edit-admin/{id}', [HomeController::class, 'editUserAdmin'])->name('user-edit-admin');

});
Route::get('/login-info/{id}', [NewsController::class, 'loginInfo'])->name('login-info');
Route::get('/member-img-info/{id}', [MemberController::class, 'memberImg'])->name('member-img-info');

//! Route khusus member
Route::middleware(['auth', 'authRole:member,admin,publisher'])->group(function () {
    Route::get('/member-add-member', [MemberController::class, 'memberAddMembers'])->name('member-add-member');
    Route::post('/member-store', [MemberController::class, 'storeMember'])->name('member-store');
    Route::put('/member-update/{id}', [MemberController::class, 'updateMember'])->name('member-update');
});

// Route khusus publisher
Route::middleware(['auth', 'authRole:publisher'])->group(function () {
    Route::get('/news-home-publisher', [NewsController::class, 'newsPublisher'])->name('news-index-publisher');
});
Route::middleware(['auth', 'authRole:publisher,admin'])->group(function () {
    Route::get('/news-add-admin', [NewsController::class, 'addNewsAdmin'])->name('news-add-admin');
    Route::post('/news-store-admin', [NewsController::class, 'storeNewsAdmin'])->name('news-store-admin');
    Route::put('/news-update-admin/{id}', [NewsController::class, 'updateNewsAdmin'])->name('news-update-admin');
    Route::delete('/news-destroy-admin/{id}', [NewsController::class, 'destroyNewsAdmin'])->name('news-destroy-admin');
});