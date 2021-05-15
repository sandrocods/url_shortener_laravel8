<?php

use App\Http\Controllers\ShortUrl;
use App\Http\Controllers\userController;
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

 // Route Search
Route::get('/short/search', [ShortUrl::class, 'Search'])->name('search.data');
// Auth Route
Auth::routes();

// Route Function Crud Admin
Route::middleware(['auth'])->group(function () {

    Route::resource('/short', ShortUrl::class)->parameters([
        'short/{id}/edit' => 'short.edit',
        'short/{id}/delete' => 'short.destroy',
        'short/{id}/show' => 'short.show',
    ]);

});

// Route Home page Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Index Short Route
Route::get('/', function () {
    return view('body');
});

// Route Shorten Url
Route::resource('/short', ShortUrl::class)->parameters([
    'short' => 'create.store',
    'short' => 'index',
    'short/create' => 'short.create',

]);

// Route User Management
Route::resource('/user', userController::class)->parameters([
    'edit' => 'user.edit',
    'user/{id}/update' => 'user.update',
]);

// Route Get Shorten Url
Route::get('/{id}', [ShortUrl::class, 'GetUrl']);