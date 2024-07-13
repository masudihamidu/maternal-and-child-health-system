<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaternalCard;
use Illuminate\Support\Facades\Auth;

class MaternalCardLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'maternalCard' => 'required|string',
        ]);

        // Check if maternalCard exists in the maternal table
        $maternal = MaternalCard::where('maternalCard', $request->maternalCard)->first();

        if ($maternal) {
            // MaternalCard exists, log in the user (you may adjust this based on your actual authentication flow)
            Auth::guard('maternal')->login($maternal);

            return redirect()->intended('/dashboard'); // Redirect to dashboard or intended URL after login
        } else {
            // MaternalCard does not exist
            return back()->withErrors(['maternalCard' => 'Invalid maternal card.'])->withInput();
        }
    }
}
