<?php

namespace Tests\Feature;

use App\Models\Lead;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ConfirmEmailLeadTest extends TestCase
{
    protected $login = false;

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function confirmEmailLeadLinkSignedEmail(): void
    {
        $lead = Lead::factory()->create();

        $locale = app()->getLocale();

        $url = URL::temporarySignedRoute(
            'leads.confirm-email',
            now()->addMinutes(30),
            [
                'id' => $lead->id,
                'locale' => $locale,
            ]
        );

        $response = $this->rest()
            ->getJson($url);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => __('Leads.emailConfirmed'),
        ]);

        $lead->refresh();

        $this->assertNull($lead->unsubscribed_at);
        $this->assertNotNull($lead->email_verified_at);

        $this->assertEquals(
            LeadStatus::where('name', 'email_confirmed')->first()->id,
            $lead->status_id
        );
    }

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function confirmEmailLeadLinkInvalidSignedEmail(): void
    {
        $lead = Lead::factory()->create();

        $locale = app()->getLocale();

        $url = URL::temporarySignedRoute(
            'leads.unsubscribe-email',
            now()->subMinutes(30),
            [
                'id' => $lead->id,
                'locale' => $locale,
            ]
        );

        $response = $this->rest()
            ->getJson($url);

        $response->assertStatus(403);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => 'Invalid signature.',
        ]);
    }
}
