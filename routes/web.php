<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\VariationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Auth::routes(['register' => false]);



Route::group(['middleware' => 'auth'], function () {

    // Product Variations
    Route::resource('products/variations', '\Modules\Product\Http\Controllers\VariationController')
        ->except(['show'])
        ->names('products.variations');

    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');

    // Shopee Import Routes
    Route::get('/shopee/import', [App\Http\Controllers\ShopeeImportController::class, 'index'])->name('shopee.import.index');
    Route::post('/shopee/import', [App\Http\Controllers\ShopeeImportController::class, 'import'])->name('shopee.import');

    Route::get('/sales/baru/pdf/{id}', [\Modules\Sale\Http\Controllers\PosController::class, 'pdf'])->name('sale.baru.pdf');

    // Jika Anda pakai prefix maupun middleware auth, sesuaikan:
    Route::post('/filter-chart', [\App\Http\Controllers\HomeController::class, 'filterChart'])
    ->name('filter.chart')
    ->middleware('auth');

});
