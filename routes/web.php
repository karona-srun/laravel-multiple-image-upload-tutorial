<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AttachmentController;

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

// setup a resource with index, store, update, delete and show actions
Route::resource('posts', PostController::class);
Route::post('/upload-attachment', [PostController::class,'uploadAttachment']);
Route::delete('/delete-attachment/{id}', [PostController::class,'deleteAttachment']);

Route::get('/upload', [AttachmentController::class,'index']);
Route::post('/upload', [AttachmentController::class,'store']);
Route::post('/file-delete', [AttachmentController::class,'delete']);