<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use App\Models\Disease;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DiseaseController extends Controller
{
    // Function to add disease
    public function storeDisease(Request $request)
    {
        // Validate the request data
        $request->validate([
            // Disease information
            'disease_name' => 'required|string',
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

        // Log request data for debugging
        Log::info('Request data:', $request->all());

        // Create a new Disease model and save the data
        try {
            $disease = Disease::create([
                'disease_name' => $request->input('disease_name'),
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

            // Log created disease
            Log::info('Created disease:', $disease->toArray());

            // Find the mother and associate the disease
            $mother = Mother::findOrFail($request->input('mother_id'));
            $mother->diseases()->save($disease);

            // Log successful save
            Log::info('Disease saved successfully for mother ID:', ['mother_id' => $mother->id]);

            return redirect()->route('motherDisease.addDisease')->with('success', 'Disease form saved successfully.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to save disease form:', ['error' => $e->getMessage()]);

            // Return with an error message if save was not successful
            return redirect()->route('motherDisease.addDisease')->with('error', 'Failed to save the Disease form. Please try again.');
        }
    }

    public function addDisease(Request $request)
    {
        $id = $request->query('id');
        $mother_firstname = $request->query('name');
        $mother_lastname = $request->query('sname');
        return view('motherDisease', compact('id', 'mother_firstname', 'mother_lastname'));
    }
}
