<?php

use App\Models\Pending;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        'names'=>$request['name'],
        'email'=>$request['email'],
        'phone'=>$request['phone'],
        'interview_date'=> $request['day'] . ' ' . $request['hour'],
        'status'=>1,
    ]);

    $emailDetails = [
        'title' => 'Appboproc!',
        'url'   => \Request::root(),
        'user' => $request['name'],
        'email' => $request['email'],
        'phone' => $request['phone'],
        'entrevista' => $request['day'] . ' ' .  $request['hour']
    ];

    //Send mail
    /*
    Mail::send('emails.entrevista', $emailDetails, function($message) use ($emailDetails) {
        $message->from('contacto@appaboproc.com', 'Appboproc');
        $message->to($emailDetails['email']);
        $message->subject('Entrevista - Appboproc');
    });
*/


});
