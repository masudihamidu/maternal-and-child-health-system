<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    private $huggingFaceApiKey;

    public function __construct()
    {
        $this->huggingFaceApiKey = env('HUGGINGFACE_API_KEY');
    }

    public function sendChat(Request $request)
    {
        $client = new Client();
        $generatedText = '';
        $conversation = $request->session()->get('conversation', []);

        try {
            $response = $client->post('https://api-inference.huggingface.co/models/gpt2', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->huggingFaceApiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'inputs' => $request->input('prompt'),
                ],
            ]);

            $body = json_decode((string) $response->getBody(), true);

            // Log the response body for debugging
            Log::info('Hugging Face API Response: ' . json_encode($body));

            // Check if the response body contains the generated text
            if (isset($body[0]['generated_text'])) {
                $generatedText = $body[0]['generated_text'];
            } elseif (isset($body['generated_text'])) {
                $generatedText = $body['generated_text'];
            } else {
                $generatedText = 'Unexpected response structure: ' . json_encode($body);
            }

            // Append user input and response to the conversation
            $conversation[] = [
                'user' => $request->input('prompt'),
                'bot' => $generatedText
            ];

            // Save the conversation in session
            $request->session()->put('conversation', $conversation);

        } catch (\Exception $e) {
            $generatedText = 'Error: ' . $e->getMessage();
        }

        // Return the generated text along with the conversation
        return view('openAI.openAi', ['conversation' => $conversation]);
    }

    public function showAIPage(Request $request)
    {
        // Clear conversation history when accessing the chat page
        $request->session()->forget('conversation');
        return view('openAI.openAi', ['conversation' => []]);
    }
}
