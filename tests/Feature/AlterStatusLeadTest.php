<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlterStatusLeadTest extends TestCase
{
    /**
     * @test
     * 
     * @dataProvider alterStatusLeadProviderError
     *
     * @group create-lead
     *
     * A basic test example.
     */
    public function alterStatusLead(array $data, $statusCodeExpected, $messageExpected, $errorType, $errorExpected): void
    {
        $lead = \App\Models\Lead::factory()->create();

        if($data['id'] === true) {
            $data['id'] = $lead->id;
        } else {
            $data['id'] = 'lala';
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
                'errors'
            ]);

            $response->assertJson([
                'message' => __($messageExpected),
            ]);
        }
        $response->assertStatus($statusCodeExpected);

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
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.status_in',
                'errorType' => 'error',
                'errorExpected' => true,
            ],
        ];
    }

    public static function alterStatusLeadProviderSuccess(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'alter status lead, alter status new, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'new',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status contacted, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'contacted',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status converted, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'converted',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status unqualified, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'unqualified',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status qualified, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'qualified',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status bad_email, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'bad_email',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
            'alter status lead, alter status spam, error' => [
                'data' => [
                    'id' => true,
                    'message' => $faker->text(),
                    'status' => 'spam',
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success_edit_status',
                'errorType' => false,
                'errorExpected' => false,
            ],
        ];
    }

}
