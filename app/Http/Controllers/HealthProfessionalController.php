<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\HealthProfessional;

class HealthProfessionalController extends Controller
{
    public function storeLocalChairman(Request $request)
    {
        // Validate the request data
        $request->validate([
            //mother information
            'professional_name' => 'required|string',
            'rank' => ['required|string'],
            'mother_id' => 'required|exists:mothers,id',
        ]);



        // Create a new ExpectantForm model and save the data
        $healthProfessional = HealthProfessional::create([
            'professional_name' => $request->input('professional_name'),
            'rank' => $request->input('rank'),
            'mother_id' => $request->input('mother_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect or return a response
        if ($healthProfessional->save()) {
            return redirect()->route('motherInformation.motherDetails')->with('success', 'Health professional form saved successfully.');
        }else {
            // Return with an error message if save was not successful
            return redirect()->route('motherInformation.motherDetails')->with('error', 'Failed to save the health professional. Please try again.');
        }

    }
}
