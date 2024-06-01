<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use App\Models\Immunity;
use App\Models\Father;
use App\Models\Sibling;
use App\Models\LocalChairman;
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

    public function motherDetails(Request $request)
    {
        $id = $request->query('id');
        $mother_firstname = $request->query('name');
        $mother_lastname = $request->query('sname');

        return view('motherInformation', compact('id', 'mother_firstname', 'mother_lastname'));

    }


    public function showClinicProgress()
    {
        return view('clinicProgress');

    }

    public function showRegisteredExpectant(){
        $mother = Mother::select('id','mother_firstname','mother_lastname','mother_dob','mother_phone_number','education','occupation','marital_status')
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


    public function storeFather(Request $request)
    {
        // Validate the request data
        $request->validate([
            //mother information
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'surname' => 'required|string',
            'phone_number' => ['required','string','regex:/^255\d{9}$/'],
            'education' => 'required|string',
            'occupation' => 'required|string',
            'mother_id' => 'required|exists:mothers,id',
        ]);



        // Create a new ExpectantForm model and save the data
        $father = Father::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'surname' => $request->input('surname'),
            'phone_number' => $request->input('phone_number'),
            'education' => $request->input('education'),
            'occupation' => $request->input('occupation'),
            'mother_id' => $request->input('mother_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect or return a response
        if ($father->save()) {
            return redirect()->route('motherInformation.motherDetails')->with('success', 'Father form saved successfully.');
        }else {
            // Return with an error message if save was not successful
            return redirect()->route('motherInformation.motherDetails')->with('error', 'Failed to save the father form. Please try again.');
        }

    }


    public function storeSibling(Request $request)
    {
        // Validate the request data
        $request->validate([
            //mother information
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'surname' => 'required|string',
            'phone_number' => ['required','string','regex:/^255\d{9}$/'],
            'mother_id' => 'required|exists:mothers,id',
        ]);



        // Create a new ExpectantForm model and save the data
        $sibling = Sibling::create([
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'surname' => $request->input('surname'),
            'phone_number' => $request->input('phone_number'),
            'mother_id' => $request->input('mother_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect or return a response
        if ($sibling->save()) {
            return redirect()->route('motherInformation.motherDetails')->with('success', 'Close relative form saved successfully.');
        }else {
            // Return with an error message if save was not successful
            return redirect()->route('motherInformation.motherDetails')->with('error', 'Failed to save the close relative form. Please try again.');
        }

    }


    public function storeLocalChairman(Request $request)
    {
        // Validate the request data
        $request->validate([
            //mother information
            'chairman_name' => 'required|string',
            'phone_number' => ['required','string','regex:/^255\d{9}$/'],
            'mother_id' => 'required|exists:mothers,id',
        ]);



        // Create a new ExpectantForm model and save the data
        $localchairman = LocalChairman::create([
            'chairman_name' => $request->input('chairman_name'),
            'phone_number' => $request->input('phone_number'),
            'mother_id' => $request->input('mother_id'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Redirect or return a response
        if ($localchairman->save()) {
            return redirect()->route('motherInformation.motherDetails')->with('success', 'Close relative form saved successfully.');
        }else {
            // Return with an error message if save was not successful
            return redirect()->route('motherInformation.motherDetails')->with('error', 'Failed to save the close relative form. Please try again.');
        }

    }


    public function getTotal(){
        return Mother::count();
    }

    public function getTotalToday(){
        return Mother:: whereDate('created_at', Carbon::today())->count();
    }





}
