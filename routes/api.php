<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authCon;

use App\Http\Controllers\beritaCon;
use App\Http\Controllers\wisataCon;
use App\Http\Controllers\imgWisataCon;
use App\Http\Controllers\faqwisCon;


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

Route::get('/wisata/{id}/faq',[faqwisCon::class,'index']);
Route::post('/wisata/{id}/faq',[faqwisCon::class,'store']);
Route::delete('/wisata/{id}/faq/{faq}',[faqwisCon::class,'destroy']);