<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\HealthProfessional;
use App\Models\Disease;
use App\Models\Immunity;
use Barryvdh\DomPDF\Facade\Pdf;

class HealthProfessionalController extends Controller
{
    public function storeHealthProfessional(Request $request)
    {
        // Validate the request data
        $request->validate([
            'professional_name' => 'required|string',
            'rank' => 'required|string',
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


    public function getMothersWithDiseaseSysToday()
    {
        return Mother::whereHas('diseases', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->count();
    }

    public function getMothersWithImmunitySysToday()
    {
        return Mother::whereHas('immunities', function ($query) {
            $query->whereDate('created_at', Carbon::today());
        })->count();
    }

    public function getMothersWithDiseaseToday()
    {
        // Fetch diseases for today
        $diseasesToday = Disease::whereDate('created_at', Carbon::today())->get();

        // Format output: disease_name (count)
        $result = [];
        foreach ($diseasesToday as $disease) {
            $result[] = $disease->disease_name . ' (' . $disease->mother->count() . ')';
        }

        return implode(', ', $result);
    }

    public function getMothersWithImmunityToday()
    {
        // Fetch immunities for today
        $immunitiesToday = Immunity::whereDate('created_at', Carbon::today())->get();

        // Format output: immunity_name (count)
        $result = [];
        foreach ($immunitiesToday as $immunity) {
            $result[] = $immunity->immunity_name . ' (' . $immunity->mother->count() . ')';
        }

        return implode(', ', $result);
    }

    public function getChartData()
    {
        // Fetch diseases data for chart
        $diseasesToday = Disease::whereDate('created_at', Carbon::today())->get();

        // Format output for chart
        $result = [];
        foreach ($diseasesToday as $disease) {
            $result[] = [
                'date' => $disease->created_at->format('Y-m-d'), // Assuming 'created_at' is a datetime field
                'countMotherWITHdisease' => $disease->mother()->count(),
            ];
        }

        return $result;
    }


    public function dashboard()
    {
        $totalMothers = $this->getTotal();
        $totalMothersToday = $this->getTotalToday();
        $totalMothersThisMonth = $this->getTotalThisMonth();
        $totalMothersThisYear = $this->getTotalThisYear();
        $mothersWithDiseaseToday = $this->getMothersWithDiseaseToday();
        $mothersWithImmunityToday = $this->getMothersWithImmunityToday();
        $getMothersWithDiseaseSysToday = $this->getMothersWithDiseaseSysToday();
        $getMothersWithImmunitySysToday = $this->getMothersWithImmunitySysToday();
        $chartData = $this->getChartData(); // Add this line

        return view('dashboard', compact('totalMothers', 'totalMothersToday', 'totalMothersThisMonth', 'totalMothersThisYear', 'mothersWithDiseaseToday', 'mothersWithImmunityToday', 'chartData', 'getMothersWithDiseaseSysToday', 'getMothersWithImmunitySysToday'));

    }


    public function generatePdfReport()
    {
        try {
            // Fetch data for your report
            $totalMothers = $this->getTotal();
            $totalMothersToday = $this->getTotalToday();
            $totalMothersThisMonth = $this->getTotalThisMonth();
            $totalMothersThisYear = $this->getTotalThisYear();
            $getMothersWithDiseaseSysToday = $this->getMothersWithDiseaseSysToday();
            $getMothersWithImmunitySysToday = $this->getMothersWithImmunitySysToday();

            // Get the current date for the printed date
            $printedDate = now()->format('d-m-Y H:i:s');
            $reportName = 'ripoti_ya_tarehe_' . $printedDate;

            // Start building HTML for PDF
            $html = '<html>';
            $html .= '<head>';
            $html .= '<meta charset="utf-8">';
            $html .= '<style>';
            $html .= 'h2 { text-align: center; text-decoration: underline; }';
            $html .= '.printed-date { text-align: right; margin-right: 10px; }';
            $html .= 'table { width: 100%; border-collapse: collapse; margin-top: 10px; }';
            $html .= 'table th, table td { border: 1px solid #000; padding: 8px; text-align: left; }';
            $html .= '</style>';
            $html .= '</head>';
            $html .= '<body>';
            $html .= '<p class="printed-date"><strong>Tarehe ya Kuchapishwa:</strong> ' . $printedDate . '</p>';
            $html .= '<h2>Ripoti ya Siku</h2>';
            // Display total counts
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliosajiliwa:</strong> ' . $totalMothers . '</p>';
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliosajiliwa Leo:</strong> ' . $totalMothersToday . '</p>';
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliosajiliwa Mwezi Huu:</strong> ' . $totalMothersThisMonth . '</p>';
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliosajiliwa Mwaka Huu:</strong> ' . $totalMothersThisYear . '</p>';
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliofanyiwa Vipimo vya Maabara Leo:</strong> ' . $getMothersWithDiseaseSysToday . '</p>';

            // Diseases today table
            $html .= '<h3>Vipimo:</h3>';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Kipimo</th>';
            $html .= '<th>Jumla</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $diseasesToday = Disease::whereDate('created_at', Carbon::today())
                ->groupBy('disease_name')
                ->selectRaw('disease_name, count(*) as total')
                ->get();
            foreach ($diseasesToday as $disease) {
                $html .= '<tr>';
                $html .= '<td>' . $disease->disease_name . '</td>';
                $html .= '<td>' . $disease->total . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';

            // Immunities today table
            $html .= '<h3>Chanjo:</h3>';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Chanjo</th>';
            $html .= '<th>Jumla</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            $immunitiesToday = Immunity::whereDate('created_at', Carbon::today())
                ->groupBy('immunity_name')
                ->selectRaw('immunity_name, count(*) as total')
                ->get();
            foreach ($immunitiesToday as $immunity) {
                $html .= '<tr>';
                $html .= '<td>' . $immunity->immunity_name . '</td>';
                $html .= '<td>' . $immunity->total . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';

            $html .= '</body>';
            $html .= '</html>';

            // Load HTML content and generate PDF
            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait');

            // Optionally, you can save the PDF to a file or return it as a response
            // For download:
            return $pdf->download($reportName . '.pdf');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->with('error', 'Failed to generate PDF report.');
        }
    }



}
