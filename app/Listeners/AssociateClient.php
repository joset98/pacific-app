<?php

namespace App\Listeners;

use App\Events\SaleSaved;
use App\Repositories\Clients\ClientRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssociateClient
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SaleSaved  $event
     * @return void
     */
    public function handle(SaleSaved $event)
    {
        //
        info($event->client);
        info('aqui en listener');
        (new ClientRepository)->associateSale( $event->sale, $event->client);
    }
}
