<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\StocksController;
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

Route::get('/', function () {
    return view('web');
});

Route::middleware('auth')->group(function () {
  Route::get('/approval', [ApprovalController::class, 'approval'])->name('approval');

  Route::middleware('approved')->group(function () {
    Route::get('/admin', function () { return view('admin');})->name('admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/partners', [PartnersController::class, 'index'])->name('partner.index');
    Route::get('/partners/add', [PartnersController::class, 'create'])->name('partner.add');
    Route::post('/partners/add', [PartnersController::class, 'store'])->name('partner.store');
    Route::get('/partners/{id}', [PartnersController::class, 'show'])->name('partner.show');
    Route::get('/partners/{id}/edit', [PartnersController::class, 'edit'])->name('partner.edit');
    Route::put('/partners/{id}/edit', [PartnersController::class, 'update'])->name('partner.update');
    Route::delete('/partners/delete/{id}', [PartnersController::class, 'destroy'])->name('partner.delete');

    Route::get('/finances/cashflow', [CashflowController::class, 'index'])->name('cashflow.index');
    Route::post('/finances/add', [CashflowController::class, 'store'])->name('cashflow.add');
    Route::get('/finances/edit/{id}', [CashflowController::class, 'show'])->name('cashflow.show');
    Route::put('/finances/edit/{id}', [CashflowController::class, 'edit'])->name('cashflow.edit');
    Route::delete('finances/delete/{id}', [CashflowController::class, 'destroy'])->name('cashflow.delete');

    Route::get('/stocks', [StocksController::class, 'index'])->name('stock.index');
    Route::post('/stocks/add', [StocksController::class, 'store'])->name('stock.add');
    Route::get('/stocks/{id}', [StocksController::class, 'show'])->name('stock.show');
    Route::get('/stocks/{id}/edit', [StocksController::class, 'edit'])->name('stock.edit');
    Route::put('/stocks/{id}/edit', [StocksController::class, 'update'])->name('stock.update');
    Route::delete('/stocks/{id}', [StocksController::class, 'destroy'])->name('stock.delete');

    Route::middleware('admin')->group(function () {
      Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
      Route::post('/users/add', [UsersController::class, 'store'])->name('admin.users.add');
      Route::get('/users/{user_id}/approve', [UsersController::class, 'approve'])->name('admin.users.approve');
    });
  });
});

require __DIR__.'/auth.php';
