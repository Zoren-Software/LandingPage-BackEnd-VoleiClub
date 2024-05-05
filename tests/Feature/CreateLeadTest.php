<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateLeadTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider  successProvider
     * @dataProvider  errorProvider
     *
     * @group create-lead
     *
     * A basic test example.
     */
    public function createLead(array $data, int $statusCodeExpected, string $messageExpected, string $errorType, bool $errorExpected): void
    {
        if ($errorExpected && $messageExpected == 'Leads.email.unique') {
            $lead = \App\Models\Lead::factory()->create();
            $data['email'] = $lead->email;
        }

        $data['recaptchaToken'] = 'testing';

        if ($data['tenant_id'] === false) {
            unset($data['tenant_id']);
        }

        $response = $this->rest()->post('api/leads', $data);

        // dd($response->json());

        if (! $errorExpected) {
            $response->assertJsonStructure([
                'message',
            ]);

            $response->assertJson([
                'message' => __($messageExpected),
            ]);
        }

        if ($errorExpected) {
            $response->assertJsonStructure([
                $errorType,
            ]);

            $response->assertJson([
                $errorType => [__($messageExpected)],
            ]);
        }

        $response->assertStatus($statusCodeExpected);

    }

    public static function errorProvider(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'create register lead, message is string, error' => [
                'data' => [
                    'tenant_id' => $faker->uuid(),
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => null,
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.message.string',
                'errorType' => 'message',
                'errorExpected' => true,
            ],
            'create register lead, experience level is required, error' => [
                'data' => [
                    'tenant_id' => $faker->uuid(),
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => null,
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.experience_level.required',
                'errorType' => 'experience_level',
                'errorExpected' => true,
            ],
            'create register lead, name is required, error' => [
                'data' => [
                    'tenant_id' => $faker->uuid(),
                    'name' => null,
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.name.required',
                'errorType' => 'name',
                'errorExpected' => true,
            ],
            'create register lead, e-mail is required, error' => [
                'data' => [
                    'tenant_id' => $faker->uuid(),
                    'name' => $faker->name(),
                    'email' => null,
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.email.required',
                'errorType' => 'email',
                'errorExpected' => true,
            ],
            'create register lead, e-mail already registered, error' => [
                'data' => [
                    'tenant_id' => $faker->uuid(),
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.email.unique',
                'errorType' => 'email',
                'errorExpected' => true,
            ],
            'create register lead, tenant_id not send, error' => [
                'data' => [
                    'tenant_id' => false,
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.tenant_id.required',
                'errorType' => 'tenant_id',
                'errorExpected' => true,
            ],
            'create register lead, tenant_id not string, error' => [
                'data' => [
                    'tenant_id' => 123,
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 422,
                'messageExpected' => 'Leads.tenant_id.string',
                'errorType' => 'tenant_id',
                'errorExpected' => true,
            ],
        ];
    }

    public static function successProvider(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'create register lead, new functional lead record, success' => [
                'data' => [
                    'tenant_id' => $faker->uuid(),
                    'name' => $faker->name(),
                    'email' => $faker->unique()->safeEmail(),
                    'experience_level' => $faker->randomElement([
                        'beginner',
                        'amateur',
                        'student',
                        'college',
                        'semi-professional',
                        'professional',
                        'intermediate',
                        'coach',
                        'instructor',
                        'other',
                    ]),
                    'message' => $faker->text(),
                ],
                'statusCodeExpected' => 200,
                'messageExpected' => 'Leads.success',
                'errorType' => 'null',
                'errorExpected' => false,
            ],
        ];
    }
}
