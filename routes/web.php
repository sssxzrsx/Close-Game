<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');
Route::get('/catalog', [ProductController::class, 'index'])->name('catalog');
Route::get('/catalog/{game}', [ProductController::class, 'show'])->name('catalog.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/admin/categories/{category}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');

    Route::post('/admin/games', [AdminController::class, 'storeGame'])->name('admin.games.store');
    Route::delete('/admin/games/{game}', [AdminController::class, 'deleteGame'])->name('admin.games.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{game}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

Route::view('/support', 'support')->name('support');
Route::post('/support/send', function (Request $request) {
    return back()->with('success', 'Ваше сообщение отправлено!');
})->name('support.send');

Route::middleware('auth')->group(function () {
    Route::get('/support', [SupportController::class, 'index'])->name('support');
    Route::post('/support/send', [SupportController::class, 'store'])->name('support.send');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/tickets', [SupportController::class, 'adminIndex'])->name('admin.tickets');
    Route::post('/admin/tickets/{ticket}/answer', [SupportController::class, 'answer'])->name('admin.tickets.answer');
});

Route::delete('/admin/tickets/{ticket}/delete', [SupportController::class, 'delete'])->name('admin.tickets.delete');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
});
