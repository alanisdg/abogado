<?php

namespace App\Console\Commands;

use App\Models\Collection;
use Illuminate\Console\Command;
use App\Models\Pending;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('start');
           // 5 días antes del pago

        $collections = Collection::where( 'payment_date', Carbon::now()->addDays(5)->format('Y-m-d'))->get();
        Log::info($collections);
        foreach($collections as $collection){
            $email = $collection->contract->user->email;
            $emailDetails = [
                'title' => 'Appboproc!',
                'url'   => \Request::root(),
                'user' => $collection->contract->user,
                'email' =>  $email,
                'cuota' => $collection
            ];

            //Send mail
            //return $request->input("data_type_register");

            Mail::send('emails.five-days', $emailDetails, function($message) use ($emailDetails) {
                $message->from('contacto@appaboproc.com', 'Appboproc');
                $message->to($emailDetails['email']);
                $message->subject('Próximo pago - Appboproc');
            });

        }

        $collections = Collection::where( 'payment_date', Carbon::now()->subDays(3)->format('Y-m-d'))->get();

        foreach($collections as $collection){
            if($collection->status=='PENDIENTE'){
                $email = $collection->contract->user->email;
                $emailDetails = [
                    'title' => 'Appboproc!',
                    'url'   => \Request::root(),
                    'user' => $collection->contract->user,
                    'email' =>  $email,
                    'cuota' => $collection
                ];

                //Send mail
                //return $request->input("data_type_register");

                Mail::send('emails.three-days', $emailDetails, function($message) use ($emailDetails) {
                    $message->from('contacto@appaboproc.com', 'Appboproc');
                    $message->to($emailDetails['email']);
                    $message->subject('Cuota vencida - Appboproc');
                });

            }

        }
    }
}
