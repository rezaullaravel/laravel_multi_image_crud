<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;



Route::get('/',[ProductController::class,'index']);
Route::post('/store',[ProductController::class,'store'])->name('product.store');
Route::get('/image/delete/{id}',[ProductController::class,'deleteImage'])->name('image.delete');
Route::get('/product/edit/{id}',[ProductController::class,'editProduct'])->name('product.edit');
Route::post('/product/update',[ProductController::class,'updateProduct'])->name('product.update');
Route::get('/product/delete/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');
