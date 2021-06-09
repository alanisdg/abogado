<?php

use Illuminate\Support\Facades\Route;

// Controllers website
use App\Http\Controllers\HomeController;

// Controllers backend
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\BranchOfficeController;

/* Routes web */
Route::get('/', [HomeController::class, 'login'])->name('/');

/* Routes dashboard */
Auth::routes();

Route::middleware(['auth'])->group(function () {
    /* Dashboard */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Logout */
        Route::get('logout', [LoginController::class, 'logout']);

    /* Routes admin */
        Route::group(['middleware' => ['role:root|administrator']], function() {
            // Customers
                Route::resource('customers', CustomerController::class);
            // Customers
                Route::resource('lawyers', LawyerController::class);
            // Customers
                Route::resource('branch-offices', BranchOfficeController::class);
        });

    /* Customers */

    /* Shipping */
        Route::group(['prefix' => 'shipping'], function () {
            // Percentage
                Route::get('percentage', [PercentageController::class, 'register'])->name('shipping/percentage');
                Route::post('percentage/update', [PercentageController::class, 'update'])->name('shipping/percentage/update');

                Route::get('zones', [ShippingController::class, 'listZones'])->name('shipping/zones');
                Route::get('zones/edit/{id}', [ShippingController::class, 'zoneDetail'])->name('shipping/zones/edit');
                Route::get('venezuela', [ShippingController::class, 'shippingVenezuela'])->name('shipping/venezuela');
        });
});

