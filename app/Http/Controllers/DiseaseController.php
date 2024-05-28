<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use App\Models\Disease;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Session;
use Carbon\Carbon;


class DiseaseController extends Controller
{
    //
       // function for add disease
       public function storeDisease(Request $request){
        // Validate the request data
        $request->validate([
           //disease information
           'disease_name' => 'required|string',
           'description' => 'required|string',
           'mother_id' => 'required|exists:mothers,id',

       ]);

       // Create a new DiseaseForm model and save the data
       $disease = Disease::create([
           'disease_name' => $request->input('disease_name'),
           'description' => $request->input('description'),
           'mother_id' => $request->input('mother_id'),
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now(),
       ]);


        // Find the mother and associate the disease
        $mother = Mother::findOrFail($request->input('mother_id'));
        $mother->immunities()->save($disease);


       // Redirect or return a response
       if ($disease->save()) {
           return redirect()->route('motherDisease.addDisease')->with('success', 'Disease form saved successfully.');
       }else {
        // Return with an error message if save was not successful
        return redirect()->route('motherDisease.addDisease')->with('error', 'Failed to save the Disease form. Please try again.');
    }
   }

   public function addDisease(Request $request)
   {
       $id = $request->query('id');
       $mother_firstname = $request->query('name');
       $mother_lastname = $request->query('sname');


       return view('motherDisease', compact('id', 'mother_firstname','mother_lastname'));

   }
}
