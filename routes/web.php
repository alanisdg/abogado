<?php

use Illuminate\Support\Facades\Route;

// Controllers website
use App\Http\Controllers\HomeController;

// Controllers backend
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\WordpressController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\CauseController;
use App\Http\Controllers\AnnexedController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ActualizationController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CreditorController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PaymentController;
use App\Models\Pending;

/* Routes web */
Route::get('/', [HomeController::class, 'login'])->name('/');
Route::get('/json', [HomeController::class, 'json']);

/** Routes webpay */


/* Routes dashboard */
Auth::routes();

Route::get('email', function() {
    return view('emails.create-contract');
});
Route::get('/form', [WordpressController::class, 'form']);
Route::get('/getDates', [WordpressController::class, 'dates']);


Route::get('/agenda', [DashboardController::class, 'agenda'])->name('agenda');



Route::middleware(['auth'])->group(function () {
    /* Dashboard */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    /* Dashboard */
    Route::get('/updloadFile/{id}', [FileController::class, 'index']);
    Route::get('/biblioteca/{id}', [FileController::class, 'biblioteca'])->name('biblioteca');
    Route::post('/biblioteca/store', [FileController::class, 'store']);

    Route::get('/file/{id}', [FileController::class, 'download']);


    /* User profile */
        Route::get('user-profile', [UserController::class, 'editProfile'])->name('user-profile');
        Route::put('user-profile-update', [UserController::class, 'updateProfile'])->name('user-profile-update');

    /* Logout */
        Route::get('logout', [LoginController::class, 'logout']);



        Route::group(['middleware' => ['role:executive_administrator']], function() {
            Route::post('collection/update/{collection}', [CollectionController::class, 'update'])->name('list-fess/create/transaction');

        });

        Route::group(['middleware' => ['role:executive_administrator|legal_administrator|legal_executive']], function() {
            Route::get('logs', [LogController::class, 'logs'])->name('logs');
        });
        Route::group(['middleware' => ['role:executive_administrator|legal_administrator|legal_executive']], function() {
            // Customers
                Route::get('customers/create', [PendingController::class, 'create'])->name('customers/create');
                Route::post('customers/create/store', [PendingController::class, 'storeCustomer'])->name('customers/create/store');
                Route::post('users/update-status', [UserController::class, "updateStatus"])->name('users/update-status');
                Route::get('users/delete-user/{id}', [UserController::class, "deleteUser"])->name('users/delete-user');
                Route::resource('users', UserController::class);

            // Pending
                Route::get('pending', [PendingController::class, "index"])->name('pending');
                Route::post('pending/upload', [PendingController::class, "store"])->name('pending/upload');

        });

        Route::group(['middleware' => ['role:executive_administrator|legal_administrator|legal_executive']], function() {
           /* Routes Preview */
           Route::get('calendar', [PreviewController::class, "calendar"])->name('calendar');
           Route::get('events', [PreviewController::class, "events"]);

            Route::get('list-preview/details/{id}', [PreviewController::class, "show"])->name('list-preview/details');

            Route::group(['prefix' => 'preview'], function () {
                 Route::post('upload', [PreviewController::class, 'upload'])->name('preview.upload');
                 Route::post('update/{contact}', [PreviewController::class, 'update'])->name('preview.update');
           });
            /* Routes Contracts Create*/
                Route::group(['prefix' => 'contract'], function () {
                        Route::get('edit/{id}', [ContractController::class, 'edit'])->name('contract/edit');
                        Route::post('update', [ContractController::class, 'update'])->name('contract/update');
                        Route::get('print/{id}', [ContractController::class, 'printContract'])->name('contract/print');
                        Route::get('actualize/{id}', [ContractController::class, 'actualizeContract'])->name('contract/actualize');

                    /* Change creditor */
                        Route::post('update/change-creditor', [ActualizationController::class, 'changeCreditor']);

                    /* Change strategy */
                        Route::post('update/change-strategy', [ActualizationController::class, 'changeStrategy'])->name('contract/update/change-strategy');

                    /* Account holder change */
                        Route::post('update/account-holder-change', [ActualizationController::class, 'accountHolderChange'])->name('contract/update/account-holder-change');

                    /* Change payment date */
                        Route::post('update/change-payment-date', [ActualizationController::class, 'changePaymentDate'])->name('contract/update/change-payment-date');

                    /* Deceased customer */
                        Route::post('update/deceased-customer', [ActualizationController::class, 'deceasedCustomer'])->name('contract/update/deceased-customer');

                    /* Print document update */
                        Route::get('update/print/document/{id}/{type}', [ActualizationController::class, 'printDocument'])->name('contract/update/print/document');

                    /* Step 1 */
                        Route::get('create/customer', [ContractController::class, 'step1'])->name('contract/create/customer');
                        Route::post('create/search-customer', [CustomerController::class, 'searchCustomer'])->name('contract/create/search-customer');

                    /* Step 2 */
                        Route::get('create/type-contract', [ContractController::class, 'step2'])->name('contract/create/type-contract');

                    /* Step 3 */
                        Route::get('create/parameters', [ContractController::class, 'step3'])->name('contract/create/parameters');

                    /* Step 4 */
                        Route::get('create/confirmation', [ContractController::class, 'step4'])->name('contract/create/confirmation');

                    /* Register contract */
                        Route::post('register', [ContractController::class, 'store'])->name('contract/register');

                    /* Terminate contract */
                        Route::post('setle', [ContractController::class, 'terminateContract'])->name('contract/setle');
                        Route::get('setle/print/{id}', [ContractController::class, 'settlementContract'])->name('contract/setle/print');
                });

            // Pending
                Route::get('list-pending', [PendingController::class, "listPending"])->name('list-pending');
                Route::get('list-pending/details/{id}', [PendingController::class, "show"])->name('list-pending/details');
                Route::post('pending/update-status', [PendingController::class, "updateStatus"])->name('pending/update-status');
                Route::post('/update/interview', [PendingController::class, "updateInterview"]);

            // Preview
            Route::get('list-preview', [PreviewController::class, "listPreview"])->name('list-preview');
            Route::post('preview/update-status', [PreviewController::class, "updateStatus"])->name('preview/update-status');

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
                        Route::get('/files/{cause}', [CauseController::class, 'files']);

                        Route::get('contracts/record-causes/{id}', [CauseController::class, 'recordCauses'])->name('causes/contracts/record-causes');
                        Route::get('contracts/record-causes/add-cause/{id}', [CauseController::class, 'create'])->name('causes/contracts/record-causes/add-cause');
                        Route::post('contracts/record-causes/add-cause/store', [CauseController::class, 'store'])->name('causes/contracts/record-causes/add-cause/store');
                        Route::get('contracts/record-causes/add-cause/edit/{id}', [CauseController::class, 'edit'])->name('causes/contracts/record-causes/add-cause/edit');
                        Route::post('contracts/record-causes/add-cause/update', [CauseController::class, 'update'])->name('causes/contracts/record-causes/add-cause/update');

                    /* List of causes by contract */
                        Route::get('list/{id}', [CauseController::class, 'listCauses'])->name('causes/list');

                    /* Task */
                        Route::get('{id}/tasks/', [TaskController::class, 'index']);
                        Route::get('{id}/tasks/add', [TaskController::class, 'create']);
                        Route::post('tasks/add/store', [TaskController::class, 'store']);
                        Route::get('tasks/edit/{id}', [TaskController::class, 'edit']);
                        Route::post('tasks/edit/update', [TaskController::class, 'update']);
                        Route::post('tasks/complete', [TaskController::class, 'complete']);

                    /* List of tasks by causes */
                        Route::get('list/tasks/{id}', [TaskController::class, 'listTasks'])->name('causes/list/tasks');
                });

            /* Creditors */
                Route::get('creditors/{id}', [CreditorController::class, "index"])->name("creditors");
                Route::get('creditors/create/{id}', [CreditorController::class, "create"])->name("creditors/create");
                Route::post('creditors/store', [CreditorController::class, "store"])->name("creditors/store");
                Route::get('creditors/edit/{id}', [CreditorController::class, "edit"])->name("creditors/store/edit");
                Route::post('creditors/update', [CreditorController::class, "update"])->name("creditors/update");

            /* Creditors anenexes */
                Route::get('annexes/creditors/{id}', [CreditorController::class, 'index'])->name('annexes/creditors');
        });

        Route::group(['middleware' => ['role:customer']], function() {

            //Profile
            Route::post('/customer/complete', [UserController::class, 'updateTerms']);


            // List Causes
                Route::get('list-causes/{id}', [CauseController::class, 'list'])->name('list-causes');

            // List Fees
                Route::get('list-fees/{id}', [CollectionController::class, 'listFeesContract'])->name('list-fees');
                Route::get('list-fess/pay-fee/{id}', [CollectionController::class, 'payFee'])->name('list-fess/pay-fee');
                Route::post('list-fess/create/transaction', [CollectionController::class, 'createTransaction'])->name('list-fess/create/transaction');
                Route::get('payment-return', [CollectionController::class, 'returnUrl'])->name('payment-return');

        });

        // Collections
            Route::get('collections', [CollectionController::class, "listFees"])->name('collections');
            Route::get('testcollections', [CollectionController::class, "test"]);
            Route::post('search/collections', [CollectionController::class, "searchCollections"])->name('search/collections');

});

