<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaternalCard;
use App\Models\Mother;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MaternalCardLoginController extends Controller
{
    /**
     * Handle maternal card login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'maternalCard' => 'required|string',
        ]);

        // Check if maternalCard exists in the maternal_cards table
        $maternal = MaternalCard::where('maternalCard', $request->maternalCard)->first();

        if ($maternal) {
            // MaternalCard exists, log in the user using the 'maternal' guard
            Auth::guard('maternal')->login($maternal);

            // Confirm the user is authenticated
            if (Auth::guard('maternal')->check()) {
                $user = Auth::guard('maternal')->user();
                // Fetch mother details associated with the maternal card
                $mother = Mother::with(['diseases', 'immunities', 'ultrasoundImages', 'services'])
                                ->find($maternal->mother_id);

                if ($mother) {
                    // Group diseases, immunities, services, and fetch ultrasound images
                    $diseases = $mother->diseases->groupBy('disease_name');
                    $immunities = $mother->immunities->groupBy('immunity_name');
                    $services = $mother->services->groupBy('service_name');
                    $ultrasoundImages = $mother->ultrasoundImages;

                    // Check if the mother has associated data
                    $hasAssociatedData = $mother->father()->exists() &&
                        $mother->siblings()->exists() &&
                        $mother->localChairman()->exists() &&
                        $mother->healthProfessional()->exists() &&
                        $mother->pregnancySummary()->exists() &&
                        $mother->motherBackground()->exists();

                    // Return the maternal dashboard view with necessary data
                    return view('maternalAuth.maternalDashboard', compact(
                        'mother', 'diseases', 'immunities', 'services', 'ultrasoundImages', 'hasAssociatedData'
                    ));
                } else {
                    // If mother details not found, redirect to registration or appropriate view
                    return redirect()->route('mother_register.index')->with('error', 'Mother details not found.');
                }
            } else {
                // If the user is not authenticated, redirect back with an error message
                return back()->withErrors(['maternalCard' => 'Failed to authenticate user.'])->withInput();
            }
        } else {
            // MaternalCard does not exist, redirect back with error message
            return back()->withErrors(['maternalCard' => 'Invalid maternal card.'])->withInput();
        }
    }

    /**
     * Log out the maternal user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('maternal')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
