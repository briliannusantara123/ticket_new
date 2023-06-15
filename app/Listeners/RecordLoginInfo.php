<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class RecordLoginInfo
{
    public function handle(Login $event)
    {
        $event->user->forceFill([
            'last_login' => Carbon::now()->toDateTimeString(),
        ])->save();
    }
}
