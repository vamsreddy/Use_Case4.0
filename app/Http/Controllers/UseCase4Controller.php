<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class UseCase4Controller extends Controller
{
    public function index()
    {
        $query = "User wants to purchase an electric appliance - Refrigerator from the website
        List of 5 all electrical product category
        List at least 5 company refrigerators with model no., duration of warranty, year of manufacture, capacity, size, cooling technology, price per category
        Display special offers for each item or by category
        Display the final price including GST depending on the city of delivery	
        Display category of service and installation
        Display nearest stores from where Refrigerator can be purchased through offline/online
        Using  telangana as state/Hyderabad as city/Area Pincode : Available dealers in the area
        List of dealers on top which have good ratings
        After choosing the dealers, displaying contact details of them
        If the user wants to purchase online, suggest deals with other electronics products and if the user doesn’t agree with the suggestion then navigate to the electrical product category.
        Suggesting payment gateway options with discounts";

        $response = $this->generateChatResponse($query);

        return view('products', ['response' => $response]);
    }

    private function generateChatResponse($query)
    {
        $apiKey = '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';
        $apiEndpoint = 'https://api.openai.com/v1/chat/completions';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ])->timeout(60)->post($apiEndpoint, [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a customer looking to buy a refrigerator.'],
                ['role' => 'user', 'content' => $query],
            ],
        ]);

        $responseData = $response->json(); // Parse the JSON response

        return $responseData['choices'][0]['message']['content'];
    }

}
