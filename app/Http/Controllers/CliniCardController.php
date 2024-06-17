<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CliniCardController extends Controller
{
    public function generatePdf(Request $request)
    {
        try {
            $id = $request->query('id');

            // Fetch the mother along with her associated diseases and immunities
            $mother = Mother::with(['diseases', 'immunities', 'father'])->find($id);

            // Check if the mother exists
            if (!$mother) {
                return redirect()->route('mother_register.index')->with('error', 'Mother not found.');
            }

            // Extract necessary data
            $mother_firstname = $mother->mother_firstname;
            $mother_secondname = $mother->mother_secondname;
            $mother_lastname = $mother->mother_lastname;
            $diseases = $mother->diseases;
            $immunities = $mother->immunities;
            $father_firstname = $mother->father->father_firstname ?? '';
            $father_middlename = $mother->father->father_middlename ?? '';
            $father_surname = $mother->father->father_surname ?? '';
            $father_phone_number = $mother->father->father_phone_number ?? '';

            //Mother Registration date
            $registration_date = Carbon::parse($mother->created_at)->toFormattedDateString();

            // Build HTML content for the PDF
            $html = '<style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: center;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                    </style>';

            $html .= '<h1 style="font-weight: bold; font-size: 25px; text-align: center;">Tests/Diagnosis to be Done for Each Attendance</h1>';
            $html .= '<p>This table should be used to remind the healthcare provider and the expectant mother which tests should be conducted and at what stage of pregnancy.</p>';
            $html .= "<p><b>Clinic Attendance for: </b></p>";
            $html .= "<p> Mother full name: <b>{$mother_firstname} {$mother_secondname} {$mother_lastname}</b></p>";
            $html .= "<p> Father full name: <b>{$father_firstname} {$father_middlename} {$father_surname}</b>.  father phone number: <b>{$father_phone_number}</b></p>";
            $html .= "<p> Mother registration Date: <b>{$registration_date}</b></p>";
            $html .= '<div id="printableTable">';
            $html .= '<h2><b>Diseases</b></h2>';
            $html .= '<table>';
            $html .= '<thead>
                        <tr>
                            <th rowspan="2">TESTS/DETAILS ABOUT</th>
                            <th colspan="7">Weeks</th>
                        </tr>
                        <tr>
                            <th>12 weeks</th>
                            <th>20 weeks</th>
                            <th>26 weeks</th>
                            <th>30 weeks</th>
                            <th>36 weeks</th>
                            <th>38 weeks</th>
                            <th>40 weeks</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($diseases as $disease) {
                $html .= '<tr>';
                $html .= "<td>{$disease->disease_name}</td>";
                $html .= '<td>' . ($disease->week12 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($disease->week20 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($disease->week26 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($disease->week30 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($disease->week36 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($disease->week38 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($disease->week40 ? '&#10004;' : '') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<br/>';

            $html .= '<h2><b>Immunities</b></h2>';
            $html .= '<table>';
            $html .= '<thead>
                        <tr>
                            <th rowspan="2">IMMUNITY DETAILS</th>
                            <th colspan="7">Weeks</th>
                        </tr>
                        <tr>
                            <th>12 weeks</th>
                            <th>20 weeks</th>
                            <th>26 weeks</th>
                            <th>30 weeks</th>
                            <th>36 weeks</th>
                            <th>38 weeks</th>
                            <th>40 weeks</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($immunities as $immunity) {
                $html .= '<tr>';
                $html .= "<td>{$immunity->immunity_name}</td>";
                $html .= '<td>' . ($immunity->week12 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($immunity->week20 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($immunity->week26 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($immunity->week30 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($immunity->week36 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($immunity->week38 ? '&#10004;' : '') . '</td>';
                $html .= '<td>' . ($immunity->week40 ? '&#10004;' : '') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<p>The HIV retest for a person without an infection is done between weeks 32 and 36.</p>';
            $html .= '</div>';

            // Load HTML content and generate PDF
            $pdf = PDF::loadHTML($html)
                      ->setOptions(['defaultFont' => 'Arial']);

            // Create a dynamic filename for the downloaded PDF file
            $filename = "{$mother_firstname} {$mother_lastname}_clinicAttendance.pdf";

            // Download the PDF file
            return $pdf->download($filename);
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->route('mother_register.index')->with('error', 'Failed to generate PDF.');
        }
    }
}
