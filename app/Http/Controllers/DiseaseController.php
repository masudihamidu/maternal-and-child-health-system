<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\UltrasoundImage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DiseaseController extends Controller
{
    // Function to add disease
    public function storeDisease(Request $request)
    {
        // Validate the request data
        $request->validate([
            'disease_name' => 'required|string',
            'description' => 'required|string',
            'mother_id' => 'required|exists:mothers,id',
            'week' => 'required|in:12,20,26,30,36,38,40',
            'ultrasound_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Retrieve mother_id from the request
        $mother_id = $request->input('mother_id');

        try {
            // Start a transaction
            \DB::beginTransaction();

            // Prepare the data for Disease model
            $data = [
                'disease_name' => $request->input('disease_name'),
                'description' => $request->input('description'),
                'mother_id' => $mother_id,
                'week12' => $request->input('week') == '12',
                'week20' => $request->input('week') == '20',
                'week26' => $request->input('week') == '26',
                'week30' => $request->input('week') == '30',
                'week36' => $request->input('week') == '36',
                'week38' => $request->input('week') == '38',
                'week40' => $request->input('week') == '40',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            // Create a new Disease model and save the data
            $disease = Disease::create($data);

            // Check if the disease is "ultrasound" and an image is uploaded
            if ($request->input('disease_name') == 'ultrasound' && $request->hasFile('ultrasound_image')) {
                $image = $request->file('ultrasound_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->storeAs('public/ultrasound', $imageName);

                // Create UltrasoundImage record
                $ultrasoundImage = new UltrasoundImage();
                $ultrasoundImage->mother_id = $mother_id;
                $ultrasoundImage->image_path = $imageName;
                $ultrasoundImage->disease_id = $disease->id; // Associate with disease
                $ultrasoundImage->save();
            }

            // Log created disease
            Log::info('Created disease:', $disease->toArray());

            // Find the mother and associate the disease
            $mother = Mother::findOrFail($mother_id);
            $mother->diseases()->save($disease);

            // Commit transaction
            \DB::commit();

            // Log successful save
            Log::info('Disease and ultrasound image saved successfully for mother ID:', ['mother_id' => $mother->id]);

            return redirect()->route('motherDisease.addDisease')->with('success', 'Disease form saved successfully.');
        } catch (\Exception $e) {
            // Rollback transaction on error
            \DB::rollback();

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
