<?php

namespace App\Http\Controllers;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    public function showConversation()
    {
        return view('openAI.openAi');
    }

    public function showAnalytics()
    {
        $conversations = Conversation::all();
        return view('analytics', compact('conversations'));
    }

    public function importJson()
    {
        try {

            $json = file_get_contents(public_path('json/conversationData.json'));

            // Decode JSON data
            $data = json_decode($json, true);

            if (!is_array($data)) {
                throw new \Exception('Invalid JSON format');
            }

            foreach ($data as $item) {
                $validator = Validator::make($item, [
                    'time' => 'required|string',
                    'message' => 'required|string',
                    'response' => 'required|string',
                ]);

                if ($validator->fails()) {
                    throw new \Exception('Validation failed: ' . implode(', ', $validator->errors()->all()));
                }

                Conversation::create([
                    'message' => $item['message'],
                    'response' => $item['response'],
                    'time' => $item['time'],
                ]);
            }

            return response()->json(['message' => 'Data imported successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to import data: ' . $e->getMessage()], 500);
        }
    }
}
