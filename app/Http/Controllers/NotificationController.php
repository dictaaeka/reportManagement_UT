<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Tandai satu notification sebagai sudah dibaca.
     */
    public function markAsRead(string $notification): RedirectResponse
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        $user->notifications()
            ->where('id', $notification)
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }

    /**
     * Tandai semua notification sebagai sudah dibaca.
     */
    public function markAllAsRead(): RedirectResponse
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        $user->unreadNotifications()->update([
            'read_at' => now(),
        ]);

        return back();
    }
}