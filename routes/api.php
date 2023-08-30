<?php

use App\Http\Controllers\QueryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('consulta')->group(function () {
    Route::get('/', [QueryController::class, 'queryZipCode']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
