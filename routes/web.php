<?php

use App\Http\Controllers\AnakController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\NaikBerkalaController;
use App\Http\Controllers\NaikPangkatController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/download', [App\Http\Controllers\HomeController::class, 'download'])->name('download');
Route::get('/', [LandingPageController::class, 'show']);

Auth::routes();

//Login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Setting AKun
Route::get('/settings', [App\Http\Controllers\PegawaiController::class, 'changePassword'])->name('setting');
Route::put('/change/{id}', [App\Http\Controllers\PegawaiController::class, 'updatePassword'])->name('update.pass');

//ADMIN
Route::group(['prefix' => 'Admin', 'middleware' => ['auth','role:Admin']], function(){
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('naik-berkala', NaikBerkalaController::class);
    Route::resource('gaji', GajiController::class);
    Route::resource('pangkat', PangkatController::class);

    //landing page crud
    Route::get('/landing-pages', [LandingPageController::class, 'list']);
    Route::get('/landing-page/{id}', [LandingPageController::class, 'form']);
    Route::post('/landing-page/{id}', [LandingPageController::class, 'save']);
    Route::post('/landing-page-delete', [LandingPageController::class, 'delete']);

    Route::get('show-riwayat-pendidikan/{id}', [PegawaiController::class, 'showRiwayatPend'])->name('show.pendidikan');
    //cetak Daftar PNS
    Route::get('print-pns', [PegawaiController::class, 'printPDF'])->name('print.pns');

    //route Data Kenaikan Pangkat :
    Route::get('/menu-kenaikan-pangkat', [NaikPangkatController::class, 'naikPangkatMenuAdmin'])->name('data.naikPangkat');
    //Jabatan Reguler Eselon Struktural
    Route::get('/index-struktural', [NaikPangkatController::class, 'AdminStruktural'])->name('index.struktural');
    Route::get('/approval-struktural/{kenaikan_id}', [NaikPangkatController::class, 'approvalStruktural'])->name('approval.struktural');
    Route::post('/approval-struktural/{kenaikan_id}', [NaikPangkatController::class, 'saveApprovalStruktural']);
    //Jabatan  Pelaksana Staf
    Route::get('/index-pelasana-staf', [NaikPangkatController::class, 'AdminPS'])->name('index.ps');
    Route::get('/approval-pelasana-staf/{kenaikan_id}', [NaikPangkatController::class, 'approvalPS'])->name('approval.ps');
    Route::post('/approval-pelasana-staf/{kenaikan_id}', [NaikPangkatController::class, 'saveApprovalPS']);

    //Jabatan  Pelaksana Staf Penyesuaian Ijazah
    Route::get('/index-pelasana-staf-ijazah', [NaikPangkatController::class, 'AdminPSI'])->name('index.psi');
    Route::get('/approval-pelasana-staf-ijazah/{kenaikan_id}', [NaikPangkatController::class, 'approvalPSI'])->name('approval.psi');
    Route::post('/approval-pelasana-staf-ijazah/{kenaikan_id}', [NaikPangkatController::class, 'saveApprovalPSI']);
    //Jabatan Fungsional Tertentu
    Route::get('/index-fungsional', [NaikPangkatController::class, 'AdminFT'])->name('index.ft');
    Route::get('/approval-fungsional/{kenaikan_id}', [NaikPangkatController::class, 'approvalFT'])->name('approval.ft');
    Route::post('/approval-fungsional/{kenaikan_id}', [NaikPangkatController::class, 'saveApprovalFT']);

    //route Data Kenaikan Gaji Berkala :
    Route::get('/index.berkala', [NaikBerkalaController::class, 'indexAdmin'])->name('berkala.admin');
    Route::get('/approval-berkala/{kenaikan_id}', [NaikBerkalaController::class, 'approvalAdmin'])->name('approval.berkala.admin');
    Route::post('/approval-berkala/{kenaikan_id}', [NaikBerkalaController::class, 'saveApprovalAdmin'])->name('saveapproval.berkala.admin');

});

//PNS(PEGAWAI)
Route::group(['prefix' => 'PNS', 'middleware' => ['auth','role:Pegawai|Admin']], function(){
    //-- Halaman profile Pegawai--//
    Route::get('profile-pegawai', [PegawaiController::class, 'showPegawai'])->name('show.pegawai');
    Route::put('/pegawai/{id}', [App\Http\Controllers\PegawaiController::class, 'updateData'])->name('update.pegawai');
    Route::post('/foto/{id}', [App\Http\Controllers\PegawaiController::class, 'uploadFoto'])->name('update.foto');
    Route::put('/kepegawaian/{id}', [App\Http\Controllers\PegawaiController::class, 'updateKepegawaian'])->name('update.kepegawaian');
    Route::put('/sutri/{id}', [App\Http\Controllers\PegawaiController::class, 'updateSI'])->name('update.sutri');
    //Data Anak :
    Route::get('/anak-tambah', [App\Http\Controllers\PegawaiController::class, 'createAnak'])->name('anak.tambah');
    Route::post('/anak-simpan', [App\Http\Controllers\PegawaiController::class, 'anakCreate'])->name('anak.store');
    Route::get('/anak/{id}/edit', [App\Http\Controllers\PegawaiController::class, 'editAnak'])->name('anak.edit');
    Route::put('/anak/{id}', [App\Http\Controllers\PegawaiController::class, 'updateAnak'])->name('anak.update');
    //Data Riwayat Pendidikan
    Route::get('/riwayat-pendidikan', [PegawaiController::class, 'menuPendidikan'])->name('riwayat.pend');
    Route::get('/tambah-riwayat-pendidikan', [PegawaiController::class, 'createPendidikan'])->name('tambah.pend');
    Route::post('/simpan-riwayat-pendidikan', [App\Http\Controllers\PegawaiController::class, 'storePendidikan'])->name('pend.store');
    Route::get('/pendidikan/{id}/edit', [App\Http\Controllers\PegawaiController::class, 'editPendidikan'])->name('pendidikan.edit');
    Route::put('/pendidikan/{id}', [App\Http\Controllers\PegawaiController::class, 'updatePendidikan'])->name('pendidikan.update');
    Route::delete('/pendidikan/{id}', [App\Http\Controllers\PegawaiController::class, 'hapusPendidikan'])->name('pendidikan.hapus');
    //Route Data Diklat :
    Route::get('/tambah-diklat', [PegawaiController::class, 'tambahDiklat'])->name('tambah.diklat');
    Route::post('/simpan-diklat', [PegawaiController::class, 'storeDiklat'])->name('simpan.diklat');


    //Route Kenaikan Gaji Berkala :
    Route::get('/index-naik-berkala', [NaikBerkalaController::class, 'indexPegawai'])->name('index.berkala');
    Route::get('/tambah-naik-berkala/{kenaikan_id}', [NaikBerkalaController::class, 'createNaikBerkala'])->name('tambah.berkala');
    Route::post('/naik-berkala-simpan/{kenaikan_id}', [App\Http\Controllers\NaikBerkalaController::class, 'simpanData'])->name('simpan.berkala');
    Route::delete('/delete-usulan-gaji', [App\Http\Controllers\NaikBerkalaController::class, 'deleteData'])->name('delete.berkala');

    //Route Kenaikan Pangkat
    Route::get('/menu-naik-pangkat', [NaikPangkatController::class, 'naikPangkatMenu'])->name('menu.naik.pangkat');
    //Reguler Eselon Struktural
    Route::get('/menu-naik-struktural', [NaikPangkatController::class, 'pangkatStrutural'])->name('menu.pangkat.struktural');
    Route::get('/tambah-naik-struktural/{kenaikan_id}', [NaikPangkatController::class, 'formStruktural'])->name('tambah.pangkat.struktural');
    Route::post('/simpan-naik-struktural/{kenaikan_id}', [NaikPangkatController::class, 'storeStruktrural'])->name('simpan.pangkat.struktural');
    Route::delete('/delete-usulan-kenaikan', [NaikPangkatController::class, 'deleteUsulanKenaikan']);

    //Pelaksana Staf
    Route::get('/menu-naik-Pelaksana-staf', [NaikPangkatController::class, 'pangkatPelaksanaStaf'])->name('menu.pangkat.pestaf');
    Route::get('/tambah-naik-Pelaksana-staf/{kenaikan_id}', [NaikPangkatController::class, 'formPelaksanaStaf'])->name('tambah.pangkat.pestaf');
    Route::post('/simpan-naik-Pelaksana-staf/{kenaikan_id}', [NaikPangkatController::class, 'simpanPelaksanaStaf'])->name('simpan.pangkat.pestaf');

    //Pelaksana Staf Penyesuaian Ijazah
    Route::get('/menu-naik-Pelaksana-staf-penyesuaian', [NaikPangkatController::class, 'pangkatPeStafijazah'])->name('menu.pangkat.pestafijazah');
    Route::get('/tambah-naik-Pelaksana-staf-penyesuaian/{kenaikan_id}', [NaikPangkatController::class, 'formPSI'])->name('tambah.pangkat.psi');
    Route::post('/tambah-naik-Pelaksana-staf-penyesuaian/{kenaikan_id}', [NaikPangkatController::class, 'simpanPSI'])->name('simpan.pangkat.psi');

    //Fungsional Tertentu
    Route::get('/menu-naik-Pelaksana-fungsional-tertentu', [NaikPangkatController::class, 'naikPangkatFt'])->name('menu.pangkat.ft');
    Route::get('/tambah-naik-Pelaksana-fungsional-tertentu/{kenaikan_id}', [NaikPangkatController::class, 'formFt'])->name('tambah.pangkat.ft');
    Route::post('/tambah-naik-Pelaksana-fungsional-tertentu/{kenaikan_id}', [NaikPangkatController::class, 'insertOrUpdateFt'])->name('simpan.pangkat.ft');

    //Ambil Data Padaringan
    Route::get('/fetchPadaringan', [PegawaiController::class, 'fetchPadaringan'])->name('get.padaringan');
});


