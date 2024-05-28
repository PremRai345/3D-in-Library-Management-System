<?php

use App\Http\Controllers\fullController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/',[fullController::class,'welcomes']);
Route::get('/dashboard',[fullController::class,'openDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/booka',function(){
    return view('bookanim');
});
Route::get('/privacyandpolicy',[fullController::class,'openpolicy']);
Route::get('/3dbook',[fullController::class,'open3dbook']);
Route::get('/avatar',[fullController::class,'openAvatar']);
Route::get('/admin',[fullController::class,'getUser']);
Route::get('/addBook',[fullController::class,'openForm']);
Route::post('/storeBook',[fullController::class,'AddBook']);
Route::get('/deleteBook/{id}',[fullController::class,'delBook']);
Route::get('/download/{file}',[fullController::class,'downloadfile']);
Route::get('/view/{id}',[fullController::class,'viewfile']);
Route::get('/editBook/{id}',[fullController::class,'editBook']);
Route::post('/updateBook/{id}',[fullController::class,'resuBook']);

require __DIR__.'/auth.php';
