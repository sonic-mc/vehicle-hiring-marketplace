<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackAlert;
use Throwable;

class ExceptionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(ExceptionHandler::class, function ($handler, $app) {
            return new class($handler) implements ExceptionHandler {
                protected $handler;

                public function __construct($handler)
                {
                    $this->handler = $handler;
                }

                public function report(Throwable $e): void
                {
                    if (app()->environment('production')) {
                        Notification::route('slack', config('services.slack.webhook_url'))
                            ->notify(new SlackAlert('🚨 ' . $e->getMessage()));
                    }

                    $this->handler->report($e);
                }

                public function render($request, Throwable $e)
                {
                    return $this->handler->render($request, $e);
                }

                public function renderForConsole($output, Throwable $e): void
                {
                    $this->handler->renderForConsole($output, $e);
                }

                public function shouldReport(Throwable $e): bool
                {
                    return $this->handler->shouldReport($e);
                }
            };
        });
    }

    public function boot(): void {}
}
