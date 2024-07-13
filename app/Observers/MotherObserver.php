<?php

namespace App\Observers;

use App\Models\Mother;
use App\Models\MaternalCard;

use Emanate\BeemSms\Facades\BeemSms;


class MotherObserver
{
    /**
     * Handle the Mother "created" event.
     */
    public function created(Mother $mother): void
    {
        // Fetch the maternal card associated with the mother
        $maternalCard = MaternalCard::where('mother_id', $mother->id)->first();

        // Include the maternal card in the SMS content
        $smsContent = "Habari {$mother->mother_firstname} {$mother->mother_lastname},\n" .
                      "umejisajiliwa kwenye mfumo wa afya ya uzazi.\n" .
                      "Unatakiwa kuhudhuria kliniki baada ya wiki mbili kuanzia siku uliyoandikishwa.\n" .
                      "Kadi ya Namba: {$maternalCard->maternalCard}.\n pia tumia namba ya kadi kama nenosiri lako.\n
                      Asante";

        // Send the SMS
        BeemSms::content($smsContent)
            ->unpackRecipients($mother->mother_phone_number)
            ->send();
    }

    /**
     * Handle the Mother "updated" event.
     */
    public function updated(Mother $mother): void
    {
        //
    }

    /**
     * Handle the Mother "deleted" event.
     */
    public function deleted(Mother $mother): void
    {
        //
    }

    /**
     * Handle the Mother "restored" event.
     */
    public function restored(Mother $mother): void
    {
        //
    }

    /**
     * Handle the Mother "force deleted" event.
     */
    public function forceDeleted(Mother $mother): void
    {
        //
    }
}
