<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiVerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API routes requiring authentication
Route::middleware('auth:sanctum')->group(function () {
    
});

Route::get('ibu-hamil', [App\Http\Controllers\api\ApiController::class, 'apiIbuHamil']);
    Route::get('anak', [App\Http\Controllers\api\ApiController::class, 'apiAnak']);
    Route::get('imunisasi', [App\Http\Controllers\api\ApiController::class, 'apiImunisasi']);
    Route::get('nifas', [App\Http\Controllers\api\ApiController::class, 'apiNifas']);
    Route::get('artikel', [App\Http\Controllers\api\ApiController::class, 'apiArtikel']);
    Route::get('catatan-kesehatan', [App\Http\Controllers\api\ApiController::class, 'apiKesehatan']);
    Route::get('bidan', [App\Http\Controllers\api\ApiController::class, 'apiBidan']);
    Route::get('layanan-kb', [App\Http\Controllers\api\ApiController::class, 'apiKb']);
    Route::put('update-profile', [App\Http\Controllers\api\ApiController::class, 'updateProfileImage']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

// Authentication routes for API
Route::post('register', [App\Http\Controllers\api\ApiController::class, 'registerIbu']);
Route::post('login', [App\Http\Controllers\api\ApiController::class, 'loginIbu']);
