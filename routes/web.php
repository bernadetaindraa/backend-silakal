<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\{
    HomeController,
    BeritaController,
    AgendaController,
    AparaturController,
    BpkalAnggotaController,
    BpkalKegiatanController,
    KebudayaanController,
    PotensiProdukController,
    ProdukHukumController,
    PertanyaanSurveyController,
    SurveyController,
    PengaduanController,
    LayananController,
    ProfileController
};

use App\Http\Controllers\Admin\{
    DashboardAdminController,
    BeritaController as AdminBeritaController,
    AgendaController as AdminAgendaController,
    AparaturController as AdminAparaturController,
    ProdukHukumController as AdminProdukHukumController,
    PotensiProdukController as AdminPotensiProdukController,
    KebudayaanController as AdminKebudayaanController,
    DusunController as AdminDusunController,
    PengaduanController as AdminPengaduanController,
    SurveyController as AdminSurveyController,
    UserController as AdminUserController,
    LaporanController,
};

use App\Http\Controllers\Dukuh\{
    DashboardDukuhController,
    LayananController as DukuhLayananController,
    WargaController as DukuhWargaController,
};

use App\Http\Controllers\Pelayanan\{
    DashboardPelayananController,
    LayananController as PelayananLayananController,
};

/********************
 * =========================
 * WEB ROUTES
 * =========================
 ********************/

/* PUBLIC */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/profil/sejarah', 'public.profil.sejarah')->name('sejarah');
Route::view('/profil/visi-misi', 'public.profil.visi-misi')->name('visi-misi');

/* AUTH */
Route::controller(AuthController::class)->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::get('/register', 'showRegister')->name('register');

    Route::post('/login', 'login')->name('login.post');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// /* GOOGLE AUTH */
// Route::controller(GoogleAuthController::class)->group(function () {
//     Route::get('/auth/google', 'redirect')->name('google.login');
//     Route::get('/auth/google/callback', 'callback');
// });

/* BERITA */
Route::prefix('berita')->controller(BeritaController::class)->group(function () {
    Route::get('/', 'index')->name('berita');
    Route::get('/all', 'semua')->name('berita.semua');
    Route::get('/{id}', 'show')->name('berita.show');
});

/* AGENDA */
Route::prefix('agenda')->controller(AgendaController::class)->group(function () {
    Route::get('/', 'index')->name('agenda');
    Route::get('/{id}', 'show')->name('agenda.show');
});

/* APARATUR */
Route::prefix('aparatur')->controller(AparaturController::class)->group(function () {
    Route::get('/', 'index')->name('aparatur.index');
    Route::get('/{id}', 'show')->name('aparatur.show');
});

/* BPKAL */
Route::prefix('bpkal')->group(function () {
    Route::get('/anggota', [BpkalAnggotaController::class, 'anggota'])->name('bpkal.anggota');
    Route::get('/anggota/{id}', [BpkalAnggotaController::class, 'detailAnggota'])->name('bpkal.anggota.show');

    Route::get('/kegiatan', [BpkalKegiatanController::class, 'kegiatan'])->name('bpkal.kegiatan');
});

/* PRODUK HUKUM */
Route::prefix('produk-hukum')->controller(ProdukHukumController::class)->group(function () {
    Route::get('/{kategori}', 'index')->name('produk-hukum.index');
    Route::get('/detail/{id}', 'show')->name('produk-hukum.show');
});

/* POTENSI PRODUK */
Route::prefix('potensi-produk')->controller(PotensiProdukController::class)->group(function () {
    Route::get('/{kategori?}', 'index')->name('potensi-produk.index');
    Route::get('/detail/{id}', 'show')->name('potensi-produk.show');
});

/* KEBUDAYAAN */
Route::prefix('kebudayaan')->controller(KebudayaanController::class)->group(function () {
    Route::get('/benda', 'benda')->name('kebudayaan.benda');
    Route::get('/non-benda', 'nonBenda')->name('kebudayaan.non-benda');
    Route::get('/jenis/{jenis}', 'index')->name('kebudayaan.jenis');
    Route::get('/detail/{id}', 'show')->name('kebudayaan.show');
});

/* SURVEY IKM */
Route::prefix('survey-ikm')->controller(SurveyController::class)->group(function () {
    Route::get('/', 'index')->name('survey-ikm');
    Route::get('/hasil', 'hasil')->name('survey-ikm.hasil');
    Route::post('/store', 'store')->name('survey-ikm.store');
});

/* PENGADUAN */
Route::prefix('pengaduan')->controller(PengaduanController::class)->group(function () {
    Route::get('/', 'index')->name('pengaduan');
    Route::get('/create', 'create')->name('pengaduan.create');
    Route::post('/store', 'store')->name('pengaduan.store');
    Route::get('/{id}', 'show')->name('pengaduan.show');
    Route::get('/laporan', 'laporan')->name('pengaduan.laporan');
});

/* LAYANAN PUBLIK */
Route::controller(LayananController::class)->group(function () {
    Route::get('/layanan/panduan', 'panduan')->name('layanan.panduan');
    // Rute tracking publik dihapus dari sini karena wajib login
});

/* USER LOGIN */
Route::middleware('auth')->group(function () {

    Route::prefix('user')->name('user.')->group(function () {
        Route::view('/dashboard', 'user.dashboard')->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        
        Route::prefix('layanan')->controller(LayananController::class)->name('layanan.')->group(function () {
            Route::get('/', 'index')->name('pengajuan');
            Route::post('/store', 'store')->name('store');
            Route::get('/riwayat', 'riwayat')->name('riwayat');
            Route::get('/tracking/{nomor?}', 'tracking')->name('tracking');
            Route::get('/{id}/download', 'download')->name('download');
            Route::get('/{id}', 'show')->name('show');
            });
    });

    /* ADMIN */
     Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

        Route::prefix('berita')->controller(AdminBeritaController::class)->name('berita.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/update', 'update')->name('update');
            Route::patch('/{id}/toggle-status', 'toggleStatus')->name('toggle-status');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
            Route::get('/trashed', 'trashed')->name('trashed');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::delete('/force-delete/{id}', 'forceDelete')->name('force-delete');        
        });

        /*
        |--------------------------------------------------------------------------
        | AGENDA
        |--------------------------------------------------------------------------
        */
        Route::prefix('agenda')->controller(AdminAgendaController::class)->name('agenda.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');

            Route::get('/trashed', 'trashed')->name('trashed');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::delete('/force-delete/{id}', 'forceDelete')->name('force-delete');
        });

        /*
        |--------------------------------------------------------------------------
        | APARATUR
        |--------------------------------------------------------------------------
        */

        Route::prefix('aparatur')->controller(AparaturController::class)->name('aparatur.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');

            Route::get('/trashed', 'trashed')->name('trashed');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::delete('/force-delete/{id}', 'forceDelete')->name('force-delete');
        });

        /*
        |--------------------------------------------------------------------------
        | POTENSI PRODUK
        |--------------------------------------------------------------------------
        */
        Route::prefix('potensi-produk')->controller(AdminPotensiProdukController::class)->name('potensi-produk.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');

            Route::get('/trashed', 'trashed')->name('trashed');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::delete('/force-delete/{id}', 'forceDelete')->name('force-delete');
         });
         
        /*
        |--------------------------------------------------------------------------
        | PRODUK HUKUM
        |--------------------------------------------------------------------------
        */
        Route::prefix('produk-hukum')->controller(AdminProdukHukumController::class)->name('produk-hukum.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');

            Route::get('/trashed', 'trashed')->name('trashed');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::delete('/force-delete/{id}', 'forceDelete')->name('force-delete');
        });

        /*
        |--------------------------------------------------------------------------
        | DATA KEBUDAYAAN
        |--------------------------------------------------------------------------
        */
        Route::prefix('kebudayaan')->controller(AdminKebudayaanController::class)->name('kebudayaan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
        });

        /*
        |--------------------------------------------------------------------------
        | PENGADUAN
        |--------------------------------------------------------------------------
        */
        Route::prefix('pengaduan')->controller(AdminPengaduanController::class)->name('pengaduan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');
            Route::patch('/update-status/{id}', 'updateStatus')->name('update-status');
            Route::put('/proses/{id}', 'proses')->name('proses');
            Route::put('/selesai/{id}', 'selesai')->name('selesai');
        });

        /*
        |--------------------------------------------------------------------------
        | SURVEY IKM
        |--------------------------------------------------------------------------
        */
        Route::prefix('survey')->controller(AdminSurveyController::class)->name('survey.')->group(function () {
            Route::get('/periode', 'periode')->name('periode.index');
            Route::post('/periode/buka', 'bukaPeriode')->name('periode.buka');
            Route::put('/periode/update/{id}', 'updatePeriode')->name('periode.update');
            Route::put('periode/update-status/{id}', 'updateStatusPeriode')->name('periode.update-status');
            Route::get('/', 'hasil')->name('index');
            Route::get('/hasil/{id}', 'show')->name('show');
        });

        Route::prefix('users')->controller(AdminUserController::class)->name('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'destroy')->name('destroy');

            Route::get('/trashed', 'trashed')->name('trashed');
            Route::post('/restore/{id}', 'restore')->name('restore');
            Route::delete('/force-delete/{id}', 'forceDelete')->name('force-delete');
        });

        Route::prefix('profile')->controller(DashboardAdminController::class)->name('profile.')->group(function () {
            Route::get('/', 'profile')->name('index');
        });

        // KOMENTAR
        Route::resource('komentar', App\Http\Controllers\Admin\KomentarController::class)->only(['index', 'destroy']);

        Route::prefix('laporan')->controller(LaporanController::class)->name('laporan.')->group(function () {
            Route::get('/', 'index')->name('index');
            
            Route::get('/pengaduan', 'pengaduan')->name('pengaduan');
            Route::get('/pengaduan/pdf', 'pengaduanPdf')->name('pengaduan.pdf');
            Route::get('/pengaduan/excel', 'pengaduanExcel')->name('pengaduan.excel');
            
            Route::get('/survey', 'survey')->name('survey');
            Route::get('/survey/pdf', 'surveyPdf')->name('survey.pdf');
            Route::get('/survey/excel', 'surveyExcel')->name('survey.excel');
            
            Route::get('/layanan', 'layanan')->name('layanan');
            Route::get('/layanan/pdf', 'layananPdf')->name('layanan.pdf');
            Route::get('/layanan/excel', 'layananExcel')->name('layanan.excel');
                        
            Route::get('/potensi-produk', 'potensiProduk')->name('potensi-produk');
            Route::get('/potensi-produk/pdf','potensiProdukPdf')->name('potensi-produk.pdf');
            Route::get('/potensi-produk/excel','potensiProdukExcel')->name('potensi-produk.excel');

            Route::get('/kebudayaan', 'budaya')->name('kebudayaan');
            Route::get('/kebudayaan/pdf', 'budayaPdf')->name('budaya.pdf');
            Route::get('/kebudayaan/excel', 'budayaExcel')->name('budaya.excel');
        });

        // SETTING
        // Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    });

    /*
    |--------------------------------------------------------------------------
    | PELAYANAN
    |--------------------------------------------------------------------------
    */

    Route::prefix('pelayanan')->name('pelayanan.')->group(function () {
        Route::get('/dashboard', [DashboardPelayananController::class, 'index'])->name('dashboard');
       
        Route::prefix('layanan')->name('layanan.')->controller(PelayananLayananController::class)->group(function () {

            Route::get('/', 'index')->name('index');

            // HARUS DI ATAS
            Route::get('/riwayat', 'riwayat')->name('riwayat');
            Route::patch('/{id}/restore', 'restore')->name('restore');

            Route::get('/{id}/pembuatan-surat', 'pembuatanSurat')->name('pembuatan-surat');
            Route::post('/{id}/generate', 'generateSurat')->name('generate');
            Route::post('/{id}/upload-surat', 'uploadSurat')->name('upload-surat');

            Route::patch('/{id}/proses', 'proses')->name('proses');
            Route::patch('/{id}/tolak', 'tolak')->name('tolak');
            Route::patch('/{id}/selesai', 'selesai')->name('selesai');

            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::get('/{id}', 'show')->name('show');
        });
        
    });

    /*
    |--------------------------------------------------------------------------
    | DUKUH
    |--------------------------------------------------------------------------
    */
    Route::prefix('dukuh')->name('dukuh.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardDukuhController::class, 'index'])->name('dashboard');
        
        // Layanan (Verifikasi)
        Route::prefix('layanan')->controller(DukuhLayananController::class)->name('layanan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::post('/verifikasi/{id}', 'verifikasi')->name('verifikasi');
        });

        Route::prefix('warga')->controller(DukuhWargaController::class)->name('warga.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('{id}', 'show')->name('show');
        });
    });
});

use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function () {

    Mail::raw('Tes email SILAKAL berhasil.', function ($message) {
        $message->to('indrabernadet@gmail.com')
                ->subject('Tes Email SILAKAL');
    });

    return 'Email berhasil dikirim';
});