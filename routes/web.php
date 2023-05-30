<?php

use App\Http\Controllers\Assignment\SoftwareStoreController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\FormatationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SoftwareController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        $user = User::factory()->create();
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

Route::get('/assignment', [AssignmentController::class, 'index'])->name('assignment.index');
Route::get('/assignment/create', [AssignmentController::class, 'create'])->name('assignment.create');
Route::post('/assignment/create', [AssignmentController::class, 'store'])->name('assignment.store');
Route::get('/assignment/{assignment}', [AssignmentController::class, 'show'])->name('assignment.show');
Route::get('/assignment/edit/{assignment}', [AssignmentController::class, 'edit'])->name('assignment.edit');
Route::put('/assignment/edit/{assignment}', [AssignmentController::class, 'update'])->name('assignment.update');
Route::delete('/assignment/delete/{assignment}', [AssignmentController::class, 'destroy'])->name('assignment.destroy');
Route::post('/assignment/software/{assignment}', SoftwareStoreController::class)->name('assignment.software.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
