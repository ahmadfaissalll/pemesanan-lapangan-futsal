<?php

use App\Models\{Lapangan, Penyewaan};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Print\Lapangan\PrintController as LapanganPrintController;
use App\Http\Controllers\Print\Penyewaan\PrintController as PenyewaanPrintController;
use App\Http\Controllers\Customer\{NotificationController, BookingController, HomeController, LapanganController as CustomerLapanganController, PenyewaanController as CustomerPenyewaanController};
use App\Http\Controllers\Admin\{LapanganController as AdminLapanganController, PenyewaanController as AdminPenyewaanController};

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

// Route::redirect('/', '/dashboard/lapangan');
// get single lapangan
Route::get('/getLapangan/{lapangan}', function (Lapangan $lapangan) {
  return $lapangan;
});


// CUSTOMER

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lapangan', [CustomerLapanganController::class, 'index']);

Route::middleware(['auth', 'can:is_customer'])->group(function () {
  Route::resource('/notification', NotificationController::class)->only(['index', 'destroy']);

  // booking lapangan
  Route::controller(BookingController::class)->group(function () {
    Route::get('/booking', 'create');
    Route::post('/booking', 'store');
  });


  Route::get('/penyewaan', [CustomerPenyewaanController::class, 'index']);
});

// END OF CUSTOMER


// ADMIN

Route::middleware(['auth', 'can:is_admin'])->group(function () {

  Route::get('/dashboard', function () {
    return view('dashboard.home');
  });
  
  
  Route::prefix('dashboard')->group(function () {

    Route::get('/lapangan/print', LapanganPrintController::class);
    Route::get('/penyewaan/print', PenyewaanPrintController::class);

    Route::resources([
      'lapangan' => AdminLapanganController::class,
      'penyewaan' => AdminPenyewaanController::class
    ]);
  });

  Route::post('/penyewaan/accept/{penyewaan}', [AdminPenyewaanController::class, 'acceptBooking']);
  Route::post('/penyewaan/reject/{penyewaan}', [AdminPenyewaanController::class, 'rejectBooking']);
});


// admin
Route::controller(AdminController::class)->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('/register-admin', 'create');
    Route::post('/register-admin', 'store');

    Route::get('/login-admin', 'index')->name('login-admin');
    Route::post('/login-admin', 'authenticate');
  });
  // 'can:is_admin'
  Route::middleware(['auth', 'can:is_admin'])->group(function () {
    Route::post('/logout-admin', 'logout');
  });
});


// customer
Route::controller(CustomerController::class)->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('/register', 'register');
    Route::post('/register', 'postRegister');

    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'postLogin');
  });

  Route::middleware('auth')->group(function () {
    Route::post('/logout', 'logout');
  });
});
