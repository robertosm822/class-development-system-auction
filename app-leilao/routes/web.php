<?php

use App\Http\Controllers\BackEndController;
use App\Http\Controllers\FrontEndController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[FrontEndController::class,'index']);

Route::get('/registrar-se', [FrontEndController::class, 'create'])->name('registrar-se');
Route::post('/register-user',[FrontEndController::class, 'storeUser'])->name('register-user');

Route::prefix('admin')->namespace('Admin')->middleware(['auth'])->group(function () { 
    
    Route::get('/',[ BackEndController::class,'index'])->name('admin');
    Route::get('/perfil',[ BackEndController::class,'profile'])->name('perfil');
    Route::post('/update-address', [BackEndController::class, 'profileUpdateAddress'])->name('updateAddress');

    Route::post('/update-phone/{id}', [BackEndController::class, 'updatePhone'])->name('update-phone');
});

Auth::routes();

