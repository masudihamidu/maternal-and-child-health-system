<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\Immunity;
use App\Models\Disease;
use illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ImmunityController extends Controller
{
    //
    public function storeImmunity(Request $request){
        // Validate the request data
        $request->validate([
           //immunity information
           'immunity_name' => 'required|string',
           'description' => 'required|string',
           'mother_id' => 'required|exists:mothers,id',

       ]);

       // Create a new ImmunityForm model and save the data
       $immunity = Immunity::create([
           'immunity_name' => $request->input('immunity_name'),
           'description' => $request->input('description'),
           'mother_id' => $request->input('mother_id'), 
           'created_at' => Carbon::now(),
           'updated_at' => Carbon::now(),
       ]);

        // Find the mother and associate the immunity
         $mother = Mother::findOrFail($request->input('mother_id'));
         $mother->immunities()->save($immunity);

       // Redirect or return a response
       if ($immunity->save()) {
           return redirect()->route('motherImmunity.addImmunity')->with('success', 'Immunity form saved successfully.');
       }else {
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
