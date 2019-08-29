<?php

namespace App\Observers;

use App\Pay;

class PayObserver
{
    /**
     * Handle the pay "created" event.
     *
     * @param  \App\Pay  $pay
     * @return void
     */
    public function created(Pay $pay)
    {
        if($pay->payment_type == 'payment') PaymentRevissionJob::dispatch($pay->payment_id);
    }

    /**
     * Handle the pay "updated" event.
     *
     * @param  \App\Pay  $pay
     * @return void
     */
    public function updated(Pay $pay)
    {
        //
    }

    /**
     * Handle the pay "deleted" event.
     *
     * @param  \App\Pay  $pay
     * @return void
     */
    public function deleted(Pay $pay)
    {
        //
    }

    /**
     * Handle the pay "restored" event.
     *
     * @param  \App\Pay  $pay
     * @return void
     */
    public function restored(Pay $pay)
    {
        //
    }

    /**
     * Handle the pay "force deleted" event.
     *
     * @param  \App\Pay  $pay
     * @return void
     */
    public function forceDeleted(Pay $pay)
    {
        //
    }
}
