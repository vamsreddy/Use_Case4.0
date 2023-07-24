<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function processInput(Request $request)
    {
        $inputText = $request->input('input_text');

        // Save the input to input.txt
        file_put_contents(public_path('input.txt'), $inputText);

        // Process the input using the OpenAI API (replace 'YOUR_API_KEY' with your actual API key)
        $response = $this->sendOpenAIRequest($inputText);

        if ($response['status'] === 'success') {
            // Get the generated output from the OpenAI API response
            $outputText = $response['data']['choices'][0]['message']['content'];
            // Save the output to output.txt
            file_put_contents(public_path('output.txt'), $outputText);

            return redirect()->back()->with('success', 'Input processed successfully! Check output.txt for the results.');
        } else {
            return redirect()->back()->with('error', 'Error processing input. Please try again later.');
        }
    }

    private function sendOpenAIRequest($inputText)
    {
        $apiKey = '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';
        $apiEndpoint = 'https://api.openai.com/v1/chat/completions';

        $headers = [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json',
        ];

        $data = [
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0.2,
            'messages' =>  array(
                array("role" => "user", "content" => $inputText)
            ),
            'max_tokens' => 100,
        ];

        $ch = curl_init($apiEndpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus === 200) {
            return ['status' => 'success', 'data' => json_decode($response, true)];
        } else {
            return ['status' => 'error'];
        }
    }
}
