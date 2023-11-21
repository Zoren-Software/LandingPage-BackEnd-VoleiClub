<?php

namespace App\Services;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;

final class DiscordService extends Model
{
    private $webhookErrors;

    private $webhookNewLead;

    private $client;

    /**
     * @codeCoverageIgnore
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;

        $this->webhookErrors = config('services.discord.webhook_errors');
        $this->webhookNewLead = config('services.discord.webhook_new_leads');

        if (!$this->webhookErrors || !$this->webhookNewLead) {
            throw new \Throwable('Variáveis de conexão do Discord não declaradas');
        }
    }

    /**
     * @param  Throwable  $exception
     * @param  string  $message
     *
     * @codeCoverageIgnore
     */
    public function sendError(\Throwable $error, string $author): void
    {
        try {
            $data = [
                'content' => null,
                'embeds' => [
                    [
                        'title' => ':warning: ' . $error->getMessage() . ' :warning:',
                        'description' => $error->getMessage(),
                        'url' => url()->current(),
                        'color' => 16711680,
                        'fields' => [
                            [
                                'name' => 'ERROR Resume:',
                                'value' => 'File: ' . $error->getFile() . " \n In line: " . $error->getLine(),
                            ],
                            [
                                'name' => 'ERROR Code:',
                                'value' => $error->getCode(),
                            ],
                            [
                                'name' => 'APP_ENV:',
                                'value' => config('app.env'),
                            ],
                            [
                                'name' => 'APP_DEBUG:',
                                'value' => config('app.debug'),
                            ]
                        ],
                        'author' => [
                            'name' => 'ERROR ' . $author,
                            'icon_url' => 'https://cdn.icon-icons.com/icons2/1808/PNG/64/bug_115148.png',
                        ],
                        'timestamp' => date('Y-m-d H:i:s'),
                    ],
                ],
            ];

            if (auth()->user()) {
                $data['embeds'][0]['fields'][] = [
                    'name' => 'User ID:',
                    'value' => auth()->user()->id,
                ];
            }

            $this->client->post(
                $this->webhookErrors,
                [
                    'json' => $data,
                ]
            );
        } catch (ClientException $e) {
            throw new \Throwable('Erro ao enviar mensagem para o Discord');
        }
    }

    /**
     * @param  Throwable  $exception
     * @param  string  $message
     *
     * @codeCoverageIgnore
     */
    public function sendNewLead(Lead $lead): void
    {
        try {
            $data = [
                'content' => null,
                'embeds' => [
                    [
                        'title' => 'New Lead registered in the system Landing Page',
                        'description' => 'Data New Lead:',
                        'url' => url()->current(),
                        'color' => 65280,
                        'fields' => [
                            [
                                'name' => 'Name:',
                                'value' => $lead->name,
                            ],
                            [
                                'name' => 'E-mail:',
                                'value' => $lead->email,
                            ],
                            [
                                'name' => 'Experience Level:',
                                'value' => $lead->experience_level,
                            ],
                            [
                                'name' => 'Message:',
                                'value' => $lead->message,
                            ],
                            [
                                'name' => 'APP_ENV:',
                                'value' => config('app.env'),
                            ],
                            [
                                'name' => 'APP_DEBUG:',
                                'value' => config('app.debug'),
                            ]
                        ],
                        'author' => [
                            'name' => 'Landing Page',
                            'icon_url' => 'https://cdn-icons-png.flaticon.com/128/4315/4315445.png',
                        ],
                        'timestamp' => date('Y-m-d H:i:s'),
                    ],
                ],
            ];

            if (auth()->user()) {
                $data['embeds'][0]['fields'][] = [
                    'name' => 'User ID:',
                    'value' => auth()->user()->id,
                ];
            }

            $this->client->post(
                $this->webhookNewLead,
                [
                    'json' => $data,
                ]
            );
        } catch (ClientException $e) {
            throw new \Throwable('Erro ao enviar mensagem para o Discord');
        }
    }
}
