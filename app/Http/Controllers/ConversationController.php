<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    public function showConversation()
    {
        return view('openAI.openAi');
    }

    public function importJson()
    {
        try {
            // Read JSON file from public directory
            $json = file_get_contents(public_path('json/conversationData.json'));

            // Decode JSON data
            $data = json_decode($json, true);

            // Ensure $data is an array
            if (!is_array($data)) {
                throw new \Exception('Invalid JSON format');
            }

            // Loop through each item and save to database
            foreach ($data as $item) {
                Conversation::create([
                    'contact' => $item['contact'],
                    'channel' => $item['channel'],
                    'date' => now()->parse($item['date']),
                ]);
            }

            return response()->json(['message' => 'Data imported successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to import data: ' . $e->getMessage()], 500);
        }
    }
}
