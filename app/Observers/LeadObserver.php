<?php

namespace App\Observers;

use App\Models\Lead;
use App\Services\DiscordService;
use GuzzleHttp\Client as GuzzleClient;

class LeadObserver
{
    public function created(Lead $lead)
    {
        // usar discordService para enviar mensagem
        $clientDiscord = new GuzzleClient();

        $discord = new DiscordService($clientDiscord);
        $discord->sendNewLead($lead);
    }
}
