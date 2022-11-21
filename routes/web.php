<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\User\Create;
use App\Http\Livewire\User\Edit;
use App\Http\Livewire\User\Index;
use App\Http\Livewire\User\Show;
use Illuminate\Support\Facades\Route;

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


    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', Index::class)->name('index');
        // Route::get('{user}', Show::class)->name('show');
        Route::get('create', Create::class)->name('create');
        Route::get('{user}/edit', Edit::class)->name('edit');
    });
});

require __DIR__ . '/auth.php';
