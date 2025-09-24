<?php

use App\Http\Controllers\ProfileController;
use App\Models\PosTenant;
use Illuminate\Support\Facades\Route;
use Spatie\Multitenancy\Models\Tenant;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/current-tenant', function () {
    dd('here');
})->middleware(['tenant']);

require __DIR__.'/auth.php';
