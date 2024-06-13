<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;

class ConversationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'response' => 'required|string|max:255',
        ]);

        $conversation = new Conversation();
        $conversation->question = $request->input('question');
        $conversation->response = $request->input('response');
        $conversation->save();

        return response()->json(['success' => true]);
    }

}
