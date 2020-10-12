<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoundController;
use App\Http\Controllers\SoundApiController;
use App\Http\Controllers\ScheduleController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//return as API JSON
Route::get('/sound', [SoundApiController::class, 'index']);
Route::get('/sound/package', [SoundApiController::class, 'show']);
Route::get('/sound/{folder}/{file}', [SoundApiController::class, 'download']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/', function(){
        return view('dashboard');
    })->name('home');
    Route::get('/admin/sound/add', function(){
        return view('addsoundpackage');
    });
    Route::post('/admin/sound/addpackage', [SoundController::class, 'addPackage']);
    Route::post('/admin/sound/updateCoverImage', [SoundController::class, 'updateCoverImage']);
    Route::post('/admin/sound/uploadfile', [SoundController::class, 'uploadFile']);
    Route::get('/admin/sound/deleteFile', [SoundController::class, 'deleteSoundFile']);
    Route::post('/admin/sound/updatePackagename', [SoundController::class, 'updateName']);
    Route::post('/admin/sound/deletePackage', [SoundController::class, 'deletePackage']);
    
    Route::get('/admin/sound', [SoundController::class, 'index'])->name('sound');
    Route::get('/admin/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/admin/sound/{id}', [SoundController::class, 'show']);
});

