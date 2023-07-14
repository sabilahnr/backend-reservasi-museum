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


    
    
    // Route::middleware(['auth:api'])->group(function () {
    //     Route::name('auth.')
    //     ->prefix('auth')
    //     ->group(function () {

    //         Route::get('me', [AuthController::class, 'me'])->name('me');
    //     });
    // });
    
    // Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me'])->name('me');
    Route::middleware('auth:sanctum')->group(function () {
        
        // Auth
        Route::get('me', [AuthController::class, 'me'])->name('auth.me');
        Route::post('/change-password', [AuthController::class, 'changePassword']);
        
        // Pengunjung  
        Route::put('/status', [ControllerTransaksi::class, 'status']);
        Route::put('/kehadiran', [ControllerTransaksi::class, 'kehadiran']);
        Route::get('/pengunjung', [ControllerTransaksi::class, 'show']);
        Route::get('/pemasukan', [ControllerTransaksi::class, 'show_pemasukan']);

        // About
        Route::put('/update_about/{id_about}',[AboutController::class, 'update']);

         // Museum
        Route::post('/add_museum', [MuseumController::class, 'store_museum']);
        Route::delete('/delete_museum/{id_museum}', [MuseumController::class, 'destroy']);
        Route::put('/update-museum/{id_museum}', [MuseumController::class, 'update']); 

        // Kategori
        Route::post('/add_kategori', [KategoriController::class, 'store']);
        Route::delete('/delete_kategori/{id_kategori}', [KategoriController::class, 'destroy']);
        Route::put('/update_kategori/{id_kategori}', [KategoriController::class, 'update']);
        // Route::put('/update-harga/{id_category}', [HargaController::class, 'update']);
        // Route::put('/hapus-harga/{id_category}', [HargaController::class, 'destroy']);
                
        // faq
        Route::post('/add_faq', [FAQController::class, 'store']);
        Route::put('/update_faq/{id_faq}', [FAQController::class, 'update']);
        Route::delete('/delete_faq/{id_faq}', [FAQController::class, 'destroy']);
        
        // admin
        Route::post('/add_admin', [AuthController::class, 'register']);
        Route::delete('/delete_admin/{id_admin}', [AuthController::class, 'destroy']);


        // Slider
        Route::post('/upload_slider', [SliderController::class, 'upload']);
        Route::delete('/delete-slider/{id}', [SliderController::class, 'destroy']);

        // Panduan
        Route::post('/files', [PanduanController::class, 'upload']);
        Route::put('/update_panduan_text', [PanduanController::class, 'update_panduan_text']);
        

        
        
        
    });

    // Auth
    Route::post('/login', [AuthController::class, 'login']); 

    // Pengunjung
    Route::post('/add-pengunjung', [ControllerTransaksi::class, 'store']);
    Route::get('show-ticket/{kode}', [ControllerTransaksi::class, 'show_ticket']);
    Route::post('/validasi-pengunjung', [ControllerTransaksi::class, 'validasi']);
    Route::get('/konfirmasi-pengunjung', [ControllerTransaksi::class, 'showKonfirmasi']);
    Route::get('/konfirmasi-', [ControllerTransaksi::class, 'showKonfirmasi']);
    Route::get('/status-pembayaran', [ControllerTransaksi::class, 'showStatus']);
    Route::get('/pengunjungExport', [ControllerTransaksi::class, 'pengunjungExport']);
    Route::get('/pemasukanExport', [ControllerTransaksi::class, 'pemasukanExport']);
    
    Route::post('/show_data/{id_category}', [ControllerTransaksi::class, 'show_data']);
    // About
    Route::get('/show_about/{id_museum}',[AboutController::class, 'show']);
    Route::get('/edit_about/{id_about}',[AboutController::class, 'edit_show']);
    Route::post('/show_gambar_museum/{museumId}', [GambarMuseumController::class, 'show']);
    Route::post('/upload_gambar_museum/{museumId}', [GambarMuseumController::class, 'upload']);
    Route::delete('/delete-image/{id}', [GambarMuseumController::class, 'destroy']);
    // Route::post('/add_about',[AboutController::class, 'store']);

    // Museum
    Route::get('/edit-museum/{id_museum}', [MuseumController::class, 'edit_show']);
    Route::get('/show_museum', [MuseumController::class, 'show']);
    // Route::post('/add_data', [MuseumController::class, 'store']);

    // Kategori
    Route::get('/show_kategori', [KategoriController::class, 'show_kategori']);
    Route::get('/edit_kategori/{id_kategori}', [KategoriController::class, 'edit_show']);
    Route::get('/show_category/{museumId}', [KategoriController::class, 'show']);
    
    // faq
    Route::get('/show_faq', [FAQController::class, 'show']);
    Route::get('/edit_faq/{id_faq}', [FAQController::class, 'edit_show']);

    // Slider
    Route::get('/show_slider', [SliderController::class, 'index']);
        
    // Panduan
    Route::get('/show_panduan', [PanduanController::class, 'index']);
    Route::get('/show_panduan/{id}', [PanduanController::class, 'index_panduan']);
    Route::get('/show_files', [PanduanController::class, 'index']);
    Route::delete('/delete_files/{id}', [PanduanController::class, 'destroy']);
    
    // Pembayaran
    Route::post('/transaksi_proses',[ControllerTransaksi::class, 'transaksi_proses']);
    Route::get('/metode',[ControllerTransaksi::class, 'metode']);
    Route::post('/callback',[ControllerTransaksi::class, 'callback']);
    Route::post('/callback_handle',[ControllerTransaksi::class, 'handle']);
    // Route::post('/callback',[ControllerTransaksi::class, 'callback']);

    Route::get('/show_admin', [AuthController::class, 'show_admin']);
    Route::put('/status_admin/{id_admin}', [AuthController::class, 'update_admin']);
    

    // Route::get('/edit-harga/{id_category}', [HargaController::class, 'edit_show']);
    // Route::get('/show_harga', [HargaController::class, 'show']);

    
    // Route::get('/show_files', [SliderController::class, 'index']);
    // Route::delete('/delete-data/{id_category}', [HargaController::class, 'destroy']);
    // Route::delete('/delete_about/{id_about}',[AboutController::class, 'destroy']);