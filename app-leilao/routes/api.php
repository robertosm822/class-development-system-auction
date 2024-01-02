<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.basic')->group(function (): void {
    // PROTECTED ROUTES
    Route::get('/user-test', function(Request $request){
        return ['access' => base64_encode(json_encode([
            '_token' => "cm9iZXJ0b0BnbWFpbC5jb206TXVkYXIxMjMh",
            'now' => date('Y-m-d H:i:s')
        ]))];
    });
});
