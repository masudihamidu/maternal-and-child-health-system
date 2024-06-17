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
            $mother = Mother::with(['diseases', 'immunities'])->find($id);

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
            $html .= '<p style="font-weight: bold; font-size: 15px; text-align: center;">This table should be used to remind the healthcare provider and the expectant mother which tests should be conducted and at what stage of pregnancy.</p>';
            $html .= "<h1 style='font-size: 20px;'>Clinic Attendance for <b>{$mother_firstname} {$mother_secondname} {$mother_lastname}</b>. </h1>";
            $html .= '<br/>';

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
