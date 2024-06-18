<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function importJson()
    {
        // Read JSON file from public directory
        $json = file_get_contents(public_path('json/conversationData.json'));

        // Decode JSON data
        $data = json_decode($json, true);

        // Loop through each item and save to database
        foreach ($data as $item) {
            Conversation::create([
                'message' => $item['message'],
                'response' => $item['response'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json(['message' => 'Data imported successfully']);
    }
}
