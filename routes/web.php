<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MiscController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/misc', [MiscController::class, 'index'])->name('misc');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/items', [HomeController::class, 'items'])->name('items');
    Route::resource('item-data', ItemController::class);
});

Route::get('recfil', function (Request $r) {
    if ($r->urlreq==TRUE) {
        return Storage::url($r->rf);
    }
    return Storage::download($r->rf);
})->middleware('auth');

require __DIR__.'/auth.php';
