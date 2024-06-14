<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use Illuminate\Support\Facades\Log;

class ConversationController extends Controller
{

    public function showConversation()
    {
        return view('ConversationAI.conversationAI');
    }


    public function store(Request $request)
    {
        Log::info('Incoming request data', $request->all());

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'response' => 'required|string|max:255',
        ]);

        Log::info('Validation passed', $validated);

        $conversation = new Conversation();
        $conversation->question = $validated['question'];
        $conversation->response = $validated['response'];
        $conversation->save();

        return response()->json(['success' => true]);
    }
}
