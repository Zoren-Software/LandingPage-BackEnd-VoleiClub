<?php

namespace App\Exceptions;

use App\Services\DiscordService;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if (env('APP_ENV') === 'production') {
                if ($this->shouldReport($e)) {
                    $clientDiscord = new GuzzleClient();
                    $discord = new DiscordService($clientDiscord);
                    $discord->sendError($e, 'Laravel Handler');
                }
            }
        });
    }
}
