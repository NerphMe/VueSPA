<?php

use App\Http\Controllers\NewsController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{news}', [NewsController::class, 'show']);
Route::patch('/news', [NewsController::class, 'updateStatus']);

/**
 * Try to avoid something like that.
 */
Route::post('/news/generate', function () {
    Artisan::call('db:seed', ['--class' => 'NewsSeeder']);

    return new JsonResponse([], Response::HTTP_CREATED);
});
