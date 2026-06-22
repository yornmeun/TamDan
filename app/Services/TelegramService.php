<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;


class TelegramService {
    public static function sendMessage(string $message, ?string $chatId): void
    {
        $token = config('services.telegram.bot_token');
        $chatId ??= config('services.telegram.chat_id');

        if (! $chatId || ! $token) {
            return;
        }
  
        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML',
        ]);

    }
}
