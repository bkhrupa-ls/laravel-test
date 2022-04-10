<?php

use Illuminate\Http\Request;
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

        Route::get(
            '/shipment-cost',
            [\App\Http\Controllers\ShipmentCostController::class, 'index']
        )
            ->name('shipment-cost.index');
        Route::post(
            '/shipment-cost',
            [\App\Http\Controllers\ShipmentCostController::class, 'store']
        )
            ->name('shipment-cost.store');

        //
        Route::post(
            '/ajax/sale/calc-selling-price',
            [\App\Http\Controllers\AjaxController::class, 'actionCalcSellingPrice']
        )
            ->name('ajax.sale.calc-selling-price');
    });

require __DIR__ . '/auth.php';
