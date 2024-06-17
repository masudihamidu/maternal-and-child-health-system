<?php

namespace App\Observers;

use App\Models\PregnancySummary;
use App\Models\Mother;
use Emanate\BeemSms\Facades\BeemSms;
use Carbon\Carbon;

class PregnancySummaryObserver
{
    /**
     * Handle the PregnancySummary "created" event.
     *
     * @param  \App\Models\PregnancySummary  $pregnancySummary
     * @return void
     */
    public function created(PregnancySummary $pregnancySummary)
    {
        // Calculate the estimated delivery date
        $edd = Carbon::parse($pregnancySummary->edd)->format('d/m/Y');

        // Fetch the mother associated with the pregnancy summary
        $mother = Mother::find($pregnancySummary->mother_id);

        // Send SMS notification
        if ($mother) {
            BeemSms::content("Habari {$mother->mother_firstname} {$mother->mother_lastname}, na hongera \nUnatazamiwa kujifungua tarehe {$edd}.\nAsante")
                ->unpackRecipients($mother->mother_phone_number)
                ->send();
        }
    }
}
