<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PushNotification;
Use DB;

class ImmunizationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'immunization:reminder';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info("test");
        $this->sendNotificationToDevice();
    }

    public function sendNotificationToDevice()
    {
        $results = DB::select('CALL getVaccinationSchedule()');
        
        foreach ($results as $result) {
            // Send the notification to the device with a token of $deviceToken
            $this->info($result->children.' waktunya imunisasi '.$result->imunisasi);
            PushNotification::app('appNameAndroid')
            ->to($result->gcm_id)
            ->send($result->children.' waktunya imunisasi '.$result->imunisasi);
        }
        
    }
    
}
