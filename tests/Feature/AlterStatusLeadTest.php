<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
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

        if($data['tenantId'] === false) {
            unset($data['tenantId']);
        }

        $response = $this->rest()->put('api/leads/' . $data['id'], $data);

        if ($statusCodeExpected === 200) {
            $response->assertJsonStructure([
                'message',
                'data' => [
                    'id',
                    'name',
                    'email',
                    'status',
                    'experience_level',
                    'message',
                    'email_verified_at',
                    'created_at',
                    'updated_at',
                ],
            ]);

            $response->assertJson([
                'data' => [
                    'status' => $data['status'],
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
                    'status' => 'new',
                    'tenantId' => $faker->word(),
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
                    'status' => 'contacted',
                    'tenantId' => $faker->word(),
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
                    'status' => 'converted',
                    'tenantId' => $faker->word(),
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
                    'status' => 'unqualified',
                    'tenantId' => $faker->word(),
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
                    'status' => 'qualified',
                    'tenantId' => $faker->word(),
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
                    'status' => 'bad_email',
                    'tenantId' => $faker->word(),
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
                    'status' => 'spam',
                    'tenantId' => $faker->word(),
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
                    'status' => 'test',
                    'tenantId' => $faker->word(),
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
                    'status' => 'trial_period',
                    'tenantId' => $faker->word(),
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
                    'status' => 'active_customer',
                    'tenantId' => $faker->word(),
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
                    'status' => 'new',
                    'tenantId' => $faker->word(),
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
                    'status' => 'new',
                    'tenantId' => $faker->word(),
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
                    'status' => 'new',
                    'tenantId' => $faker->word(),
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
                    'status' => 'new',
                    'tenantId' => $faker->word(),
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
                    'status' => 'xablaus',
                    'tenantId' => $faker->word(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.status_in',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
            'alter status lead, alter tenantId not specific, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'new',
                    'tenantId' => false,
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.tenant_id_required',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
        ];
    }
}
