<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use App\Models\Lead;
use Faker\Factory as Faker;

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
        $lead = Lead::factory()->create();

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
    public function unsubscribeLeadSendEmailNotExists(): void
    {
        do {
            $email = Faker::create()->unique()->safeEmail();
        } while (Lead::where('email', $email)->exists());
        
        $response = $this->rest()
            ->postJson(
                'api/leads/unsubscribe',
                [
                    'email' => $email,
                ]
            );

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => __('Leads.email_not_exists'),
        ]);
    }

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function unsubscribeLeadSendEmailNotEmail(): void
    {
        $response = $this->rest()
            ->postJson(
                'api/leads/unsubscribe',
                [
                ]
            );

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => __('Leads.email_required'),
        ]);
    }

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function unsubscribeLeadSendEmailEmailIsInvalid(): void
    {
        $emailInvalid = 'invalid-email';
        
        $response = $this->rest()
            ->postJson(
                'api/leads/unsubscribe',
                [
                    'email' => $emailInvalid,
                ]
            );

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
        ]);

        $response->assertJson([
            'message' => __('Leads.email_email'),
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
        $lead = Lead::factory()->create();

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

    /**
     * @test
     *
     * @group unsubscribed-lead
     *
     * A basic test example.
     */
    public function unsubscribeLeadLinkInvalidSignedEmail(): void
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
