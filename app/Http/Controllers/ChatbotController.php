<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatbotController extends Controller
{
    public function sendChat(Request $request){
        $result = OpenAI::completions()->create([
            'max_tokens' => 100,
            'model' => 'gpt-3.5-turbo',
            'prompt' => $request->input

        ]);

        $response = array_reduce(
            $result->toArray()['choices'],
            fn(string $result, array $choice) => $result . $choice['text'], ""
        );

        dd($response);

        // return $response;

    }


    public function showAIPage()
    {
        return view('openAI.openAi');
    }
}
