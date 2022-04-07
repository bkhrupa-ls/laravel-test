<?php

use Illuminate\Support\Facades\Route;

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

Route::redirect('/dashboard', '/sales');

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/sales', [\App\Http\Controllers\SalesController::class, 'index'])
            ->name('sales.index');
        Route::post('/sales', [\App\Http\Controllers\SalesController::class, 'store'])
            ->name('sales.store');

        Route::get('/shipping-partners', function () {
            return view('shipping_partners');
        })
            ->name('shipping.partners');
    });

require __DIR__ . '/auth.php';
