<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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

Route::get('locale/{locale}', function ($locale){
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('supplier-classification', Front\Suppliers\SupplierClassificationController::class);
    Route::resource('suppliers', Front\Suppliers\SupplierController::class);
    Route::get('/{page}', 'AdminController@index');
});


