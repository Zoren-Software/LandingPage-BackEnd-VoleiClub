<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\LeadStatus;
use Tests\TestCase;

class AlterStatusLeadTest extends TestCase
{
    protected $login = true;

    /**
     * @test
     *
     * @dataProvider alterStatusLeadProviderSuccess
     * @dataProvider alterStatusLeadProviderError
     *
     * @group create-lead
     *
     * A basic test example.
     */
    public function alterStatusLead(array $data, $statusCodeExpected, $messageExpected, $errorType, $errorExpected): void
    {
        $lead = \App\Models\Lead::factory()->create();

        if ($data['id'] === true) {
            $data['id'] = $lead->id;
        } else {
            $data['id'] = 'lala';
        }

        if ($data['status_id'] !== false) {

            $data['status_id'] = LeadStatus::whereName($data['status_id'])->first()?->id;

            if ($data['status_id'] === null) {
                $data['status_id'] = LeadStatus::orderBy('id', 'desc')->first()->id + 1;
            }

        }
        $response = $this->rest()->putJson('api/leads/' . $data['id'], $data);

        if ($statusCodeExpected === 200) {
            $response->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'status_id',
                    'experience_level',
                    'message',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
            ]);

            $response->assertJson([
                'data' => [
                    'status_id' => $data['status_id'],
                ],
            ]);

            $response->assertJson([
                'message' => __($messageExpected),
            ]);
        } else {
            $response->assertJsonStructure([
                'message',
                'errors',
            ]);

            $response->assertJson([
                'message' => __($messageExpected),
            ]);
        }
        $response->assertStatus($statusCodeExpected);

    }

    public static function alterStatusLeadProviderSuccess(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'alter status lead, alter status new, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'new',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status contacted, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'contacted',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status converted, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'converted',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status unqualified, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'unqualified',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status qualified, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'qualified',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status bad_email, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'bad_email',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status spam, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'spam',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status test, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'test',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status trial period, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'trial_period',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status active customer, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'active_customer',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status new with message, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'new',
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status new with note, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'new',
                    'notes' => $faker->text(),
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status new with message and note, success' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'new',
                    'message' => $faker->text(),
                    'notes' => $faker->text(),
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
        ];
    }

    public static function alterStatusLeadProviderError(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'alter status lead, alter status with id not must be an integer, error' => [
                'data' => [
                    'id' => false,
                    'message' => $faker->text(),
                    'status_id' => 'new',
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.id_integer',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
            'alter status lead, alter status not exist, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => null,
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.status_in',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
            'alter status lead, alter status is blocked unsubscribed, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'unsubscribed',
                    'notes' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.status_id_blocked',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
            'alter status lead, alter status is blocked email_confirmed, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status_id' => 'email_confirmed',
                    'notes' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.status_id_blocked',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
        ];
    }
}
