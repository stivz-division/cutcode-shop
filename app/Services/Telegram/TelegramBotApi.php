<?php

namespace App\Services\Telegram;

use App\Exceptions\Telegram\TelegramFailedSendMessageException;
use Illuminate\Support\Facades\Http;

class TelegramBotApi
{
    public const HOST = 'https://api.telegram.org/bot';


    /**
     * @param string $token
     * @param int $chatId
     * @param string $text
     * @return bool
     * @throws TelegramFailedSendMessageException
     */
    public static function sendMessage(string $token, int $chatId, string $text): bool
    {
        try {
            $response = Http::get(self::HOST . $token . '/sendMessage', [
                'chat_id' => $chatId,
                'text' => $text
            ])->throw()->json();

            return $response['ok'] ?? false;
        } catch (\Throwable $exception) {
            report(new TelegramFailedSendMessageException($exception->getMessage()));

            return false;
        }
    }
}
