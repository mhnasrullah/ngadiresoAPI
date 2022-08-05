<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authCon;

use App\Http\Controllers\beritaCon;
use App\Http\Controllers\wisataCon;
use App\Http\Controllers\imgWisataCon;
use App\Http\Controllers\faqwisCon;
use App\Http\Controllers\penyuratanCon;
use App\Http\Controllers\editableCon;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::controller(authCon::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');

// });

// Route::post('register', [authCon::class, 'register']);
// Route::post('login', [authCon::class, 'login']);
// Route::post('refresh', [authCon::class, 'refresh']);
// Route::post('user', [authCon::class, 'user']);
// Route::post('logout', [authCon::class, 'logout']);

Route::middleware(['cors'])->group(function () {
    
Route::get('/berita',[beritaCon::class,'index']);
Route::get('/berita/{id}',[beritaCon::class,'show']);
Route::post('/berita',[beritaCon::class,'store']);  
Route::post('/berita/{id}',[beritaCon::class,'update']);
Route::delete('/berita/{id}',[beritaCon::class,'destroy']);

Route::get('/wisata',[wisataCon::class,'index']);
Route::get('/wisata/{id}',[wisataCon::class,'show']);
Route::post('/wisata',[wisataCon::class,'store']);
Route::post('/wisata/{id}',[wisataCon::class,'update']);
Route::delete('/wisata/{id}',[wisataCon::class,'destroy']);

Route::get('/wisata/{id}/img',[imgWisataCon::class,'index']);
Route::post('/wisata/{id}/img',[imgWisataCon::class,'store']);
Route::post('/wisata/{id}/img/{foto}',[imgWisataCon::class,'update']);
Route::delete('/wisata/{id}/img/{foto}',[imgWisataCon::class,'destroy']);

Route::get('/surat',[penyuratanCon::class,'index']);
Route::post('/surat',[penyuratanCon::class,'store']);
Route::post('/surat/{id}',[penyuratanCon::class,'update']);
Route::delete('/surat/{id}',[penyuratanCon::class,'destroy']);

Route::get('/wisata/{id}/faq',[faqwisCon::class,'index']);
Route::post('/wisata/{id}/faq',[faqwisCon::class,'store']);
Route::delete('/wisata/{id}/faq/{faq}',[faqwisCon::class,'destroy']);

Route::get('/editable/all',[editableCon::class,'getAll']);

Route::post('/editable/tentangDesa',[editableCon::class,'updTentangDesa']);
Route::post('/editable/sambKades',[editableCon::class,'updSamKades']);
Route::post('/editable/namaKades',[editableCon::class,'updNamaKades']);
Route::post('/editable/jmlPria',[editableCon::class,'jmlPria']);
Route::post('/editable/jmlWanita',[editableCon::class,'jmlWanita']);
Route::post('/editable/jmlPenduduk',[editableCon::class,'jmlPenduduk']);

Route::post('/editable/create',[editableCon::class,'create']);
Route::post('/editable/jumbotron',[editableCon::class,'updJumbotron']);
Route::post('/editable/imgTentangDesa',[editableCon::class,'updImgTentangDesa']);
Route::post('/editable/imgKades',[editableCon::class,'updImgKades']);
Route::post('/editable/jmbtSejarah',[editableCon::class,'updJmbtSejarah']);
Route::post('/editable/jmbtKabar',[editableCon::class,'updJmbtKabar']);
Route::post('/editable/jmbtFaq',[editableCon::class,'updJmbtFaq']);
Route::post('/editable/jmbtWisata',[editableCon::class,'updJmbtWisata']);
Route::post('/editable/jmbtSurat',[editableCon::class,'updJmbtSurat']);

});