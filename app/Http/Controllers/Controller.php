<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackAlert;


Notification::route('slack', config('services.slack.webhook_url'))
    ->notify(new SlackAlert('📂 New file uploaded by ' . auth()->user()->name));

// Record deleted
Notification::route('slack', config('services.slack.webhook_url'))
    ->notify(new SlackAlert('❌ A record was deleted by ' . auth()->user()->name));

abstract class Controller
{


}
