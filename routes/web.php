<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login','AuthController@login')->middleware('guest')->name('login');
Route::post('/postlogin','AuthController@postlogin');

Route::get('/forget-password', 'ForgotPasswordController@getEmail')->name('get.email');
Route::post('/forget-password', 'ForgotPasswordController@postEmail')->name('post.email');

Route::get('/reset-password/{token}', 'ForgotPasswordController@getPassword')->name('resetpassword.token');
Route::post('/reset-password', 'ForgotPasswordController@updatePassword')->name('resetpassword.post');

Route::get('/logout','AuthController@logout');




Route::group(['middleware' => ['auth','nocache']], function(){
    Route::get('/','DashboardController@index')->name('dashboard.index');
    // Route::resource('/pegawai','PegawaiController')->except(['pegawai.create','pegawai.store','pegawai.update','pegawai.edit','pegawai.destroy']);
    // Route::resource('/user', 'UserController')->except(['user.create','user.store','user.update','user.edit','user.destroy']);

    Route::get('/pegawai', 'PegawaiController@index')->name('pegawai.index');
    Route::get('/pegawai/{id}/show', 'PegawaiController@show')->name('pegawai.show');
    Route::post('/pegawai/resetstatus', 'PegawaiController@resetStatus')->name('pegawai.reset_status');

    Route::get('/user', 'UserController@index')->name('user.index');
    Route::get('/user/{id}/show', 'UserController@show')->name('user.show');

    Route::get('/presensi/riwayat', 'PresensiController@history')->name('presensi.history');
    Route::get('/presensi/activity', 'PresensiController@activity')->name('presensi.activity');
    Route::get('/presensi/riwayat/exportexcel', 'PresensiController@exportExcel')->name('presensi.exportexcel');
    Route::get('/presensi/riwayat/exportpdf', 'PresensiController@exportPdf')->name('presensi.exportpdf');

    Route::get('/inventori', 'InventoriController@index')->name('inventori.index');
    Route::get('/inventori/priceindex', 'InventoriController@priceindex')->name('inventori.price');
    Route::get('/inventori/stok', 'InventoriController@stock')->name('inventori.stock');
    Route::get('/inventori/{id}/detail', 'InventoriController@show')->name('inventori.detail');

    Route::get('/user/edit/buffer', 'UserController@passwordbuffer')->name('user.edit_password_buffer');
    Route::post('/user/postbuffer', 'UserController@postbuffer')->name('user.postbuffer');

});

Route::middleware(['auth', 'CheckRole:SuperAdmin'])->group(function () {
    Route::get('/user/create','UserController@create')->name('user.create');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    // Route::get('/user/{id}/edit','UserController@edit')->name('user.edit');
    Route::put('/user/{id}/update','UserController@update')->name('user.update');
    Route::get('/user/{id}/destroy', 'UserController@destroy')->name('user.destroy');
    Route::post('/pegawai/resetstatus', 'PegawaiController@resetStatus')->name('pegawai.reset_status');

});

Route::middleware(['auth', 'CheckRole:SuperAdmin,Admin,Akuntan'])->group(function () {
    Route::get('/neraca', 'NeracaController@index')->name('neraca.index');
    Route::get('/neraca/{id}/detail', 'NeracaController@show')->name('neraca.detail');
    Route::get('/neraca/exportexcel', 'NeracaController@exportExcel')->name('neraca.exportexcel');
    Route::get('/neraca/exportpdf', 'NeracaController@exportPdf')->name('neraca.exportpdf');

});

Route::middleware(['auth', 'CheckRole:SuperAdmin,Admin'])->group(function () {
    // Employee Administration Task
    Route::get('/pegawai/create','PegawaiController@create')->name('pegawai.create');
    Route::post('/pegawai/store', 'PegawaiController@store')->name('pegawai.store');
    Route::put('/pegawai/{id}/update','PegawaiController@update')->name('pegawai.update');
    Route::get('/pegawai/{id}/destroy', 'PegawaiController@destroy')->name('pegawai.destroy');

    // Warehouse and Stock Task
    Route::get('/inventori/create', 'InventoriController@create')->name('inventori.create');
    Route::post('/inventori/store', 'InventoriController@store')->name('inventori.store');
    Route::get('/inventori/{id}/edit', 'InventoriController@edit')->name('inventori.edit');
    Route::put('/inventori/{id}/update', 'InventoriController@update')->name('inventori.update');
    Route::put('/inventori/{id}/updatestock', 'InventoriController@stock_update')->name('inventori.stock_update');
    Route::put('/inventori/{id}/updateminimumstock', 'InventoriController@minimum_stock_update')->name('inventori.minimum_stock_update');
    Route::put('/inventori/{id}/updateprice', 'InventoriController@price_update')->name('inventori.price_update');
    Route::get('/inventori/{id}/destroy', 'InventoriController@destroy')->name('inventori.destroy');

});

Route::middleware(['auth', 'CheckRole:SuperAdmin,Akuntan'])->group(function () {
    // Accountant Task
    Route::get('/neraca/create', 'NeracaController@create')->name('neraca.create');
    Route::post('/neraca/store', 'NeracaController@store')->name('neraca.store');
    Route::get('/neraca/{id}/edit', 'NeracaController@edit')->name('neraca.edit');
    Route::put('/neraca/{id}/update', 'NeracaController@update')->name('neraca.update');
    Route::get('/neraca/{id}/destroy', 'NeracaController@destroy')->name('neraca.destroy');
    Route::post('/neraca/akun', 'NeracaController@updateAkun')->name('neraca.update_akun');
});

Route::middleware(['auth', 'CheckRole:SuperAdmin,Mandor'])->group(function () {
    // Presensi Task
    Route::get('/presensi/indexin','PresensiController@indexIn')->name('presensi.indexin');
    Route::get('/presensi/indexout','PresensiController@indexOut')->name('presensi.indexout');
    Route::post('/presensi/store','PresensiController@store')->name('presensi.store');
    Route::put('/presensi/{id}/update','PresensiController@update')->name('presensi.update');
    Route::get('/presensi/{id}/masuk','PresensiController@checkIn')->name('presensi.checkin');
    Route::get('/presensi/{id}/keluar','PresensiController@checkOut')->name('presensi.checkout');
    Route::delete('/presensi/{id}/destroy', 'PresensiController@destroy')->name('presensi.destroy');
    Route::post('/presensi/absen' , 'PresensiController@absen')->name('presensi.absen');


});
