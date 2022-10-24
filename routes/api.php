<?php

use App\Http\Controllers\API\HargaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MuseumController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\PengunjungController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;

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

Route::post('/validasi-pengunjung',[PengunjungController::class, 'validasi']);
Route::post('/add-pengunjung',[PengunjungController::class, 'store']);
Route::get('/pengunjung',[PengunjungController::class, 'show']);
Route::get('/konfirmasi-pengunjung',[PengunjungController::class, 'showKonfirmasi']);

Route::get('/show_museum',[MuseumController::class, 'show']);
Route::get('/show_category/{museumId}',[KategoriController::class, 'show']);
Route::post('/show_data/{id_category}',[PengunjungController::class, 'show_data']);
Route::get('/show_harga',[HargaController::class, 'show']);
Route::get('/edit-harga/{id_category}',[HargaController::class, 'edit_show']);
Route::put('/update-harga/{id_category}',[HargaController::class, 'update']);
Route::put('/hapus-harga/{id_category}',[HargaController::class, 'destroy']);

Route::get('/show_faq',[FAQController::class, 'show']);
Route::get('/edit_faq/{id_faq}',[FAQController::class, 'edit_show']);
Route::put('/update_faq/{id_faq}',[FAQController::class, 'update']);
Route::post('/add_faq',[FAQController::class, 'store']);
Route::delete('/delete_faq/{id_faq}',[FAQController::class, 'destroy']);

Route::post('/login',[AuthController::class, 'login']);

// Route::get('/me',[AuthController::class, 'me']);
Route::middleware(['auth:api'])->group(function () {
    Route::name('auth.')
        ->prefix('auth')
        ->group(function () {
            Route::get('me', [AuthController::class, 'me'])->name('me');
        });
    });
    
    Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me'])->name('me');
    
 Route::put('/kehadiran',[PengunjungController::class, 'kehadiran']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
