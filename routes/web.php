<?php

use App\Http\Controllers\AdoptionAdController;
use App\Http\Controllers\AdoptionInterestController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\BreedController;
use App\Http\Controllers\CreateBreedController;
use App\Http\Controllers\DoctorAppointmentController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MapMarkerController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PetHealthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UserController;
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

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () { return view('dashboard'); })->name('dashboard');
    Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

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
    Route::get('/create/{breed_type}', [CreateBreedController::class, 'create'])->name('breedCategory.create');
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

    /*
    |--------------------------------------------------------------------------
    | Statistics Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('/statistics', StatisticsController::class);

    /*
    |--------------------------------------------------------------------------
    | MedicalRecords Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('/medical-records', MedicalRecordController::class);

    /*
    |--------------------------------------------------------------------------
    | Appointments Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('/appointments', DoctorAppointmentController::class);

    /*
    |--------------------------------------------------------------------------
    | Analytics Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('/analytics', AnalyticsController::class);

    /*
    |--------------------------------------------------------------------------
    | Analytics Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('/petHeath', PetHealthController::class);

    /*
    |--------------------------------------------------------------------------
    | Map Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('/report-map', MapMarkerController::class);
    Route::post('/save-location', [MapMarkerController::class, 'store'])->name('save.location');
});
