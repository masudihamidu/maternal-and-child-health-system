<?php

namespace App\Observers;

use App\Models\Mother;

use Emanate\BeemSms\Facades\BeemSms;


class MotherObserver
{
    /**
     * Handle the Mother "created" event.
     */
    public function created(Mother $mother): void
    {
        BeemSms::content("Habari $mother->mother_firstname $mother->mother_lastname,\numejisajiliwa kwenye mfumo wa afya ya uzazi.\nUnatakiwa kuhudhuria kliniki baada ya wiki mbili kuanzia siku uliyoandikishwa.\nAsante")
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
