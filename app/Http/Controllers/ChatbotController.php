<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer  ' . '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',
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

            $answer = $response->json('choices.0.message.content');

            return view('chat', [
                'answer' => $answer,
                ]);
        } catch (\Exception $e) {([
                'error' => $e->getMessage(),    
            ]);
        }
    }
}
