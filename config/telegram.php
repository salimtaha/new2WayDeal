<?php

return
    [
        'bot_token' => env('TELEGRAM_BOT_TOKEN'),
        'chat_ids' => [
            'amr' => env('TELEGRAM_Amr_ID'),
            'alaa' => env('TELEGRAM_Alaa_ID'),
            'lubna' => env('TELEGRAM_Lubna_ID'),
            'group' => env('TELEGRAM_GROUP_ID')
        ]
    ];
?>
