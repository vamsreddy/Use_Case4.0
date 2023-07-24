<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
//use App\Models\Search;

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
