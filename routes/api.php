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
    use App\Http\Controllers\ControllerTransaksi;
use App\Http\Controllers\GambarMuseumController;
use App\Http\Controllers\PanduanController;
    use App\Http\Controllers\SliderController;
    use App\Http\Controllers\transaksi;
use App\Models\GambarMuseum;

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
    
    // Route::middleware(['auth:api'])->group(function () {
    //     Route::name('auth.')
    //     ->prefix('auth')
    //     ->group(function () {

    //         Route::get('me', [AuthController::class, 'me'])->name('me');
    //     });
    // });
    
    // Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me'])->name('me');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('auth.me');
        Route::get('pengunjung', [PengunjungController::class, 'show']);
        
        Route::put('/status', [PengunjungController::class, 'status']);
        Route::put('/kehadiran', [PengunjungController::class, 'kehadiran']);
        
        
        Route::post('/add_admin', [AuthController::class, 'register']);
        Route::delete('/delete_admin/{id_admin}', [AuthController::class, 'destroy']);
        
        Route::put('/update-harga/{id_category}', [HargaController::class, 'update']);
        Route::post('/add_kategori', [KategoriController::class, 'store']);
        Route::put('/hapus-harga/{id_category}', [HargaController::class, 'destroy']);
        Route::delete('/delete_kategori/{id_kategori}', [KategoriController::class, 'destroy']);
        Route::put('/update_kategori/{id_kategori}', [KategoriController::class, 'update']);
        
        Route::post('/upload_slider', [SliderController::class, 'upload']);
        Route::delete('/delete-slider/{id}', [SliderController::class, 'destroy']);
        
        Route::post('/add_museum', [MuseumController::class, 'store_museum']);
        Route::delete('/delete_museum/{id_museum}', [MuseumController::class, 'destroy']);
        Route::put('/update-museum/{id_museum}', [MuseumController::class, 'update']);
        
        Route::put('/update_about/{id_about}',[AboutController::class, 'update']);
        
        Route::post('/add_faq', [FAQController::class, 'store']);
        Route::put('/update_faq/{id_faq}', [FAQController::class, 'update']);
        Route::delete('/delete_faq/{id_faq}', [FAQController::class, 'destroy']);
        
        Route::post('/files', [PanduanController::class, 'upload']);
        
        Route::put('/update_panduan_text', [PanduanController::class, 'update_panduan_text']);
        Route::get('/pengunjung', [PengunjungController::class, 'show']);
        Route::get('/pemasukan', [PengunjungController::class, 'show_pemasukan']);
        
        
    });

    Route::post('/show_data/{id_category}', [PengunjungController::class, 'show_data']);
    Route::post('/add-pengunjung', [PengunjungController::class, 'store']);
    Route::post('/upload_gambar_museum/{museumId}', [GambarMuseumController::class, 'upload']);
    Route::post('/show_gambar_museum/{museumId}', [GambarMuseumController::class, 'show']);
    Route::delete('/delete-image/{id}', [GambarMuseumController::class, 'destroy']);



    Route::post('/validasi-pengunjung', [PengunjungController::class, 'validasi']);
    Route::get('/konfirmasi-pengunjung', [PengunjungController::class, 'showKonfirmasi']);
    Route::get('/status-pembayaran', [PengunjungController::class, 'showStatus']);
    Route::get('/pengunjungExport', [PengunjungController::class, 'pengunjungExport']);
    Route::get('show-ticket/{kode}', [PengunjungController::class, 'show_ticket']);


    Route::get('/show_museum', [MuseumController::class, 'show']);
    Route::post('/add_data', [MuseumController::class, 'store']);
    Route::get('/edit-museum/{id_museum}', [MuseumController::class, 'edit_show']);

    Route::get('/show_kategori', [KategoriController::class, 'show_kategori']);
    Route::get('/edit_kategori/{id_kategori}', [KategoriController::class, 'edit_show']);
    Route::get('/show_category/{museumId}', [KategoriController::class, 'show']);

    Route::post('/add_about',[AboutController::class, 'store']);
    Route::get('/show_about/{id_museum}',[AboutController::class, 'show']);
    Route::get('/edit_about/{id_about}',[AboutController::class, 'edit_show']);
    
    Route::get('/show_faq', [FAQController::class, 'show']);
    Route::get('/edit_faq/{id_faq}', [FAQController::class, 'edit_show']);
    
    Route::post('/login', [AuthController::class, 'login']); 
    
    Route::get('/show_panduan', [PanduanController::class, 'index']);
    
    Route::get('/show_panduan/{id}', [PanduanController::class, 'index_panduan']);
    Route::get('/show_files', [PanduanController::class, 'index']);
    
    Route::get('/show_slider', [SliderController::class, 'index']);
    
    Route::post('/callback',[ControllerTransaksi::class, 'callback']);
    Route::post('/transaksi_proses',[ControllerTransaksi::class, 'transaksi_proses']);
    Route::get('/metode',[ControllerTransaksi::class, 'metode']);
    
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/callback',[ControllerTransaksi::class, 'callback']);
    Route::post('/transaksi_proses',[ControllerTransaksi::class, 'transaksi_proses']);
    Route::get('/metode',[ControllerTransaksi::class, 'metode']);
    

    Route::get('/edit-harga/{id_category}', [HargaController::class, 'edit_show']);
    Route::get('/show_harga', [HargaController::class, 'show']);

    
    // Route::get('/show_files', [SliderController::class, 'index']);
    // Route::delete('/delete-data/{id_category}', [HargaController::class, 'destroy']);
    // Route::delete('/delete_about/{id_about}',[AboutController::class, 'destroy']);