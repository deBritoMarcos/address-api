<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('test')->name('http-test.')->group(function () {
    Route::get('/viacep-test/{parameter}/json', function (string $zipcode, Request $request) {
        return response()->json(
            $request->all()
        );
    })->name('viacep');
});

Route::get('/', fn () => view('welcome'));
