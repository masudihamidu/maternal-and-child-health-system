<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Mother;
use Carbon\Carbon;



class ConversationController extends Controller
{
    public function showConversation()
    {
        return view('openAI.openAi');
    }

    public function fetchDailyData()
{
    $data = Conversation::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->get();

    return response()->json($data);
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



    public function showAnalytics(Request $request)
    {
        try {
            $conversations = Conversation::all();
            $wordFrequencies = $this->calculateWordFrequencies($conversations);

            $mothersImmunity =  Mother::whereHas('immunities', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })->count();

            return view('dashboard', compact('wordFrequencies','mothersImmunity'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch analytics data: ' . $e->getMessage()], 500);
        }
    }

    private function calculateWordFrequencies($conversations)
    {
        $wordFrequencies = [];

        foreach ($conversations as $conversation) {
            $words = explode(' ', $conversation->message);
            foreach ($words as $word) {
                $word = strtolower(trim($word, ".,!?\"'")); // Normalize word
                if (!empty($word)) {
                    if (isset($wordFrequencies[$word])) {
                        $wordFrequencies[$word]++;
                    } else {
                        $wordFrequencies[$word] = 1;
                    }
                }
            }
        }

        return $wordFrequencies;
    }

}
