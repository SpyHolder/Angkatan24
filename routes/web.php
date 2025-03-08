<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;

Route::get('/news',[HomeController::class,'news'])->name('news');
Route::get('/members',[HomeController::class,'members'])->name('members');

Route::get('/member-home',[MemberController::class,'member'])->name('member-index');
Route::get('/news-home',[NewsController::class,'news'])->name('news-index');

Route::get('/member-add',[MemberController::class,'addMember'])->name('member-add');
Route::get('/news-add',[NewsController::class,'addNews'])->name('news-add');

Route::post('/news-store',[NewsController::class,'storeNews'])->name('news-store');
Route::post('/member-store',[MemberController::class,'storeMember'])->name('member-store');

Route::put('/news-update/{id}',[NewsController::class,'updateNews'])->name('news-update');
Route::delete('/news-destroy/{id}',[NewsController::class,'destroyNews'])->name('news-destroy');
Route::put('/news-konfirmasi/{id}',[NewsController::class,'konfirmasiNews'])->name('news-konfirmasi');

Route::put('/member-update/{id}',[MemberController::class,'updateMember'])->name('member-update');
Route::delete('/member-destroy/{id}',[MemberController::class,'destroyMember'])->name('member-destroy');
Route::put('/member-konfirmasi/{id}',[MemberController::class,'konfirmasiMember'])->name('member-konfirmasi');

Route::get('/login',[HomeController::class,'login'])->name('login');
Route::post('/loginAuth',[HomeController::class,'loginAuth'])->name('loginAuth');