<?php

use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\HargaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MuseumController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\PengunjungController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanduanController;

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


Route::get('/show_admin', [AuthController::class, 'show_admin']);
Route::middleware(['auth:api'])->group(function () {
    Route::name('auth.')
        ->prefix('auth')
        ->group(function () {
            Route::get('me', [AuthController::class, 'me'])->name('me');
        });
});
Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me'])->name('me');

Route::post('/validasi-pengunjung', [PengunjungController::class, 'validasi']);
Route::post('/add-pengunjung', [PengunjungController::class, 'store']);
Route::get('/pengunjung', [PengunjungController::class, 'show']);
Route::get('/konfirmasi-pengunjung', [PengunjungController::class, 'showKonfirmasi']);
Route::get('/status-pembayaran', [PengunjungController::class, 'showStatus']);
Route::get('/pemasukan', [PengunjungController::class, 'show_pemasukan']);
Route::get('/pengunjungExport', [PengunjungController::class, 'pengunjungExport']);
Route::put('/kehadiran', [PengunjungController::class, 'kehadiran']);
Route::put('/status', [PengunjungController::class, 'status']);
Route::get('show-ticket/{kode}', [PengunjungController::class, 'show_ticket']);
Route::post('/show_data/{id_category}', [PengunjungController::class, 'show_data']);


Route::get('/show_museum', [MuseumController::class, 'show']);
Route::post('/add_data', [MuseumController::class, 'store']);
Route::post('/add_museum', [MuseumController::class, 'store_museum']);
Route::get('/edit-museum/{id_museum}', [MuseumController::class, 'edit_show']);
Route::delete('/delete_museum/{id_museum}', [MuseumController::class, 'destroy']);
Route::put('/update-museum/{id_museum}', [MuseumController::class, 'update']);

Route::get('/show_kategori', [KategoriController::class, 'show_kategori']);
Route::post('/add_kategori', [KategoriController::class, 'store']);
Route::delete('/delete_kategori/{id_kategori}', [KategoriController::class, 'destroy']);
Route::get('/edit_kategori/{id_kategori}', [KategoriController::class, 'edit_show']);
Route::put('/update_kategori/{id_kategori}', [KategoriController::class, 'update']);


Route::get('/show_category/{museumId}', [KategoriController::class, 'show']);

Route::get('/show_harga', [HargaController::class, 'show']);
Route::get('/edit-harga/{id_category}', [HargaController::class, 'edit_show']);
Route::put('/update-harga/{id_category}', [HargaController::class, 'update']);
Route::put('/hapus-harga/{id_category}', [HargaController::class, 'destroy']);
Route::delete('/delete-data/{id_category}', [HargaController::class, 'destroy']);

Route::post('/add_about',[AboutController::class, 'store']);
Route::get('/show_about/{id_museum}',[AboutController::class, 'show']);
Route::put('/update_about/{id_about}',[AboutController::class, 'update']);
Route::delete('/delete_about/{id_about}',[AboutController::class, 'destroy']);
Route::get('/edit_about/{id_about}',[AboutController::class, 'edit_show']);

Route::post('/add_faq', [FAQController::class, 'store']);
Route::get('/show_faq', [FAQController::class, 'show']);
Route::put('/update_faq/{id_faq}', [FAQController::class, 'update']);
Route::delete('/delete_faq/{id_faq}', [FAQController::class, 'destroy']);
Route::get('/edit_faq/{id_faq}', [FAQController::class, 'edit_show']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/add_admin', [AuthController::class, 'register']);
Route::delete('/delete_admin/{id_admin}', [AuthController::class, 'destroy']);

Route::get('/show_panduan', [PanduanController::class, 'index']);
Route::get('/show_files', [PanduanController::class, 'index']);
Route::post('/files', [PanduanController::class, 'upload']);
Route::delete('/delete-image/{id}', [PanduanController::class, 'destroy']);

// Route::get('/me',[AuthController::class, 'me']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
