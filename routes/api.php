<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
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

Route::post('dev', [ApiController::class, 'store']);
Route::get('dev', [ApiController::class, 'show']);
Route::put('dev', [ApiController::class, 'update']);
Route::delete('dev', [ApiController::class, 'destroy']);