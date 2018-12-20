<?php

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
// AUTH

Route::group(['middleware' => 'guest'], function(){

  Route::get('/', 'Auth\AuthController@index');

  Route::post('/login', 'Auth\AuthController@login')->name('login');

  Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

  Route::get('/password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

  Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('reset');

  Route::get('/password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

});

Route::post('/logout', 'Auth\AuthController@logout')->name('logout');


Route::group(['middleware'=>'auth'], function()
{

  Route::get('roleCheck', 'Auth\AuthController@roleCheck')->name('roleCheck');

  //PROFILE

  Route::group(['prefix' => 'profile'], function(){

    Route::get('index', 'ProfileController@index')->name('profile');

    Route::post('edit', 'ProfileController@edit')->name('profile.edit');

    Route::post('update', 'ProfileController@update')->name('profile.update');

    Route::post('changepassword', 'ProfileController@changepassword')->name('profile.changepassword');

  });

  //CLOUD

  Route::group(['prefix' => 'cloud'], function(){

    Route::get('index', 'CloudController@index')->name('cloud.index');

    Route::post('upload', 'CloudController@upload')->name('cloud.upload');

    Route::post('init', 'CloudController@init')->name('cloud.init');

    Route::post('share', 'CloudController@share')->name('cloud.share');

    Route::post('destroy', 'CloudController@destroy')->name('cloud.destroy');

  });

});


// PELAKSANA

Route::group(['middleware' => 'pelaksana'], function(){

  Route::group(['prefix' => 'pelaksana'], function(){

    Route::group(['prefix' => 'users/pegawai'], function(){

      Route::get('/', 'UserController@Pelaksana_index_pegawai')->name('users.pegawai.index');

      Route::post('store', 'UserController@Pelaksana_store_pegawai')->name('users.pegawai.store');

      Route::post('detail', 'UserController@detail')->name('users.pegawai.detail');

      Route::post('destroy', 'UserController@destroy')->name('users.pegawai.destroy');

    });

    Route::group(['prefix' => 'users/anggota'], function(){

      Route::get('/', 'UserController@Pelaksana_index_anggota')->name('users.anggota.index');

      Route::post('store', 'UserController@Pelaksana_store_anggota')->name('users.anggota.store');

      Route::post('detail', 'UserController@detail')->name('users.anggota.detail');

      Route::post('destroy', 'UserController@destroy')->name('users.anggota.destroy');

    });

    Route::group(['prefix' => 'users/rekanan'], function(){

      Route::get('/', 'UserController@Pelaksana_index_rekanan')->name('users.rekanan.index');

      Route::post('store', 'UserController@Pelaksana_store_rekanan')->name('users.rekanan.store');

      Route::post('detail', 'UserController@detail')->name('users.rekanan.detail');

      Route::post('destroy', 'UserController@destroy')->name('users.rekanan.destroy');

    });

  });

});

//PENGURUS

Route::group(['middleware' => 'pengurus'], function(){

  Route::group(['prefix' => 'pengurus'], function(){

    Route::group(['prefix' => 'marketplace/ajuanpendanaan'], function(){

      Route::get('/', 'PendanaanController@Pengurus_index_AjuanPendanaan')->name('pengurus.marketplace.ajuanPendanaan.index');

      Route::get('/proses', 'PendanaanController@Pengurus_index_Proses_AjuanPendanaan')->name('pengurus.marketplace.ajuanPendanaan.index');

      Route::post('konfirmasi/form/hr', 'PendanaanController@Pengurus_form_KonfirmasiHR')->name('pengurus.marketplace.form.konfirmasi.hr');

      Route::post('konfirmasi/hr', 'PendanaanController@Pengurus_KonfirmasiHR')->name('pengurus.marketplace.konfirmasi.hr');

      Route::post('konfirmasi/form/pengurus', 'PendanaanController@Pengurus_form_KonfirmasiPengurus')->name('pengurus.marketplace.form.konfirmasi.pengurus');

      Route::post('konfirmasi/pengurus', 'PendanaanController@Pengurus_KonfirmasiPengurus')->name('pengurus.marketplace.konfirmasi.pengurus');

      Route::post('detail', 'PendanaanController@Pengurus_detail_AjuanPendanaan')->name('pengurus.marketplace.ajuanPendanaan.detail');

      Route::post('invoice', 'PendanaanController@Pengurus_invoice_AjuanPendanaan')->name('pengurus.marketplace.ajuanPendanaan.invoice');

      Route::get('/log', 'PendanaanController@Pengurus_index_Log_AjuanPendanaan')->name('pengurus.marketplace.ajuanPendanaan.log.index');

    });


    Route::group(['prefix' => 'peminjaman'], function(){

      Route::get('TanpaAngunan', 'PetugasController@indexAdminT')->name('pengurus.peminjaman.TanpaAngunan');

      Route::post('editPeminjaman', 'PetugasController@editPeminjaman')->name('petugas.peminjaman.editPeminjaman');

      Route::post('updatePeminjaman', 'PetugasController@updatePeminjaman')->name('petugas.peminjaman.updatePeminjaman');

      Route::post('editStatus', 'PetugasController@editStatus')->name('petugas.peminjaman.editStatus');

      Route::post('updateStatus', 'PetugasController@updateStatus')->name('petugas.peminjaman.updateStatus');

      Route::post('editNomor', 'PetugasController@editNomor')->name('petugas.peminjaman.editNomor');

      Route::post('updateNomor', 'PetugasController@updateNomor')->name('petugas.peminjaman.updateNomor');

      Route::post('detail', 'PetugasController@detailPeminjaman')->name('petugas.peminjaman.detailPeminjaman');

      Route::get('/log', 'PetugasController@Pengurus_index_Log_AjuanPeminjaman')->name('pengurus.Peminjaman.log');

      Route::post('destroy', 'PetugasController@destroy')->name('petugas.peminjaman.destroy');

    });

  });

});


//ANGGOTA

Route::group(['middleware' => 'anggota'], function(){

  Route::group(['prefix' => 'anggota'], function(){

    Route::group(['prefix' => 'marketplace/ajuanpendanaan'], function(){

      Route::get('/', 'PendanaanController@Anggota_index_Rekanan')->name('anggota.marketplace.anjuanpendanaan.index');

      Route::post('detail', 'PendanaanController@Anggota_detail_Rekanan')->name('anggota.marketplace.rekanan.detail');

      Route::get('barang/{id}', 'PendanaanController@Anggota_index_Barang')->name('anggota.marketplace.barang.index');

      Route::post('barang/detail', 'PendanaanController@Anggota_detail_Barang')->name('anggota.marketplace.barang.detail');

      Route::post('form', 'PendanaanController@Anggota_form_Pengajuanpendanaan')->name('anggota.marketplace.barang.form');

      Route::post('store', 'PendanaanController@Anggota_store_Pengajuanpendanaan')->name('anggota.marketplace.barang.store');

    });

    Route::group(['prefix' => 'marketplace/pengajuanpendanaan'], function(){

      Route::get('/', 'PendanaanController@Anggota_index_Pengajuanpendanaan')->name('anggota.marketplace.pengajuanpendanaan.index');

      Route::post('/destroy', 'PendanaanController@Anggota_destroy_Pengajuanpendanaan')->name('anggota.marketplace.pengajuanpendanaan.destroy');

      Route::post('/detail', 'PendanaanController@Anggota_detail_Pengajuanpendanaan')->name('anggota.marketplace.pengajuanpendanaan.detail');

      Route::post('/buktihr', 'PendanaanController@Anggota_Buktihr')->name('anggota.marketplace.pengajuanpendanaan.buktihr');

      Route::post('/upload/bukti_hr', 'PendanaanController@Anggota_upload_Buktihr')->name('anggota.marketplace.pengajuanpendanaan.buktihr.upload');

      Route::get('/log', 'PendanaanController@Anggota_index_Log_AjuanPendanaan')->name('anggota.marketplace.log');

    });


    Route::group(['prefix' => 'peminjaman'], function(){

      Route::get('TanpaAngunan', 'PeminjamanController@indexPeminjaman')->name('anggota.peminjaman.TanpaAngunan.index');

      Route::post('TanpaAngunan', 'PeminjamanController@storeTanpa')->name('pages.anggota.peminjaman.TanpaAngunan.store');

      Route::get('AngunanSertifikat','PeminjamanController@indexSertifikat')->name('pages.anggota.peminjaman.AngunanSertifikat.index');

      Route::post('AngunanSertifikat', 'PeminjamanController@storeTanpaS')->name('pages.anggota.peminjaman.AngunanSertifikat.store');

      Route::get('AngunanBpkb', 'PeminjamanController@indexBpkb')->name('pages.anggota.peminjaman.AngunanBpkb.index');

      Route::post('AngunanBpkb', 'PeminjamanController@storeTanpaB')->name('pages.anggota.peminjaman.AngunanBpkb.store');

      Route::post('regPeminjaman', 'PeminjamanController@regPeminjaman')->name('anggota.peminjaman.regPeminjaman');

      Route::post('uploadPeminjaman', 'PeminjamanController@uploadPeminjaman')->name('anggota.peminjaman.uploadPeminjaman');

      Route::get('/log', 'PeminjamanController@Anggota_index_Log_AjuanPeminjaman')->name('anggota.Peminjaman.log');

      Route::post('detail', 'PeminjamanController@detailPeminjaman')->name('anggota.peminjaman.detailPeminjaman');
    });

  });

});


//REKANAN

Route::group(['middleware' => 'rekanan'], function(){

  Route::group(['prefix' => 'rekanan'], function(){

    Route::group(['prefix' => 'barang'], function(){

      Route::get('/', 'BarangController@index')->name('rekanan.barang.index');

      Route::post('store', 'BarangController@store')->name('rekanan.barang.store');

      Route::post('edit', 'BarangController@edit')->name('rekanan.barang.edit');

      Route::post('update', 'BarangController@update')->name('rekanan.barang.update');

      Route::post('detail', 'BarangController@detail')->name('rekanan.barang.detail');

      Route::post('destroy', 'BarangController@destroy')->name('rekanan.barang.destroy');

    });

    Route::group(['prefix' => 'marketplace/ajuanpendanaan'], function(){

      Route::get('/', 'PendanaanController@Rekanan_index_AjuanPendanaan')->name('rekanan.marketplace.ajuanPendanaan.index');

      Route::post('konfirmasi/form', 'PendanaanController@Rekanan_FormKonfirmasi')->name('rekanan.marketplace.form.konfirmasi');

      Route::post('konfirmasi', 'PendanaanController@Rekanan_Konfirmasi')->name('rekanan.marketplace.konfirmasi');

      Route::post('detail', 'PendanaanController@Rekanan_detail_AjuanPendanaan')->name('rekanan.marketplace.ajuanPendanaan.detail');

      Route::get('/log', 'PendanaanController@Rekanan_index_Log_AjuanPendanaan')->name('rekanan.marketplace.ajuanPendanaan.log.index');

    });

  });

});
