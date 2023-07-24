<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class OpenAIHelper
{
    public static function generateImage($prompt, $apiKey)
    {
        $client = new Client();
        
        $response = $client->post('https://api.openai.com/v1/images/generations', [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'prompt' => $prompt,
            ],
        ]);

        return json_decode($response->getBody($prompt), true);
    }
}
