<?php

namespace App\Observers;

use App\Models\Immunity;
use App\Models\Mother;
use Emanate\BeemSms\Facades\BeemSms;

class ImmunityObserver
{
    /**
     * Handle the Immunity "created" event.
     */
    public function created(Immunity $immunity): void
    {
        // Fetch the mother associated with the immunity
        $mother = Mother::find($immunity->mother_id);

        // Send SMS notification
        if ($mother) {
            BeemSms::content("Habari $mother->mother_firstname $mother->mother_lastname,\nUmepatiwa kinga ya $immunity->immunity_name.\nAsante")
                ->unpackRecipients($mother->mother_phone_number)
                ->send();
        }
    }

 }
