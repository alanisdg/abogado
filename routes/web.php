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
use App\Http\Controllers\TaskController;

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
        });

    /* Routes legal administrator */
        Route::group(['middleware' => ['role:executive_administrator|legal_administrator|legal_executive']], function() {
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

            // Pending
                Route::get('list-pending', [PendingController::class, "listPending"])->name('list-pending');
                Route::get('list-pending/details/{id}', [PendingController::class, "show"])->name('list-pending/details');
                Route::post('pending/update-status', [PendingController::class, "updateStatus"])->name('pending/update-status');

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

                        Route::get('annexes/edit/{id}', [AnnexedController::class, 'edit'])->name('list-contracts/annexes/edit');
                        Route::get('annexes/edit/update', [AnnexedController::class, 'update'])->name('list-contracts/annexes/edit/update');
                });

            /* Route Causes */
                Route::group(['prefix' => 'causes'], function () {
                    /* List causes */
                        Route::get('contracts', [CauseController::class, 'index'])->name('causes/contracts');
                        Route::get('contracts/record-causes/{id}', [CauseController::class, 'recordCauses'])->name('causes/contracts/record-causes');
                        Route::get('contracts/record-causes/add-cause/{id}', [CauseController::class, 'create'])->name('causes/contracts/record-causes/add-cause');
                        Route::post('contracts/record-causes/add-cause/store', [CauseController::class, 'store'])->name('causes/contracts/record-causes/add-cause/store');
                        Route::get('contracts/record-causes/add-cause/edit/{id}', [CauseController::class, 'edit'])->name('causes/contracts/record-causes/add-cause/edit');
                        Route::post('contracts/record-causes/add-cause/update', [CauseController::class, 'update'])->name('causes/contracts/record-causes/add-cause/update');

                    /* Task */
                        Route::get('{id}/tasks/', [TaskController::class, 'index']);
                        Route::get('{id}/tasks/add', [TaskController::class, 'create']);
                        Route::post('tasks/add/store', [TaskController::class, 'store']);
                        Route::get('tasks/edit/{id}', [TaskController::class, 'edit']);
                        Route::post('tasks/edit/update', [TaskController::class, 'update']);
                        Route::post('tasks/complete', [TaskController::class, 'complete']);
                });
        });
});

