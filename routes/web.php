<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\ForgotPasswordUserController;

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();
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


/* frontend routes */
Route::get('/', [SiteController::class, 'index']);
Route::post('/addbook', [SiteController::class,'addbook']);
Route::post('/deletebook', [SiteController::class,'deletebook']);
Route::post('/sortbook', [SiteController::class,'sortbook']);
Route::post('/sortuserbook', [SiteController::class,'sortuserbook']);
Route::get('/forgotpassword', [ForgotPasswordUserController::class,'showLinkRequestForm'])->name('forgotpassword');
Route::post('/send_link_forget_password', [ForgotPasswordUserController::class,'send_link_forget_password'])->name('send_link_forget_password');
Route::post('/submitforget', [ForgotPasswordUserController::class,'submitforget'])->name('submitforget');
Route::get('/passwordresetform/{token}', [ForgotPasswordUserController::class,'passwordresetform'])->name('passwordresetform');

/*Route::get('/', function () {
    return view('welcome');
});
*/