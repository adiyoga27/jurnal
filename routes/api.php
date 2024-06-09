<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('product-by-id/{id}', [ApiController::class, 'product']);
Route::get('sync', [ApiController::class,'syncHpp']);