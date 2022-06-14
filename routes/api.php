<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;

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
// Route::get('/kelas/{idkelas}',[KelasController::class,'getDataKelasById']);
Route::post('/guru',[KelasController::class,'insertDataGuru'])->middleware('auth:api');
Route::get('/guru',[KelasController::class,'getDataGuru'])->middleware('auth:api');
Route::put('/guru',[KelasController::class,'updateDataGuru'])->middleware('auth:api');
Route::delete('/guru',[KelasController::class,'deleteDataGuru'])->middleware('auth:api');


Route::get('/mapel',[KelasController::class,'getDataMapel'])->middleware('auth:api');
Route::post('/mapel',[KelasController::class,'insertDataMapel'])->middleware('auth:api');
Route::put('/mapel',[KelasController::class,'updateDataMapel'])->middleware('auth:api');
Route::delete('/mapel',[KelasController::class,'deleteDataMapel'])->middleware('auth:api');


Route::get('/kelas',[KelasController::class,'getDataKelas'])->middleware('auth:api');
Route::post('/kelas',[KelasController::class,'insertDataKelas'])->middleware('auth:api');
Route::put('/kelas',[KelasController::class,'updateDataKelas'])->middleware('auth:api');
Route::delete('/kelas',[KelasController::class,'deleteDataKelas'])->middleware('auth:api');


Route::get('/jadwal_guru',[KelasController::class,'getDataJadwalGuru'])->middleware('auth:api');
Route::post('/jadwal_guru',[KelasController::class,'insertDataJadwalGuru'])->middleware('auth:api');
Route::put('/jadwal_guru',[KelasController::class,'updateDataJadwalGuru'])->middleware('auth:api');
Route::delete('/jadwal_guru',[KelasController::class,'deleteDataJadwalGuru'])->middleware('auth:api');
Route::get('/jadwal_guru',[KelasController::class,'getDataJadwalGuru'])->middleware('auth:api');
Route::post('/jadwal_guru',[KelasController::class,'insertDataJadwalGuru'])->middleware('auth:api');
Route::put('/jadwal_guru',[KelasController::class,'updateDataJadwalGuru'])->middleware('auth:api');
Route::delete('/jadwal_guru',[KelasController::class,'deleteDataJadwalGuru'])->middleware('auth:api');


Route::get('/presensi_harian',[KelasController::class,'getDataPresensiHarian'])->middleware('auth:api');
Route::post('/presensi_harian',[KelasController::class,'insertDataPresensiHarian'])->middleware('auth:api');
Route::put('/presensi_harian',[KelasController::class,'updateDataPresensiHarian'])->middleware('auth:api');
Route::delete('/presensi_harian',[KelasController::class,'deleteDataPresensiHarian'])->middleware('auth:api');


Route::get('/presensi_mengajar',[KelasController::class,'getDataPresensiMengajar'])->middleware('auth:api');
Route::post('/presensi_mengajar',[KelasController::class,'insertDataPresensiMengajar'])->middleware('auth:api');
Route::put('/presensi_mengajar',[KelasController::class,'updateDataPresensiMengajar'])->middleware('auth:api');
Route::delete('/presensi_mengajar',[KelasController::class,'deleteDataPresensiMengajar'])->middleware('auth:api');

// Route::get('/gurukelas',[KelasController::class,'getDataGuruKelas']);

