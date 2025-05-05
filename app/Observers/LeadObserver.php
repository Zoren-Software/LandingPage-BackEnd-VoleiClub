<?php

namespace App\Observers;

use App\Models\Lead;
use App\Services\DiscordService;
use GuzzleHttp\Client as GuzzleClient;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     *
     * @codeCoverageIgnore
     *
     * @return void
     */
    public function created(Lead $lead)
    {
        // usar discordService para enviar mensagem
        if (env('APP_ENV') === 'production') {
            $clientDiscord = new GuzzleClient();

            $discord = new DiscordService($clientDiscord);
            $discord->sendNewLead($lead);
        }
    }
}
