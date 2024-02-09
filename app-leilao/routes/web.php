<?php

use App\Http\Controllers\AnnoucementsController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ImagesController;
use Illuminate\Support\Facades\Route;
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
    Route::put('/update-password', [BackEndController::class, 'updatePassword'])->name('update-password');

    /**
     * Cadastro de produtos
    */
    Route::get('/cadastrar-produto', [AnnoucementsController::class, 'create'])->name('cadastrar-produto');
    Route::get('/list-products', [AnnoucementsController::class, 'addForm'])->name('list.products');
    Route::post('/upload-files', [ImagesController::class, 'store'])->name('upload.files');
});

Auth::routes();

