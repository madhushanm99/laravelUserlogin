<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckIfUserIsActive
{
    public function handle(Attempting $event)
    {
        $user = User::where('email', $event->credentials['email'])->first();

        if ($user && !$user->status) {
            // Optionally log the attempt
            Log::info('Deactivated user attempted to log in.', ['email' => $user->email]);

            // Abort the login attempt
            abort(403, 'Your account is deactivated.');
        }
    }
}

