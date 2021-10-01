<?php

use App\Models\Pending;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/contact', function (Request $request) {
    Pending::create([
        'names'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'date'=>$request->date,
        'hour'=>$request->hour,
        'status'=>1,

    ]);
});
