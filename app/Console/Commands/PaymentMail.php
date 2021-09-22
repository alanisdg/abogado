<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pending;
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
        Pending::create([
            'names'=>time(),

        ]);
        \Log::info("Cron is working fine!");
        return 0;
    }
}
