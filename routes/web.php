<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController as PropertyController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\HomeController;

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

// Partie Publique
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [PropertyController::class, 'index'])->name('property.index');
Route::get('/biens/{slug}-{property}', [PropertyController::class, 'show'])->name('property.show')->where([
    'property' => $idRegex,
    'slug' => $slugRegex
]);
Route::post('/biens/{property}/contact', [PropertyController::class, 'contact'])->name('property.contact')->where([
    'property' => $idRegex
]);

//Login à la partie admin
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/images/{path}', [\App\Http\Controllers\ImageController::class, 'show'])->where('path', '.*');

//Partie Admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(callback: function() use ($idRegex) {
   Route::resource('property', AdminPropertyController::class)->except('show');
   Route::delete('property/delete/{property}', [AdminPropertyController::class, 'forcedelete'])->name('property.delete')->where([
       'property' => $idRegex
   ]);
   Route::post('property/restore/{property}', [AdminPropertyController::class, 'restore'])->name('property.restore')->where([
       'property' => $idRegex
   ]);
   Route::resource('option', \App\Http\Controllers\Admin\OptionController::class)->except(['show']);
   Route::delete('image/{image}', [ImageController::class, 'destroy'])->name('image.destroy')->where([
       'image' => $idRegex,
   ]);
});
