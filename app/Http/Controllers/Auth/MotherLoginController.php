<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mother;
use Illuminate\Support\Facades\Log;

class MotherLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('mother_firstname', 'mother_lastname');

        // Log the input received
        Log::info('Input received: ' . json_encode($credentials));

        $mother = Mother::where('mother_firstname', $credentials['mother_firstname'])
                        ->where('mother_lastname', $credentials['mother_lastname'])
                        ->first();

        // Log the SQL query and result
        $query = Mother::where('mother_firstname', $credentials['mother_firstname'])
                       ->where('mother_lastname', $credentials['mother_lastname'])
                       ->toSql();

        Log::info('Mother login query: ' . $query);
        Log::info('Mother found: ' . ($mother ? 'Yes' : 'No'));

        if ($mother) {
            return redirect(route('dashboard', absolute: false));
        } else {
            // Handle case where mother is not found
            return back()->withErrors(['message' => 'Invalid mother credentials.'])->withInput();
        }
    }
}
