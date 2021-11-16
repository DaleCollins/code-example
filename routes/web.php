<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\ContractsController;

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
require __DIR__ . '/auth.php';
// Admin Pages
Route::middleware('auth')
     ->prefix('admin')
     ->group(function() {
         Route::view('/', 'admin.dashboard')->name('admin.dashboard');
         // Contracts
         Route::prefix('contracts')
              ->group(function() {
                  Route::get('/', [ContractsController::class, 'index'])->name('contracts.index');
                  Route::get('/create', [ContractsController::class, 'create'])->name('contracts.create');
                  Route::post('/', [ContractsController::class, 'store'])->name('contracts.store');
                  Route::get('/{contract}', [ContractsController::class, 'show'])->name('contracts.show');
                  Route::get('/{contract}/edit', [ContractsController::class, 'edit'])->name('contracts.edit');
                  Route::patch('/{contract}', [ContractsController::class, 'update'])->name('contracts.update');
                  Route::delete('/{contract}', [ContractsController::class, 'destroy'])->name('contracts.destroy');
              });
     });
// Frontend pages
Route::get('/{page?}', [PagesController::class, 'show'])->name('pages.show');


