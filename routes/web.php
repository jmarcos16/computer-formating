<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\FormatationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoftwareController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        $user = \App\Models\User::factory()->create();
        auth()->login($user);
    }

    return view('welcome');
});

Route::post('/formatation/create', FormatationController::class)->name('formatation.create');

Route::controller(SoftwareController::class)->group(function () {
    Route::get('software', 'index')->name('software.index');
    Route::get('software/create', 'create')->name('software.create');
    Route::post('software/create', 'store')->name('software.store');
});

/** Routes for assignment */

Route::controller(AssignmentController::class)->group(function () {
    Route::get('assignment', 'index')->name('assignment.index');
    Route::get('assignment/create', 'create')->name('assignment.create');
    Route::post('assignment/create', 'store')->name('assignment.store');
    Route::get('assignment/edit/{assignment}', 'edit')->name('assignment.edit');
    Route::put('assignment/edit/{assignment}', 'update')->name('assignment.update');
    Route::delete('assignment/delete/{assignment}', 'destroy')->name('assignment.destroy');
});

Route::post('assignment/{assignment}/software', \App\Http\Controllers\Assignment\SoftwareStoreController::class)->name('assignment.software.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
