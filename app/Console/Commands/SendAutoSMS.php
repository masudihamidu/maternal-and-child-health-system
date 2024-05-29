<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Disease; // Assuming you have a SmsQueue model
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Emanate\BeemSms\Facades\BeemSms;


class SendAutoSMS extends Command
{
    protected $signature = 'auto:sms';
    protected $description = 'Send delayed SMS after 5 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $fiveMinutesAgo = Carbon::now()->subMinutes(5);

        // Retrieve SMS entries that are due to be sent
        $diseases = Disease::all();

        foreach ($diseases as $disease) {
            //dd($disease->disease_name, $disease->mother->mother_firstname);
            BeemSms::content("Habari $disease->mother->mother_firstname $disease->mother->mother_lastname,\nHongera kwa kufika kliniki.\nUnatakiwa kuhudhuria kliniki baada ya wiki mbili kuanzia siku ya leo.\nAsante")
        ->unpackRecipients($disease->mother->mother_phone_number)
        ->send();
        }

        Log::info('Delayed SMS sent to users after 5 minutes.');
    }
}
