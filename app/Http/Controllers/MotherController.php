<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use App\Models\Father;
use App\Models\Disease;
use App\Models\MotherBackground;
use App\Models\Sibling;
use App\Models\PregnancySummary;
use App\Models\LocalChairman;
use App\Models\HealthProfessional;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MotherController extends Controller
{
    public function index()
    {
        return view('mother_register');
    }

    public function motherDetails(Request $request)
{
    $id = $request->query('id');
    $mother_firstname = $request->query('name');
    $mother_lastname = $request->query('sname');

    $mother = Mother::find($id);

      // Fetch diseases from the database
      $diseases = Disease::all();

    // Check if the mother exists
    if (!$mother) {
        return redirect()->route('mother_register.index')->with('error', 'Mother not found.');
    }

    // Check if the mother has associated data
    $hasAssociatedData = $mother->father()->exists() &&
     $mother->siblings()->exists() &&
     $mother->localChairman()->exists() &&
     $mother->healthProfessional()->exists() &&
     $mother->pregnancySummary()->exists() &&
     $mother->motherBackground()->exists();

    if ($hasAssociatedData) {
        return view('motherDetails', compact('id', 'mother_firstname', 'mother_lastname', 'diseases'));
    } else {
        return view('motherInformation', compact('id', 'mother_firstname', 'mother_lastname'));

    }
}


    public function showClinicProgress()
    {
        return view('motherDetails');
    }

    public function showRegisteredExpectant()
    {
        $mother = Mother::select('id', 'mother_firstname', 'mother_lastname', 'mother_dob', 'mother_phone_number', 'education', 'occupation', 'marital_status')
            ->orderBy('mother_firstname')
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

    public function submitForm(Request $request)
    {
        // Validate the request data
        $request->validate([
            'mother_id' => 'required|exists:mothers,id',
            // Father information
            'father_firstname' => 'required|string',
            'father_middlename' => 'required|string',
            'father_surname' => 'required|string',
            'father_phone_number' => ['required', 'string', 'regex:/^255\d{9}$/'],
            'father_education' => 'required|string',
            'father_occupation' => 'required|string',
            // Sibling information
            'sibling_firstname' => 'required|string',
            'sibling_middlename' => 'required|string',
            'sibling_surname' => 'required|string',
            'sibling_phone_number' => ['required', 'string', 'regex:/^255\d{9}$/'],
            // Local Chairman information
            'chairman_name' => 'required|string',
            'chairman_phone_number' => ['required', 'string', 'regex:/^255\d{9}$/'],
            // health care professional information
            'professional_name' =>'required|string',
            'rank' =>'required|string',
            // pregnancy summary
            'lnmp' => 'required|date',
            'edd' => 'required|date',
            'menstrual_cycle' => 'required|numeric',
            'normal_cycle' => 'required|string',
            // mother background
            'allergy' => 'required|string',
            'gravidity' => 'required|numeric',
            'parity' => 'required|numeric',
            'childrens_born_niti' => 'required|numeric',
            'miscarriages' => 'required|numeric',
            'out_of_pocket' => 'required|numeric',
            'died_child' => 'required|numeric',
            'living_children' => 'required|numeric',
        ]);

        // Retrieve mother_id from the request
        $mother_id = $request->input('mother_id');

        // Create and save Father
        $father = Father::create([
            'father_firstname' => $request->input('father_firstname'),
            'father_middlename' => $request->input('father_middlename'),
            'father_surname' => $request->input('father_surname'),
            'father_phone_number' => $request->input('father_phone_number'),
            'father_education' => $request->input('father_education'),
            'father_occupation' => $request->input('father_occupation'),
            'mother_id' => $mother_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create and save Sibling
        $sibling = Sibling::create([
            'sibling_firstname' => $request->input('sibling_firstname'),
            'sibling_middlename' => $request->input('sibling_middlename'),
            'sibling_surname' => $request->input('sibling_surname'),
            'sibling_phone_number' => $request->input('sibling_phone_number'),
            'mother_id' => $mother_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create and save Local Chairman
        $localChairman = LocalChairman::create([
            'chairman_name' => $request->input('chairman_name'),
            'chairman_phone_number' => $request->input('chairman_phone_number'),
            'mother_id' => $mother_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

      //    Create and save healthcare professional
       $healthCareProfessional = HealthProfessional::create([
        'professional_name' => $request->input('professional_name'),
        'rank' => $request->input('rank'),
        'mother_id' => $request->input('mother_id'),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);

        //    Create and save pregnancy summary
        $pregnancySummary = PregnancySummary::create([
            'lnmp' => $request->input('lnmp'),
            'edd' => $request->input('edd'),
            'menstrual_cycle' => $request->input('menstrual_cycle'),
            'normal_cycle' => $request->input('normal_cycle'),
            'mother_id' => $request->input('mother_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);

          //    Create and save mother background
        $motherBackground = MotherBackground::create([
            'allergy' => $request->input('allergy'),
            'gravidity' => $request->input('gravidity'),
            'parity' => $request->input('parity'),
            'childrens_born_niti' => $request->input('childrens_born_niti'),
            'miscarriages' => $request->input('miscarriages'),
            'out_of_pocket' => $request->input('out_of_pocket'),
            'died_child' => $request->input('died_child'),
            'living_children' => $request->input('living_children'),
            'mother_id' => $request->input('mother_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
          ]);


        // Redirect or return a response
        if ($father && $sibling && $localChairman && $healthCareProfessional && $pregnancySummary && $motherBackground ) {
            return redirect()->route('motherDetails.showClinicProgress')->with('success', 'Form saved successfully.');
        } else {
            // Return with an error message if save was not successful
            return redirect()->route('motherInformation.motherDetails')->with('error', 'Failed to save the form. Please try again.');
        }
    }

    public function getTotal()
    {
        return Mother::count();
    }

    public function getTotalToday()
    {
        return Mother::whereDate('created_at', Carbon::today())->count();
    }

    public function getTotalThisMonth()
    {
        return Mother::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
    }

    public function getTotalThisYear()
    {
        return Mother::whereYear('created_at', Carbon::now()->year)->count();
    }
}
