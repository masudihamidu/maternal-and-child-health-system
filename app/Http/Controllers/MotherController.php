<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use App\Models\Immunity;
use Illuminate\Http\Request;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Disease;


class MotherController extends Controller
{
    public function index()
    {
        return view('mother_register');

    }

    public function showRegisteredExpectant(){
        $mother = Mother::select('mother_firstname','mother_dob','mother_phone_number','education','occupation','marital_status')
        ->orderBY('mother_firstname')
        ->get();

        return view('registered_mothers', compact('mother'));

    }


    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            //mother information
            'mother_firstname' => 'required|string',
            'mother_secondname' => 'required|string',
            'mother_lastname' => 'required|string',
            'mother_dob' => 'required|date',
            'mother_phone_number' => ['required','string','regex:/^255\d{9}$/'],
            'education' => 'required|string',
            'occupation' => 'required|string',
            'marital_status' => 'required|string',
        ]);

        // Create a new ExpectantForm model and save the data
        $mother = Mother::create([
            'mother_firstname' => $request->input('mother_firstname'),
            'mother_secondname' => $request->input('mother_secondname'),
            'mother_lastname' => $request->input('mother_lastname'),
            'mother_dob' => $request->input('mother_dob'),
            'mother_phone_number' => $request->input('mother_phone_number'),
            'education' => $request->input('education'),
            'occupation' => $request->input('occupation'),
            'marital_status' => $request->input('marital_status'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect or return a response
        if ($mother->save()) {
            return redirect()->route('mother_register.index')->with('success', 'Expectant form saved successfully.');
        }else {
            // Return with an error message if save was not successful
            return redirect()->route('mother_register.index')->with('error', 'Failed to save the expectant form. Please try again.');
        }

    }

    public function getTotal(){
        return Mother::count();
    }

    public function getTotalToday(){
        return Mother:: whereDate('created_at', Carbon::today())->count();
    }

  



}
