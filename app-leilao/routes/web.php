<?php

use App\Http\Controllers\AnnoucementsController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BackEndController;
use App\Http\Controllers\EmailController;
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

Route::get('/listar-produtos', function (){
    return view('frontend.listagem-principal');
}); //exemplo de tela incial


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

    //Update de Anuncios
    Route::get('/announcements/{id}/edit', [AnnoucementsController::class, 'edit'])->name('announcements.edit');
    Route::put('/announcements/{id}', [AnnoucementsController::class, 'update'])->name('announcements.update');
    //delete de anuncios
    Route::delete('/announcements/{id}', [AnnoucementsController::class,'destroy'])->name('announcements.destroy');

    //deletar imagem pelo Modal em Editar
    Route::delete('/images/{id}', [ImagesController::class, 'destroy'])->name('images.destroy');

    //ativar venda por leilao
    Route::post('/auction/store', [AuctionController::class, 'store'])->name('auction.store');

    /**
     * Tela de Leilao online
    */
    Route::get('/leilao-online/{auctionId}', [AuctionController::class,'showAuction']);

});

Auth::routes();

