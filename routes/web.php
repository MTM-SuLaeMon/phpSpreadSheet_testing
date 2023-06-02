<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'api/version1'], function () {
    Route::post('/download',[DownloadController::class,'download'])->name('download');
    Route::post('/download2',[DownloadController::class,'download2'])->name('download2');
    Route::post('/download3',[DownloadController::class,'download3'])->name('download3');
});
