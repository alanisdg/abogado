<?php

use Illuminate\Support\Facades\Route;

// Controllers website
use App\Http\Controllers\HomeController;

// Controllers backend
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\UpsController;
use App\Http\Controllers\PercentageController;

/* Routes web */
Route::get('/', [HomeController::class, 'login'])->name('/');

Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('customer-register', [HomeController::class, 'userRegister'])->name('customer-register');
Route::post('customer-store', [HomeController::class, 'customerStore'])->name('customer-store');
Route::get('confirm-register', [HomeController::class, 'confirmRegister'])->name('confirm-register');

/* Change languaje */
 Route::get('lang/{locale}', [LangController::class, 'lang']);

/* Routes dashboard */
Auth::routes();

Route::middleware(['auth'])->group(function () {
    /* Dashboard */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Logout */
        Route::get('logout', [LoginController::class, 'logout']);

    /* Customers */
        Route::get('customers', [CustomerController::class, 'listCustomers'])->name('customers-list');
        Route::get('customers/details/{id}', [CustomerController::class, 'detailsCustomers'])->name('customers/details');
        Route::put('customers/update', [CustomerController::class, 'updateCustomers'])->name('customers/update');

    /* Shipping */
        Route::group(['prefix' => 'shipping'], function () {
            // Percentage
                Route::get('percentage', [PercentageController::class, 'register'])->name('shipping/percentage');
                Route::post('percentage/update', [PercentageController::class, 'update'])->name('shipping/percentage/update');

                Route::get('zones', [ShippingController::class, 'listZones'])->name('shipping/zones');
                Route::get('zones/edit/{id}', [ShippingController::class, 'zoneDetail'])->name('shipping/zones/edit');
                Route::get('venezuela', [ShippingController::class, 'shippingVenezuela'])->name('shipping/venezuela');
        });

    /* UPS */
        Route::group(['prefix' => 'ups'], function () {
            // Tracking
                Route::get('tracking', [UpsController::class, 'tracking'])->name('ups/tracking');
                Route::post('tracking/search', [UpsController::class, 'trackingSearch'])->name('ups/tracking/search');
            // Shipment
                Route::get('shipment', [UpsController::class, 'shipment'])->name('ups/shipment');
                Route::post('shipment/search', [UpsController::class, 'shipmentSearch'])->name('ups/shipment/search');
            // Time in transit
                Route::get('time-transit', [UpsController::class, 'timeTransit'])->name('ups/time-transit');
                Route::post('time-transit/search', [UpsController::class, 'timeTransitSearch'])->name('ups/time-transit/search');
        });
});

