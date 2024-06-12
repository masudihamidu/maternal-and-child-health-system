<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\Immunity;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ImmunityController extends Controller
{
    //
    public function storeImmunity(Request $request)
    {
        // Validate the request data
        $request->validate([
            //immunity information
            'immunity_name' => 'required|string',
            'description' => 'required|string',
            'mother_id' => 'required|exists:mothers,id',
            // Week columns
            'week12' => 'sometimes|boolean',
            'week20' => 'sometimes|boolean',
            'week26' => 'sometimes|boolean',
            'week30' => 'sometimes|boolean',
            'week36' => 'sometimes|boolean',
            'week38' => 'sometimes|boolean',
            'week40' => 'sometimes|boolean',
        ]);

        try {
            // Log request data for debugging
            Log::info('Request data:', $request->all());

            // Create a new ImmunityForm model and save the data
            $immunity = Immunity::create([
                'immunity_name' => $request->input('immunity_name'),
                'description' => $request->input('description'),
                'mother_id' => $request->input('mother_id'),
                'week12' => $request->input('week12', false),
                'week20' => $request->input('week20', false),
                'week26' => $request->input('week26', false),
                'week30' => $request->input('week30', false),
                'week36' => $request->input('week36', false),
                'week38' => $request->input('week38', false),
                'week40' => $request->input('week40', false),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Log created immunity
            Log::info('Immunity disease:', $immunity->toArray());

            // Find the mother and associate the immunity
            $mother = Mother::findOrFail($request->input('mother_id'));
            $mother->immunities()->save($immunity);

            // Log successful save
            Log::info('Immunity saved successfully for mother ID:', ['mother_id' => $mother->id]);

            // Redirect or return a response
            return redirect()->route('motherImmunity.addImmunity')->with('success', 'Immunity form saved successfully.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to save immunity form:', ['error' => $e->getMessage()]);

            // Return with an error message if save was not successful
            return redirect()->route('motherImmunity.addImmunity')->with('error', 'Failed to save the Immunity form. Please try again.');
        }
    }


    public function addImmunity(Request $request)
    {
        $id = $request->query('id');
        $mother_firstname = $request->query('name');
        $mother_lastname = $request->query('sname');

        return view('motherImmunity', compact('id', 'mother_firstname', 'mother_lastname'));
    }
}
