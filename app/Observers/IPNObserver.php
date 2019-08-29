<?php

namespace App\Observers;

use App\Webhook;
use App\Jobs\PaymentRevissionJob;
use App\Jobs\MerchantOrderRevissionJob;

class IPNObserver
{
    /**
     * Handle the webhook "created" event.
     *
     * @param  \App\Webhook  $webhook
     * @return void
     */
    public function created(Webhook $webhook)
    {
        if($webhook->topic == 'merchant_order') MerchantOrderRevissionJob::dispatch($webhook->webhook_id);
        if($webhook->topic == 'payment') PaymentRevissionJob::dispatch($webhook->webhook_id);
    }

}
