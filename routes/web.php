<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\FormatationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if(app()->isLocal()){
        $user = \App\Models\User::factory()->create();
        auth()->login($user);
    }

    return view('welcome');
});


Route::post('/formatation/create', FormatationController::class)->name('formatation.create');

Route::get('assignment/create', [AssignmentController::class, 'create'])->name('assignment.create');
Route::post('assignment/create', [AssignmentController::class, 'store'])->name('assignment.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

