<?php

use App\Http\Controllers\AnnoucementsController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\EmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Endpoint para listar todos os bids ou filtrar pelo ID
Route::get('/bids/{id?}', [BidController::class, 'index']);

// Endpoint para criar um bid
Route::post('/bids', [BidController::class, 'store']);

// Endpoint para editar informações de um bid
Route::put('/bids/{id}', [BidController::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//teste de envio de email
Route::post('/send-email', [EmailController::class, 'send']);

Route::middleware('auth.basic')->group(function () {

    Route::get('/announcements', [AnnoucementsController::class, 'index']);

        // Endpoint para listar todos os bids ou filtrar pelo ID
    Route::get('/bids/{id?}', [BidController::class, 'index']);

    // Endpoint para criar um bid
    Route::post('/bids', [BidController::class, 'store']);

    // Endpoint para editar informações de um bid
    Route::put('/bids/{id}', [BidController::class, 'update']);

    // PROTECTED ROUTES
    Route::get('/user-test', function(Request $request){
        return ['access' => base64_encode(json_encode([
            '_token' => "cm9iZXJ0b0BnbWFpbC5jb206TXVkYXIxMjMh",
            'now' => date('Y-m-d H:i:s')
        ]))];
    });


});
