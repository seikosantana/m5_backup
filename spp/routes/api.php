<?php

use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\SiswaController;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::resource('siswas', SiswaController::class);

Route::group(['prefix' => 'pembayarans'], function () {
    Route::get('/{id_siswa}/history', [PembayaranController::class, 'show']);
    Route::get('/{id_siswa}/terakhir', [PembayaranController::class, 'terakhir']);
    Route::post('/', [PembayaranController::class, 'store']);
});
// Route::get('hello',function(){
//     return "hello";
// });
Route::prefix('siswaext')->group(function () {
    Route::get('/cari/semuatahun', [SiswaController::class, 'tahun']);
    Route::get('/cari/semuakelas', [SiswaController::class, 'semuaKelas']);
    Route::get('/cari/semuatingkat', [SiswaController::class, 'semuaTingkat']);
    Route::get('/{tahun}/{nis}', [SiswaController::class, 'ambilSiswa']);
    Route::get('/cari/{tahun}/{katakunci}', [SiswaController::class, 'cari']);
});

Route::post("/upload", [SiswaController::class, 'uploadCsv']);

Route::prefix('pembayaranext')->group(function () {
    Route::get('laporan/kelas/{tahun}/{kelas}/{periode}', [PembayaranController::class, 'laporanKelas']);
    Route::get('laporan/tingkat/{tahun}/{tingkat}/{periode}', [PembayaranController::class, 'laporanTingkat']);
    Route::get('laporan/tunggakan/{tahun}/{periode}', [PembayaranController::class, 'nunggak']);
    Route::get('laporan/tunggakan/{tahun}/{periode}/kelas/{kelas}', [PembayaranController::class, 'nunggakKelas']);
    Route::get('laporan/lunas/{tahun}/{periode}/kelas/{kelas}', [PembayaranController::class, 'lunasKelas']);
    Route::get('laporan/tunggakan/{tahun}/{periode}/tingkat/{tingkat}', [PembayaranController::class, 'nunggakTingkat']);
    Route::get('laporan/lunas/{tahun}/{periode}/tingkat/{tingkat}', [PembayaranController::class, 'lunasTingkat']);
    Route::get("/export", [PembayaranController::class, 'export']);
});

// Route::group(['prefix' => 'siswas'], function () {
// });
