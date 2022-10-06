<?php

use App\Http\Controllers\API\PengunjungController;
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

Route::post('/validasi-pengunjung',[PengunjungController::class, 'validasi']);
Route::post('/add-pengunjung',[PengunjungController::class, 'store']);
Route::get('/pengunjung',[PengunjungController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
