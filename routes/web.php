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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/main', function () {
    return view('layouts.main');
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');

Route::get('/forget-password', 'ForgotPasswordController@getEmail')->name('get.email');
Route::post('/forget-password', 'ForgotPasswordController@postEmail')->name('post.email');

Route::get('/reset-password/{token}', 'ForgotPasswordController@getPassword')->name('resetpassword.token');
Route::post('/reset-password', 'ForgotPasswordController@updatePassword')->name('resetpassword.post');

Route::get('/logout','AuthController@logout');




Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard','DashboardController@index')->name('dashboard.index');
    Route::resource('/pegawai','PegawaiController');
    Route::resource('/user', 'UserController');

    Route::get('/presensi/indexin','PresensiController@indexIn')->name('presensi.indexin');
    Route::get('/presensi/indexout','PresensiController@indexOut')->name('presensi.indexout');
    Route::get('/presensi/riwayat', 'PresensiController@history')->name('presensi.history');
    Route::get('/presensi/activity', 'PresensiController@activity')->name('presensi.activity');
    Route::post('/presensi/store','PresensiController@store')->name('presensi.store');
    Route::put('/presensi/{id}/update','PresensiController@update')->name('presensi.update');
    Route::get('/presensi/{id}/masuk','PresensiController@checkIn')->name('presensi.checkin');
    Route::get('/presensi/{id}/keluar','PresensiController@checkOut')->name('presensi.checkout');
    Route::get('/presensi/{id}/profile','PresensiController@showProfile')->name('presensi.show');
    Route::delete('/presensi/{id}/destroy', 'PresensiController@destroy')->name('presensi.destroy');
    Route::get('/presensi/riwayat/exportexcel', 'PresensiController@exportExcel')->name('presensi.exportexcel');
    Route::get('/presensi/riwayat/exportpdf', 'PresensiController@exportPdf')->name('presensi.exportpdf');

    Route::get('/inventori', 'InventoriController@index')->name('inventori.index');
    Route::get('/inventori/priceindex', 'InventoriController@priceindex')->name('inventori.price');
    Route::get('/inventori/stok', 'InventoriController@stock')->name('inventori.stock');
    Route::get('/inventori/{id}/detail', 'InventoriController@show')->name('inventori.detail');
    Route::get('/inventori/create', 'InventoriController@create')->name('inventori.create');
    Route::post('/inventori/store', 'InventoriController@store')->name('inventori.store');
    Route::get('/inventori/{id}/edit', 'InventoriController@edit')->name('inventori.edit');
    Route::put('/inventori/{id}/update', 'InventoriController@update')->name('inventori.update');
    Route::put('/inventori/{id}/updatestock', 'InventoriController@stock_update')->name('inventori.stock_update');
    Route::put('/inventori/{id}/updateminimumstock', 'InventoriController@minimum_stock_update')->name('inventori.minimum_stock_update');
    Route::put('/inventori/{id}/updateprice', 'InventoriController@price_update')->name('inventori.price_update');
    Route::delete('/inventori/{id}/destroy', 'InventoriController@destroy')->name('inventori.destroy');

    Route::get('/neraca', 'NeracaController@index')->name('neraca.index');
    Route::get('/neraca/{id}/detail', 'NeracaController@show')->name('neraca.detail');
    Route::get('/neraca/debit', 'NeracaController@debit')->name('neraca.debit');
    Route::get('/neraca/kredit', 'NeracaController@kredit')->name('neraca.kredit');
    Route::get('/neraca/create', 'NeracaController@create')->name('neraca.create');
    Route::post('/neraca/store', 'NeracaController@store')->name('neraca.store');
    Route::get('/neraca/{id}/edit', 'NeracaController@edit')->name('neraca.edit');
    Route::put('/neraca/{id}/update', 'NeracaController@update')->name('neraca.update');
    Route::delete('/neraca/{id}/destroy', 'NeracaController@destroy')->name('neraca.destroy');
    Route::get('/neraca/exportexcel', 'NeracaController@exportExcel')->name('neraca.exportexcel');
    Route::get('/neraca/exportpdf', 'NeracaController@exportPdf')->name('neraca.exportpdf');

    Route::get('/user/edit/buffer', 'UserController@passwordbuffer')->name('user.edit_password_buffer');
    Route::post('/user/postbuffer', 'UserController@postbuffer')->name('user.postbuffer');

});
