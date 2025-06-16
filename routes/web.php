<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyPaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AdminFooterController;


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



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/booking', [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');


Route::get('/dummy-payment', [DummyPaymentController::class, 'form'])->name('dummy-payment.form');
Route::post('/dummy-payment', [DummyPaymentController::class, 'process'])->name('dummy-payment.process');

Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('posts', [App\Http\Controllers\PageController::class, 'posts'])->name('posts');
Route::get('posts/{post:slug}', [App\Http\Controllers\PageController::class, 'detailPost'])->name('posts.show');
Route::get('paket-travel', [App\Http\Controllers\PageController::class, 'package'])->name('package');
Route::get('detail/{travelPackage}', [App\Http\Controllers\PageController::class, 'detail'])->name('detail');

Route::get('/about-us', [PageController::class, 'about'])->name('about');

Route::get('/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/auth/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/auth/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('kontak-kami', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('kontak-kami', [App\Http\Controllers\PageController::class, 'getEmail'])->name('contact.email');

Route::group(['middleware' => 'auth'], function() {

    Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
        Route::resource('cars', \App\Http\Controllers\Admin\CarController::class);
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('travel-packages', \App\Http\Controllers\Admin\TravelPackageController::class);
        Route::resource('travel-packages.galleries', \App\Http\Controllers\Admin\GalleryController::class);
        Route::get('/users', [App\Http\Controllers\Admin\AdminBookingController::class, 'userList'])->name('admin.user.index');
        Route::get('/users/{user}/bookings', [AdminBookingController::class, 'userBookings'])->name('admin.user.booking');
 Route::get('footer/edit', [App\Http\Controllers\Admin\AdminFooterController::class, 'index'])->name('footer.edit');
    Route::put('footer/update', [App\Http\Controllers\Admin\AdminFooterController::class, 'update'])->name('admin.footer.update');
  
    Route::resource('team', TeamController::class);
    });

    
});
Route::get('/our-team', [App\Http\Controllers\TeamController::class, 'index'])->name('our-team');
// Verifikasi pembayaran
Route::post('/bookings/{id}/update-status', [BookingController::class, 'updatePaymentStatus'])->name('bookings.updateStatus');
Route::post('/payment/update-status', [DummyPaymentController::class, 'updateStatus']);

Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings');
Route::post('/booking/{id}', [BookingController::class, 'storeBooking'])->name('booking.store');

Route::get('/booking/success/{id}', [BookingController::class, 'bookingSuccess'])->name('booking.success');

Route::get('/cek-booking', [BookingController::class, 'showCheckBookingForm'])->name('booking.form');
Route::post('/cek-booking', [BookingController::class, 'checkBooking'])->name('booking.check');

Route::post('/midtrans/notification', [BookingController::class, 'midtransNotification'])->name('midtrans.notification');
Route::get('/payment/form', [DummyPaymentController::class, 'form'])->name('payment.form');
Route::post('/payment/process', [DummyPaymentController::class, 'process'])->name('payment.process');