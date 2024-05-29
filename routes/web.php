<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ApiTokenManager;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelayananHukumController;
use App\Http\Controllers\KelolaPelayananHukumController;
use App\Http\Controllers\BantuanHukumController;
use App\Http\Controllers\PendampinganHukumController;
use App\Http\Controllers\PendapatHukumController;
use App\Http\Controllers\AuditHukumController;
use App\Http\Controllers\KelolaBantuanHukumController;
use App\Http\Controllers\KelolaPertimbanganHukumController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\KebijakanPrivasiController;
use App\Http\Controllers\DataPerkaraController;
use App\Http\Controllers\BarangBuktiController;
use App\Http\Controllers\PengambilanBarangBuktiController;
use App\Http\Controllers\SuratKuasaController;



use App\Http\Controllers\ApiTokenController;

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

Route::get('/', function () {
    return redirect()->route('login');
});



// Rute untuk menampilkan form registrasi Masyarakat
Route::get('/register/masyarakat', [RegisterController::class, 'showRegistrationFormMasyarakat'])->name('register.masyarakat');

// Rute untuk mendaftarkan Masyarakat
Route::post('/register/masyarakat', [RegisterController::class, 'register_masyarakat']);

// Rute untuk menampilkan form registrasi Admin
Route::get('/register/admin', [RegisterController::class, 'showRegistrationFormAdmin'])->name('register.admin');

// Rute untuk mendaftarkan Admin
Route::post('/register/admin', [RegisterController::class, 'register_admin']);

// Route untuk menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route untuk mengirimkan data login dan melakukan autentikasi
// Route::post('/login', [LoginController::class, 'login']);
// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/privacy', [KebijakanPrivasiController::class, 'index_show'])->name('kebijakan_privasis.show');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
    Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::put('/profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::delete('/profiles/{profile}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

    Route::get('/educations', [EducationController::class, 'index'])->name('educations.index');
    Route::get('/educations/create', [EducationController::class, 'create'])->name('educations.create');
    Route::post('/educations', [EducationController::class, 'store'])->name('educations.store');
    Route::get('/educations/{education}/edit', [EducationController::class, 'edit'])->name('educations.edit');
    Route::put('/educations/{education}', [EducationController::class, 'update'])->name('educations.update');
    Route::delete('/educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');


    Route::get('/admin/pelayanan-hukum', [KelolaPelayananHukumController::class, 'index'])->name('kelola_pelayanan_hukum.index');


    Route::get('/admin/bantuan-hukum', [KelolaBantuanHukumController::class, 'index'])->name('kelola_bantuan_hukum.index');
    Route::delete('/admin/bantuan-hukum/{bantuanHukum}', [KelolaBantuanHukumController::class, 'destroy'])->name('kelola_bantuan_hukum.destroy');

    Route::get('/admin/pendampingan_hukum', [KelolaPertimbanganHukumController::class, 'index_phukum'])->name('kelola_pendampingan_hukum.index');
    Route::delete('/admin/pendampingan_hukum/{pendampinganHukum}', [KelolaPertimbanganHukumController::class, 'destroy_phukum'])->name('kelola_pendampingan_hukum.destroy');


    Route::get('/admin/pendapat_hukum', [KelolaPertimbanganHukumController::class, 'index_pthukum'])->name('kelola_pendapat_hukum.index');
    Route::delete('/admin/pendapat_hukum/{pendampatHukum}', [KelolaPertimbanganHukumController::class, 'destroy_pthukum'])->name('kelola_pendapat_hukum.destroy');

    Route::get('/admin/audit_hukum', [KelolaPertimbanganHukumController::class, 'index_ahukum'])->name('kelola_audit_hukum.index');
    Route::delete('/admin/audit_hukum/{auditHukum}', [KelolaPertimbanganHukumController::class, 'destroy_ahukum'])->name('kelola_audit_hukum.destroy');


    Route::get('/admin/images', [ImageController::class, 'index'])->name('image.index');
    Route::get('/admin/images/create', [ImageController::class, 'create'])->name('image.create');
    Route::post('/admin/images', [ImageController::class, 'store'])->name('image.store');
    Route::get('/admin/images/{image}/edit', [ImageController::class, 'edit'])->name('image.edit');
    Route::put('/admin/images/{image}', [ImageController::class, 'update'])->name('image.update');
    Route::delete('/admin/images/{image}', [ImageController::class, 'destroy'])->name('image.destroy');


    // Route::resource('kebijakan_privasis', KebijakanPrivasiController::class);

    Route::get('/admin/kebijakan_privasi', [KebijakanPrivasiController::class, 'index'])->name('kebijakan_privasis.index');
    Route::get('/admin/kebijakan_privasi/create', [KebijakanPrivasiController::class, 'create'])->name('kebijakan_privasis.create');
    Route::post('/admin/kebijakan_privasi', [KebijakanPrivasiController::class, 'store'])->name('kebijakan_privasis.store');
    Route::get('/admin/kebijakan_privasi/{kebijakanPrivasi}/edit', [KebijakanPrivasiController::class, 'edit'])->name('kebijakan_privasis.edit');
    Route::put('/admin/kebijakan_privasi/{kebijakanPrivasi}', [KebijakanPrivasiController::class, 'update'])->name('kebijakan_privasis.update');
    Route::delete('/admin/kebijakan_privasi/{kebijakanPrivasi}', [KebijakanPrivasiController::class, 'destroy'])->name('kebijakan_privasis.destroy');

    // data perkara
    Route::get('/admin/data_perkara', [DataPerkaraController::class, 'index'])->name('data-perkaras.index');
    Route::get('/admin/data_perkara/create', [DataPerkaraController::class, 'create'])->name('data-perkaras.create');
    Route::post('/admin/data_perkara', [DataPerkaraController::class,'store'])->name('data-perkaras.store');
    Route::get('/admin/data-perkara/{id}/edit', [DataPerkaraController::class, 'edit'])->name('data-perkaras.edit');
    Route::put('/admin/data-perkaras/{id}/update-data-perkara', [DataPerkaraController::class, 'updateDataPerkara'])->name('data-perkaras.update-data-perkara');
    Route::put('/admin/data-perkara/{id}', [DataPerkaraController::class, 'update'])->name('data-perkaras.update');
    Route::get('/admin/data-perkaras/{id}', [DataPerkaraController::class, 'show'])->name('data-perkaras.show');

    Route::delete('/admin/data-perkara/{id}', [DataPerkaraController::class, 'destroy'])->name('data-perkaras.destroy');
    // barang bukti
    Route::get('/admin/data-perkaras/{dataPerkara}/barang-bukti/create', [BarangBuktiController::class, 'create'])->name('barang-bukti.create');
    Route::post('/admin/data-perkaras/{dataPerkara}/barang-bukti', [BarangBuktiController::class, 'store'])->name('barang-bukti.store');
    Route::get('/admin/barang-bukti/{id}/edit', [BarangBuktiController::class, 'edit'])->name('barang-bukti.edit');
    Route::put('/admin/barang-bukti/{id}', [BarangBuktiController::class, 'updateBarangBukti'])->name('barang-bukti.update');

// pengambilan barang bukti
Route::get('/admin/barang-bukti/{barangBukti}/pengambilan', [PengambilanBarangBuktiController::class, 'create'])->name('pengambilan-barang-bukti.create');
Route::post('/admin/barang-bukti/{barangBukti}/pengambilan', [PengambilanBarangBuktiController::class, 'store'])->name('pengambilan-barang-bukti.store');
Route::get('/admin/permohonan-pengambilan/{id}', [PengambilanBarangBuktiController::class, 'show'])->name('permohonan-pengambilan.show');

Route::get('/admin/barang-bukti/{id}/selesai', [PengambilanBarangBuktiController::class, 'showSelesaiForm'])->name('selesai-pengambilan.show');
Route::post('/admin/barang-bukti/{id}/selesai', [PengambilanBarangBuktiController::class, 'complete'])->name('selesai-pengambilan.complete');

Route::get('/admin/barang-bukti/download/berita-acara/{id}', [PengambilanBarangBuktiController::class, 'downloadBeritaAcara'])->name('download.berita_acara');
Route::get('/admin/barang-bukti/download/dokumentasi/{id}', [PengambilanBarangBuktiController::class, 'downloadDokumentasi'])->name('download.dokumentasi');

Route::get('/admin/surat_kuasa', [SuratKuasaController::class, 'index'])->name('surat_kuasa.index');
Route::get('/admin/surat_kuasa/create', [SuratKuasaController::class, 'create'])->name('surat_kuasa.create');
Route::post('/admin/surat_kuasa/store', [SuratKuasaController::class, 'store'])->name('surat_kuasa.store');
Route::get('/admin/surat_kuasa/{id}/edit', [SuratKuasaController::class, 'edit'])->name('surat_kuasa.edit');
Route::put('/admin/surat_kuasa/{id}', [SuratKuasaController::class, 'update'])->name('surat_kuasa.update');



    Route::get('/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');

});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'masyarakat', // Menambahkan middleware admin
])->group(function () {
    // Definisi rute-rute dalam grup ini

    Route::get('/beranda', function () {
        return view('beranda');
    })->name('beranda');


    Route::get('/pelayanan_hukum', [PelayananHukumController::class, 'index'])->name('pelayanan_hukum.index');
    Route::get('/pelayanan_hukum/create', [PelayananHukumController::class, 'create'])->name('pelayanan_hukum.create');
    Route::post('/pelayanan_hukum', [PelayananHukumController::class, 'store'])->name('pelayanan_hukum.store');

    Route::get('/pelayanan_hukum/{pelayananHukum}/edit', [PelayananHukumController::class, 'edit'])->name('pelayanan_hukum.edit');
    Route::put('/pelayanan_hukum/{pelayananHukum}', [PelayananHukumController::class, 'update'])->name('pelayanan_hukum.update');
    Route::delete('/pelayanan_hukum/{pelayananHukum}', [PelayananHukumController::class, 'destroy'])->name('pelayanan_hukum.destroy');

    Route::get('/bantuan_hukum', [BantuanHukumController::class, 'index'])->name('bantuan_hukum.index');
    Route::get('/bantuan_hukum/create', [BantuanHukumController::class, 'create'])->name('bantuan_hukum.create');
    Route::post('/bantuan_hukum', [BantuanHukumController::class, 'store'])->name('bantuan_hukum.store');
    Route::get('/bantuan_hukum/{bantuanHukum}/edit', [BantuanHukumController::class, 'edit'])->name('bantuan_hukum.edit');
    Route::put('/bantuan_hukum/{bantuanHukum}', [BantuanHukumController::class, 'update'])->name('bantuan_hukum.update');
    Route::delete('/bantuan_hukum/{bantuanHukum}', [BantuanHukumController::class, 'destroy'])->name('bantuan_hukum.destroy');

    Route::get('/pendampingan_hukum', [PendampinganHukumController::class, 'index'])->name('pendampingan_hukum.index');
    Route::get('/pendampingan_hukum/create', [PendampinganHukumController::class, 'create'])->name('pendampingan_hukum.create');
    Route::post('/pendampingan_hukum', [PendampinganHukumController::class, 'store'])->name('pendampingan_hukum.store');
    Route::get('/pendampingan_hukum/{pendampinganHukum}/edit', [PendampinganHukumController::class, 'edit'])->name('pendampingan_hukum.edit');
    Route::put('/pendampingan_hukum/{pendampinganHukum}', [PendampinganHukumController::class, 'update'])->name('pendampingan_hukum.update');
    Route::delete('/pendampingan_hukum/{pendampinganHukum}', [PendampinganHukumController::class, 'destroy'])->name('pendampingan_hukum.destroy');

    Route::get('/pendapat_hukum', [PendapatHukumController::class, 'index'])->name('pendapat_hukum.index');
    Route::get('/pendapat_hukum/create', [PendapatHukumController::class, 'create'])->name('pendapat_hukum.create');
    Route::post('/pendapat_hukum', [PendapatHukumController::class, 'store'])->name('pendapat_hukum.store');
    Route::get('/pendapat_hukum/{pendapatHukum}/edit', [PendapatHukumController::class, 'edit'])->name('pendapat_hukum.edit');
    Route::put('/pendapat_hukum/{pendapatHukum}', [PendapatHukumController::class, 'update'])->name('pendapat_hukum.update');
    Route::delete('/pendapat_hukum/{pendapatHukum}', [PendapatHukumController::class, 'destroy'])->name('pendapat_hukum.destroy');

    Route::get('/audit_hukum', [AuditHukumController::class, 'index'])->name('audit_hukum.index');
    Route::get('/audit_hukum/create', [AuditHukumController::class, 'create'])->name('audit_hukum.create');
    Route::post('/audit_hukum', [AuditHukumController::class, 'store'])->name('audit_hukum.store');
    Route::get('/audit_hukum/{auditHukum}/edit', [AuditHukumController::class, 'edit'])->name('audit_hukum.edit');
    Route::put('/audit_hukum/{auditHukum}', [AuditHukumController::class, 'update'])->name('audit_hukum.update');
    Route::delete('/audit_hukum/{auditHukum}', [AuditHukumController::class, 'destroy'])->name('audit_hukum.destroy');


});
