<?php

namespace App\Http\Controllers;

use App\Models\MaternalCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaternalCardsAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('maternal_cards.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('maternalCard');

        if (Auth::guard('maternal_cards')->attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('/dashboard');
        }

        return back()->withErrors([
            'maternalCard' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout()
    {
        Auth::guard('maternal_cards')->logout();

        return redirect()->route('maternal-cards.login');
    }

    public function dashboard()
    {
        return view('maternal_cards.dashboard');
    }
}
