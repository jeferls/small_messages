<?php

use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/health', fn () => response()->json(['status' => 'ok']));
    Route::post('/transfer', [TransferController::class, 'transfer']);
});
