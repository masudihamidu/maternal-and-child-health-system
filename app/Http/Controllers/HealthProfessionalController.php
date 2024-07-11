<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\HealthProfessional;
use Barryvdh\DomPDF\Facade\Pdf;

class HealthProfessionalController extends Controller
{
    public function storeHealthProfessional(Request $request)
    {
        // Validate the request data
        $request->validate([
            //mother information
            'professional_name' => 'required|string',
            'rank' => ['required|string'],
            'mother_id' => 'required|exists:mothers,id',
        ]);

        // Create a new HealthProfessional model and save the data
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
        } else {
            // Return with an error message if save was not successful
            return redirect()->route('motherInformation.motherDetails')->with('error', 'Failed to save the health professional. Please try again.');
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

    public function getMothersWithDiseaseToday()
    {
        return Mother::whereHas('diseases', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->count();
    }

    public function getMothersWithImmunityToday()
    {
        return Mother::whereHas('immunities', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->count();
    }

    public function dashboard()
    {
        $totalMothers = $this->getTotal();
        $totalMothersToday = $this->getTotalToday();
        $totalMothersThisMonth = $this->getTotalThisMonth();
        $totalMothersThisYear = $this->getTotalThisYear();
        $mothersWithDiseaseToday = $this->getMothersWithDiseaseToday();
        $mothersWithDiseaseToday = $this->getMothersWithDiseaseToday();
        $getMothersWithImmunityToday = $this->getMothersWithImmunityToday();

        return view('dashboard', compact('totalMothers', 'totalMothersToday', 'totalMothersThisMonth', 'totalMothersThisYear', 'mothersWithDiseaseToday', 'getMothersWithImmunityToday'));
    }

    public function generatePdfReport()
    {
        try {
            // Fetch data for your report
            $totalMothers = $this->getTotal();
            $totalMothersToday = $this->getTotalToday();
            $totalMothersThisMonth = $this->getTotalThisMonth();
            $totalMothersThisYear = $this->getTotalThisYear();
            $mothersWithDiseaseToday = $this->getMothersWithDiseaseToday();
            $mothersWithImmunityToday = $this->getMothersWithImmunityToday();

            // Start building HTML for PDF
            $html = '<html>';
            $html .= '<head><meta charset="utf-8"></head>';
            $html .= '<body>';
            $html .= '<h1>PDF Report</h1>';
            $html .= '<p>Total Mothers: ' . $totalMothers . '</p>';
            $html .= '<p>Total Mothers Today: ' . $totalMothersToday . '</p>';
            $html .= '<p>Total Mothers This Month: ' . $totalMothersThisMonth . '</p>';
            $html .= '<p>Total Mothers This Year: ' . $totalMothersThisYear . '</p>';
            $html .= '<p>Mothers with Disease Today: ' . $mothersWithDiseaseToday . '</p>';
            $html .= '<p>Mothers with Immunity Today: ' . $mothersWithImmunityToday . '</p>';
            $html .= '</body>';
            $html .= '</html>';

            // Load HTML content and generate PDF
            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');

            // Optionally, you can save the PDF to a file or return it as a response
            // For download:
            return $pdf->download('report.pdf');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'Failed to generate PDF report.');
        }
    }
}
