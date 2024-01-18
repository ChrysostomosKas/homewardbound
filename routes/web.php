<?php

use App\Http\Controllers\AdoptionAdController;
use App\Http\Controllers\AdoptionInterestController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Livewire\BreedFormComponent;
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

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
    /*
    |--------------------------------------------------------------------------
    | Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Breed Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('breeds', BreedController::class);
    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | AdoptionAds Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('adoption-ads', AdoptionAdController::class);

    /*
    |--------------------------------------------------------------------------
    | AdoptionInterests Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('adoption-interests', AdoptionInterestController::class);
});
