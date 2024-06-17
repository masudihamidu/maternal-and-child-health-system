<?php

namespace App\Observers;

use App\Models\Disease;
use App\Models\Mother;
use Emanate\BeemSms\Facades\BeemSms;

class DiseaseObserver
{
    /**
     * Handle the Disease "created" event.
     */
    public function created(Disease $disease): void
    {
        // Fetch the mother associated with the disease
        $mother = Mother::find($disease->mother_id);

        // Send SMS notification
        if ($mother) {
            BeemSms::content("Habari $mother->mother_firstname $mother->mother_lastname,\nUmefanyiwa kipimo cha $disease->disease_name.\nAsante")
                ->unpackRecipients($mother->mother_phone_number)
                ->send();
        }
    }

}
