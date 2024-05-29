<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ImageApiController;
use App\Http\Controllers\API\DataPerkaraController;
use App\Http\Controllers\API\BantuanHukumController;
use App\Http\Controllers\API\RegisterApiController;
use App\Http\Controllers\API\PengambilanBarangBuktiController;
use App\Http\Controllers\API\SuratKuasaApiController;
use App\Http\Livewire\ApiTokenManager;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('images', ImageApiController::class)->only(['index', 'store', 'update', 'destroy']);
Route::apiResource('dataperkara', DataPerkaraController::class)->only(['index', 'store','show', 'update', 'destroy']);
Route::apiResource('bantuan_hukum', BantuanHukumController::class);

Route::get('surat-kuasa', [SuratKuasaApiController::class, 'index']);
Route::post('surat-kuasa', [SuratKuasaApiController::class, 'store']);
Route::get('surat-kuasa/{id}', [SuratKuasaApiController::class, 'edit']);
Route::put('surat-kuasa/{id}', [SuratKuasaApiController::class, 'update']);

Route::prefix('v1')->group(function() {
    Route::get('pengambilan_barang_bukti', [PengambilanBarangBuktiController::class, 'index']);
    Route::post('pengambilan_barang_bukti/create/{barangBuktiId}', [PengambilanBarangBuktiController::class, 'create']);
    Route::post('pengambilan_barang_bukti/store/{barangBuktiId}', [PengambilanBarangBuktiController::class, 'store']);
    Route::get('pengambilan_barang_bukti/show/{id}', [PengambilanBarangBuktiController::class, 'show']);
    Route::get('pengambilan_barang_bukti/showSelesaiForm/{id}', [PengambilanBarangBuktiController::class, 'showSelesaiForm']);
    Route::post('pengambilan_barang_bukti/complete/{id}', [PengambilanBarangBuktiController::class, 'complete']);
    Route::get('wilayah_pengantar', [PengambilanBarangBuktiController::class, 'getWilayahPengantar']);
});

Route::resource('register-data', RegisterApiController::class);


// Route::resource('profiles', ProfileController::class);
