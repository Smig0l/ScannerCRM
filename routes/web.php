<?php

use App\Http\Controllers\ScansioniController;
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


Route::get('/', [ScansioniController::class, 'index'])->name('scansioni.index');
/* Route::post('/scansioni', [ScansioniController::class, 'store'])->name('scansioni.store'); */
Route::get('/scansioni/create', [ScansioniController::class, 'create'])->name('scansioni.create');
Route::get('/scansioni/export', [ScansioniController::class, 'export'])->name('scansioni.export');
/* Route::get('/scansioni/{id}', [ScansioniController::class, 'show'])->name('scansioni.show'); */
/* Route::patch('/scansioni/{id}', [ScansioniController::class, 'update'])->name('scansioni.update'); */
Route::get('/scansioni/{id}/edit', [ScansioniController::class, 'edit'])->name('scansioni.edit');
Route::delete('/scansioni/{id}', [ScansioniController::class, 'destroy'])->name('scansioni.destroy');