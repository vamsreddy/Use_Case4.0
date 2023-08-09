<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UseCase30 extends Controller
{
    public function showMenu()
    {
        return view('menu');
    }

    public function processChoice($choice)
    {
        switch ($choice) {
            case 'i':
                return view('prompt', ['type' => 'answer']);
            case 'ii':
                return view('prompt', ['type' => 'code']);
            case 'iii':
                return view('prompt', ['type' => 'suggestion']);
            default:
                return redirect()->route('menu')->with('error', 'Invalid choice.');
        }
    }

    public function generateResponse(Request $request)
    {
        $prompt = $request->input('prompt');
        $response = $this->callOpenAIAPI($prompt);

        return view('response', ['response' => $response]);
    }

    private function callOpenAIAPI($prompt)
    {
        $apiKey = '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';
        $apiEndpoint = 'https://api.openai.com/v1/chat/completions';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post($apiEndpoint, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 1000,  // Adjust this as needed
        ]);

        $responseData = $response->json(); // Parse the JSON response

        return $responseData['choices'][0]['message']['content'];
    }

    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'response' => 'required',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = $request->input('response');
        $email = $request->input('email');

        Mail::send('email-response', ['response' => $response], function ($message) use ($email) {
            $message->to($email)->subject('Chatbot Response');
        });

        return redirect()->back()->with('success', 'Email sent successfully.');
    }

    public function showEmailResponse()
    {
        // Simulate or retrieve the email response content
        $response = "This is the email response content.";

        return View::make('email-response', ['response' => $response]);
    }
}
