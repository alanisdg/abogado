<?php

use Illuminate\Support\Facades\Route;

// Controllers website
use App\Http\Controllers\HomeController;

// Controllers backend
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\AnnexedController;

/* Routes web */
Route::get('/', [HomeController::class, 'login'])->name('/');

/* Routes dashboard */
Auth::routes();

Route::middleware(['auth'])->group(function () {
    /* Dashboard */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* Logout */
        Route::get('logout', [LoginController::class, 'logout']);

    /* Routes executive_administrator */
        Route::group(['middleware' => ['role:executive_administrator']], function() {
            // Customers
                Route::post('users/update-status', [UserController::class, "updateStatus"])->name('users/update-status');
                Route::get('users/delete-user/{id}', [UserController::class, "deleteUser"])->name('users/delete-user');
                Route::resource('users', UserController::class);

            // Pending
                Route::get('pending', [PendingController::class, "index"])->name('pending');
                Route::post('pending/upload', [PendingController::class, "store"])->name('pending/upload');
                Route::get('list-pending', [PendingController::class, "listPending"])->name('list-pending');
                Route::get('list-pending/details/{id}', [PendingController::class, "show"])->name('list-pending/details');
                Route::post('pending/update-status', [PendingController::class, "updateStatus"])->name('pending/update-status');
        });

    /* Routes legal administrator */
        Route::group(['middleware' => ['role:executive_administrator|legal_administrator']], function() {
            // Customers
                Route::resource('customers', CustomerController::class);
        });

    /* Routes Contracts Create*/
        Route::group(['prefix' => 'contract'], function () {
            /* Step 1 */
                Route::get('create/customer', [ContractController::class, 'step1'])->name('contract/create/customer');
                Route::post('create/search-customer', [CustomerController::class, 'searchCustomer'])->name('contract/create/search-customer');
                Route::get('edit/{id}', [ContractController::class, 'edit'])->name('contract/edit');
                Route::post('update', [ContractController::class, 'update'])->name('contract/update');

            /* Step 2 */
                Route::get('create/type-contract', [ContractController::class, 'step2'])->name('contract/create/type-contract');

            /* Step 3 */
                Route::get('create/parameters', [ContractController::class, 'step3'])->name('contract/create/parameters');

            /* Step 4 */
                Route::get('create/confirmation', [ContractController::class, 'step4'])->name('contract/create/confirmation');

            /* Register contract */
                Route::post('register', [ContractController::class, 'store'])->name('contract/register');
        });

    /* Route Contracts List */
        Route::group(['prefix' => 'list-contracts'], function () {
            /* List contracts */
                Route::get('list', [ContractController::class, 'index'])->name('list-contracts/list');

            /* Routes annexes */
                Route::get('annexes/{id}', [AnnexedController::class, 'annexes'])->name('list-contracts/annexes');
                Route::get('annexes/add/customer/{id}', [AnnexedController::class, 'addAnnexes'])->name('list-contracts/annexes/add/customer');
                Route::get('annexes/add/type_contract', [AnnexedController::class, 'typeContract'])->name('list-contracts/annexes/add/type_contract');
                Route::get('annexes/add/parameters', [AnnexedController::class, 'parameters'])->name('list-contracts/annexes/add/parameters');
                Route::get('annexes/add/confirm', [AnnexedController::class, 'confirm'])->name('list-contracts/annexes/add/confirm');
        });

    /* Route Causes */
        Route::group(['prefix' => 'causes'], function () {
            /* List causes */
                Route::get('list', [CauseController::class, 'index'])->name('causes/list');
                Route::get('add', [CauseController::class, 'create'])->name('causes/add');
        });
});

