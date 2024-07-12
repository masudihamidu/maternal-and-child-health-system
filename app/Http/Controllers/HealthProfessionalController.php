<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\HealthProfessional;
use App\Models\Disease;
use App\Models\Service;
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

    public function getMothersWithServiceToday()
    {
        // Fetch diseases for today
        $serviceToday = Service::whereDate('created_at', Carbon::today())->get();

        // Format output: disease_name (count)
        $result = [];
        foreach ($serviceToday as $service) {
            $result[] = $service->disease_name . ' (' . $service->mother->count() . ')';
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


    public function getTotalClinicAttendanceToday()
    {
        // Get today's date
        $today = Carbon::today();

        // Query distinct mother IDs from diseases, immunities, and services registered today
        $totalAttendanceToday = Mother::whereHas('diseases', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->orWhereHas('immunities', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->orWhereHas('services', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->distinct('id')->count('id');

        return $totalAttendanceToday;
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
            $totalClinicAttendanceToday = $this->getTotalClinicAttendanceToday();


            // Get today's disease and immunity counts
            $diseasesToday = Disease::whereDate('created_at', Carbon::today())
                ->groupBy('disease_name')
                ->selectRaw('disease_name, count(*) as total')
                ->get();

            $immunitiesToday = Immunity::whereDate('created_at', Carbon::today())
                ->groupBy('immunity_name')
                ->selectRaw('immunity_name, count(*) as total')
                ->get();

            $serviceToday = Service::whereDate('created_at', Carbon::today())
                ->groupBy('service_name')
                ->selectRaw('service_name, count(*) as total')
                ->get();


            // Calculate total diseases and immunities for today
            $totalDiseasesToday = $diseasesToday->sum('total');
            $totalImmunitiesToday = $immunitiesToday->sum('total');
            $totalServicesToday = $serviceToday->sum('total');


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
            $html .= 'th { background-color: #f2f2f2; }';
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
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliohudhuria Kliniki Leo:</strong> ' . $totalClinicAttendanceToday . '</p>';

            // Diseases today table
            $html .= '<h4>Vipimo vya maabara:</h4>';
            $html .= '<table>';
            $html .= '<caption>Jumla ya Mama Watarajiwa Waliofanyiwa Vipimo vya Maabara Leo: ' . $totalDiseasesToday . '</caption>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Kipimo</th>';
            $html .= '<th>Idadi</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($diseasesToday as $disease) {
                $html .= '<tr>';
                $html .= '<td>' . $disease->disease_name . '</td>';
                $html .= '<td>' . $disease->total . '</td>';
                $html .= '</tr>';
            }
            // Add total row
            $html .= '<tr>';
            $html .= '<td><strong>Jumla</strong></td>';
            $html .= '<td><strong>' . $totalDiseasesToday . '</strong></td>';
            $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<br/>';

            // Immunities today table
            $html .= '<h4>Chanjo:</h4>';
            $html .= '<table>';
            $html .= '<caption>Jumla ya Mama Watarajiwa Waliopatiwa Chanjo Leo: ' . $totalImmunitiesToday . '</caption>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Chanjo</th>';
            $html .= '<th>Idadi</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($immunitiesToday as $immunity) {
                $html .= '<tr>';
                $html .= '<td>' . $immunity->immunity_name . '</td>';
                $html .= '<td>' . $immunity->total . '</td>';
                $html .= '</tr>';
            }

            $html .= '<tr>';
            $html .= '<td><strong>Jumla</strong></td>';
            $html .= '<td><strong>' . $totalImmunitiesToday . '</strong></td>';
            $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';


            // Serive today table
            $html .= '<br/>';
            $html .= '<h4>Huduma za kawaida kwa Mama Wajawazito Wafikapo Kliniki:</h4>';
            $html .= '<table>';
            $html .= '<caption>Jumla ya Mama Watarajiwa Waliopatiwa Huduma za Kawaida Leo: ' . $totalServicesToday . '</caption>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Huduma</th>';
            $html .= '<th>Idadi</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($serviceToday as $service) {
                $html .= '<tr>';
                $html .= '<td>' . $service->service_name . '</td>';
                $html .= '<td>' . $service->total . '</td>';
                $html .= '</tr>';
            }

            $html .= '<tr>';
            $html .= '<td><strong>Jumla</strong></td>';
            $html .= '<td><strong>' . $totalServicesToday . '</strong></td>';
            $html .= '</tr>';
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



    public function getMothersWithDiseasesThisMonth()
    {
        // Get the first and last day of the current month
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        // Query diseases registered between the first and last day of the current month
        $diseasesThisMonth = Disease::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy('disease_name')
            ->selectRaw('disease_name, count(*) as total')
            ->get()
            ->pluck('total', 'disease_name')
            ->toArray();

        return $diseasesThisMonth;
    }


    public function getMothersWithImmunitiesThisMonth()
    {
        // Get the first and last day of the current month
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        // Query immunities registered between the first and last day of the current month
        $immunitiesThisMonth = Immunity::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy('immunity_name')
            ->selectRaw('immunity_name, count(*) as total')
            ->get()
            ->pluck('total', 'immunity_name')
            ->toArray();

        return $immunitiesThisMonth;
    }


    public function getMothersWithServicesThisMonth()
    {
        // Get the first and last day of the current month
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        // Query immunities registered between the first and last day of the current month
        $servicesThisMonth = Service::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
            ->groupBy('service_name')
            ->selectRaw('service_name, count(*) as total')
            ->get()
            ->pluck('total', 'service_name')
            ->toArray();

        return $servicesThisMonth;
    }


    public function getTotalClinicAttendanceThisMonth()
    {
        // Get the first and last day of the current month
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        // Query distinct mother IDs from diseases, immunities, and services registered in the current month
        $totalAttendanceThisMonth = Mother::whereHas('diseases', function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
            $query->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth]);
        })->orWhereHas('immunities', function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
            $query->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth]);
        })->orWhereHas('services', function ($query) use ($firstDayOfMonth, $lastDayOfMonth) {
            $query->whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth]);
        })->distinct('id')->count('id');

        return $totalAttendanceThisMonth;
    }



    public function generateMonthlyPdfReport()
    {
        try {
            // Fetch data for your report
            $totalMothers = $this->getTotal();
            $totalMothersThisMonth = $this->getTotalThisMonth();
            $getMothersWithDiseasesThisMonth = $this->getMothersWithDiseasesThisMonth();
            $getMothersWithImmunitiesThisMonth = $this->getMothersWithImmunitiesThisMonth();
            $totalClinicAttendanceThisMonth = $this->getTotalClinicAttendanceThisMonth();
            $getMothersWithServicesThisMonth = $this->getMothersWithServicesThisMonth();

            // Get the current date for the printed date
            $printedDate = now()->format('d-m-Y H:i:s');
            $reportName = 'ripoti_ya_mwezi_' . now()->format('F_Y');

            // Start building HTML for PDF
            $html = '<html>';
            $html .= '<head>';
            $html .= '<meta charset="utf-8">';
            $html .= '<style>';
            $html .= 'h2 { text-align: center; text-decoration: underline; }';
            $html .= '.printed-date { text-align: right; margin-right: 10px; }';
            $html .= 'table { width: 100%; border-collapse: collapse; margin-top: 10px; }';
            $html .= 'table th, table td { border: 1px solid #000; padding: 8px; text-align: left; }';
            $html .= 'th { background-color: #f2f2f2; }';
            $html .= '</style>';
            $html .= '</head>';
            $html .= '<body>';
            $html .= '<p class="printed-date"><strong>Tarehe ya Kuchapishwa:</strong> ' . $printedDate . '</p>';
            $html .= '<h2>Ripoti ya Mwezi</h2>';
            // Display total counts
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliosajiliwa:</strong> ' . $totalMothers . '</p>';
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliosajiliwa Mwezi Huu:</strong> ' . $totalMothersThisMonth . '</p>';
            $html .= '<p><strong>Jumla ya Mama Watarajiwa Waliohudhuria Kliniki Mwezi Huu:</strong> ' . $totalClinicAttendanceThisMonth . '</p>';

            // Calculate total diseases for the month
            $totalDiseasesThisMonth = array_sum($getMothersWithDiseasesThisMonth);

            // Diseases this month table
            $html .= '<h4>Vipimo vya maabara kwa Mwezi Huu:</h4>';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Kipimo</th>';
            $html .= '<th>Idadi</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($getMothersWithDiseasesThisMonth as $diseaseName => $count) {
                $html .= '<tr>';
                $html .= '<td>' . $diseaseName . '</td>';
                $html .= '<td>' . $count . '</td>';
                $html .= '</tr>';
            }
            // total row
            $html .= '<tr>';
            $html .= '<td><strong>Jumla</strong></td>';
            $html .= '<td><strong>' . $totalDiseasesThisMonth . '</strong></td>';
            $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<br/>';

            // Calculate total immunities for the month
            $totalImmunitiesThisMonth = array_sum($getMothersWithImmunitiesThisMonth);

            // Immunities this month table
            $html .= '<h4>Chanjo kwa Mwezi Huu:</h4>';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Chanjo</th>';
            $html .= '<th>Idadi</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($getMothersWithImmunitiesThisMonth as $immunityName => $count) {
                $html .= '<tr>';
                $html .= '<td>' . $immunityName . '</td>';
                $html .= '<td>' . $count . '</td>';
                $html .= '</tr>';
            }
            // total row
            $html .= '<tr>';
            $html .= '<td><strong>Jumla</strong></td>';
            $html .= '<td><strong>' . $totalImmunitiesThisMonth . '</strong></td>';
            $html .= '</tr>';
            $html .= '</tbody>';
            $html .= '</table>';


            // Calculate total service for the month
            $totalServiceThisMonth = array_sum($getMothersWithServicesThisMonth);

            // Services this month table
            $html .= '<h4>Huduma za kawaida zilizotolewa kwa Mwezi Huu:</h4>';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Jina la Huduma</th>';
            $html .= '<th>Idadi</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($getMothersWithServicesThisMonth as $serviceName => $count) {
                $html .= '<tr>';
                $html .= '<td>' . $serviceName . '</td>';
                $html .= '<td>' . $count . '</td>';
                $html .= '</tr>';
            }
            // total row
            $html .= '<tr>';
            $html .= '<td><strong>Jumla</strong></td>';
            $html .= '<td><strong>' . $totalServiceThisMonth . '</strong></td>';
            $html .= '</tr>';
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
