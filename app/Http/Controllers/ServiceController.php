<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $id = $request->query('id');
        $mother_firstname = $request->query('name');
        $mother_lastname = $request->query('sname');
        return view('motherService', compact('id', 'mother_firstname', 'mother_lastname'));
    }

    public function storeService(Request $request)
    {
        // Validate the request data
        $request->validate([
            'service_name' => 'required|string',
            'description' => 'required|string',
            'mother_id' => 'required|exists:mothers,id',
            'weeks' => 'required|in:12,20,26,30,36,38,40',
        ]);

        try {
            // Log request data for debugging
            Log::info('Request data:', $request->all());

            // Prepare the data
            $data = [
                'service_name' => $request->input('service_name'),
                'description' => $request->input('description'),
                'mother_id' => $request->input('mother_id'),
                'week12' => $request->input('weeks') == '12',
                'week20' => $request->input('weeks') == '20',
                'week26' => $request->input('weeks') == '26',
                'week30' => $request->input('weeks') == '30',
                'week36' => $request->input('weeks') == '36',
                'week38' => $request->input('weeks') == '38',
                'week40' => $request->input('weeks') == '40',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            // Create a new Immunity model and save the data
            $service = Service::create($data);

            // Log created immunity
            Log::info(' service:', $service->toArray());

            // Find the mother and associate the immunity
            $mother = Mother::findOrFail($request->input('mother_id'));
            $mother->services()->save($service);

            // Log successful save
            Log::info('Service saved successfully for mother ID:', ['mother_id' => $mother->id]);

            // Redirect or return a response
            return redirect()->route('motherService')->with('success', 'Service form saved successfully.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to save service form:', ['error' => $e->getMessage()]);

            // Return with an error message if save was not successful
            return redirect()->route('motherService')->with('error', 'Failed to save the Service form. Please try again.');
        }
    }
}
