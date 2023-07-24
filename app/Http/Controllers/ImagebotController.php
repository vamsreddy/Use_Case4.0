<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\OpenAIHelper;

class ImagebotController extends Controller
{
     public function image(Request $request)
    {
        $prompt = $request->input('prompt');
        
        $apiKey = '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'; 

        $response = OpenAIHelper::generateImage($prompt, $apiKey);
    
        $image = $response['data'][0]['url'];

        return view('image', [
            'image' => $image,
        ]);   
    }
}
