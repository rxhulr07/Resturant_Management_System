<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PlateController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;

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

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Plate Routes
Route::get('/plate', [PlateController::class, 'show'])->name('plate.show');
Route::post('/plate/add', [PlateController::class, 'addItem'])->name('plate.add-item');
Route::delete('/plate/remove/{item}', [PlateController::class, 'removeItem'])->name('plate.remove-item');
Route::patch('/plate/update-quantity/{item}', [PlateController::class, 'updateQuantity'])->name('plate.update-quantity');
Route::post('/plate/checkout', [PlateController::class, 'checkout'])->name('plate.checkout');
Route::get('/plate/confirmation/{orderNumber}', [PlateController::class, 'confirmation'])->name('plate.confirmation');
Route::get('/plate/track', [PlateController::class, 'trackOrder'])->name('plate.track');

// Admin Authentication Routes
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

// Protected Admin Routes
Route::prefix('admin')->middleware(['web', 'auth:admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Dishes Management
    Route::resource('dishes', DishController::class)->except(['show'])->names([
        'index' => 'admin.dishes.index',
        'create' => 'admin.dishes.create',
        'store' => 'admin.dishes.store',
        'edit' => 'admin.dishes.edit',
        'update' => 'admin.dishes.update',
        'destroy' => 'admin.dishes.destroy',
    ]);
    
    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});
