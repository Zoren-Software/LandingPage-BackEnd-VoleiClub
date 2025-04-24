<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class UnsubscribedLeadTest extends TestCase
{
    protected $login = false;

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function unsubscribeLeadSendEmail(): void
    {
        $lead = \App\Models\Lead::factory()->create();

        $response = $this->rest()
            ->postJson(
                'api/leads/unsubscribe',
                [
                    'email' => $lead->email,
                ]
            );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => __('Leads.unsubscribe_receive_email'),
        ]);
    }

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function unsubscribeLeadLinkSignedEmail(): void
    {
        $lead = \App\Models\Lead::factory()->create();

        $locale = app()->getLocale();

        $url = URL::temporarySignedRoute(
            'leads.unsubscribe-email',
            now()->addMinutes(30),
            [
                'id' => $lead->id,
                'locale' => $locale,
            ]
        );

        $response = $this->rest()
            ->getJson($url);

        dd($response->json());

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => __('Leads.unsubscribe_success'),
        ]);

        $lead->refresh();

        $this->assertNotNull($lead->unsubscribed_at);
        $this->assertNotNull($lead->email_verified_at);
        $this->assertEquals($lead->unsubscribed_at, $lead->email_verified_at);
    }
}
