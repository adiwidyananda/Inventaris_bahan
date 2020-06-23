<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Login/Logout
Route::get('/','LoginController@index');
Route::post('/checklogin','LoginController@checklogin');
Route::get('/logout','LoginController@logout');

//Admin
Route::get('/admin','AdminController@index');
Route::post('/addAdmin','AdminController@store');

//Kategori
Route::get('/kategori','KategoriController@index');
Route::post('/addKategori','KategoriController@store');
Route::post('/editKategori','KategoriController@edit');

//bahan
Route::get('/bahan','BahanController@index');
Route::post('/addBahan','BahanController@store');
Route::get('/deleteBahan/{id}','BahanController@destroy');
Route::post('/editBahan','BahanController@edit');
Route::get('/pdf-bahan','BahanCOntroller@cetak_pdf');

//bahan_masuk
Route::get('/bahan_masuk','BahanMasukController@index');
Route::post('/addBMasuk','BahanMasukController@store');
Route::get('/deleteBMasuk/{id}','BahanMasukController@destroy');
Route::post('/editBMasuk','BahanMasukController@edit');
Route::get('/cetakBMasuk','BahanMasukCOntroller@cetak');
Route::get('/buatlap-BMasuk','BahanMasukController@buatlaporan');
Route::post('/lap-bmasuk','BahanMasukController@laporan');
Route::post('/pdf-bmasuk','BahanMasukController@cetak_pdf');

//makanan
Route::get('/makanan','MakananController@index');
Route::post('/addMakanan','MakananController@store');
Route::post('/editMakanan','MakananController@edit');
Route::get('/deleteMakanan/{id}','MakananController@destroy');

//bahan_keluar
Route::get('/detailMakanan/{id}','BahanKeluarController@index');
Route::post('/addBKeluar','BahanKeluarController@store');
Route::post('/editBKeluar','BahanKeluarController@edit');
Route::get('/deleteBKeluar/{id}','BahanKeluarController@destroy');
Route::get('/buatlap-BKeluar','BahanKeluarController@buatlaporan');
Route::post('/lap-bkeluar','BahanKeluarController@laporan');
Route::post('/pdf-bkeluar','BahanKeluarController@cetak_pdf');

