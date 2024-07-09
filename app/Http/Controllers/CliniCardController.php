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

            $mother = Mother::with(['diseases', 'immunities', 'father', 'ultrasoundImages'])->find($id);

            // Check if the mother exists
            if (!$mother) {
                return redirect()->route('mother_register.index')->with('error', 'Mama hajapatikana.');
            }

            $mother_firstname = $mother->mother_firstname;
            $mother_secondname = $mother->mother_secondname;
            $mother_lastname = $mother->mother_lastname;
            $diseases = $mother->diseases;
            $immunities = $mother->immunities;
            $father_firstname = $mother->father->father_firstname ?? '';
            $father_middlename = $mother->father->father_middlename ?? '';
            $father_surname = $mother->father->father_surname ?? '';
            $father_phone_number = $mother->father->father_phone_number ?? '';

            $region = $mother->region;
            $district = $mother->district;
            $ward = $mother->ward;
            $street = $mother->street;

            $shortRegion = substr($region, 0, 3);
            $shortDistrict = substr($district, 0, 3);
            $shortWard = substr($ward, 0, 3);
            $shortStreet = substr($street, 0, 3);

            // Group diseases by disease_name
            $groupedDiseases = $diseases->groupBy('disease_name');

            $groupedImmunity = $immunities->groupBy('immunity_name');

            $services = $mother->services; // Replace with your actual service relationship
            $groupedService = $services->groupBy('service_name');


            // Mother Registration date
            $registration_date = Carbon::parse($mother->created_at)->locale('sw')->isoFormat('LL');

            // Start building HTML for PDF
            $html = '<html lang="sw">';
            $html .= '<head>';
            $html .= '<meta charset="UTF-8">';
            $html .= '<style>
                @font-face {
                    font-family: "DejaVu Sans";
                    font-style: normal;
                    font-weight: normal;
                    src: url("https://cdn.jsdelivr.net/gh/foliojs/pdfkit/examples/fonts/DejaVuSans.ttf") format("truetype");
                }
                body {
                    font-family: "DejaVu Sans", sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: center;
                }
                th {
                    background-color: #f2f2f2;
                }
                .ultrasound-image {
                    width: 100%;
                    height: auto;
                    display: block;
                    margin-bottom: 10px;
                }
            </style>';
            $html .= '</head>';
            $html .= '<body>';
            $html .= "<h1 style='font-size: 20px; text-align: right;'>Kadi namba: <b>{$shortRegion}/{$shortDistrict}/{$shortWard}/{$shortStreet}/{$id}</b></h1>";
            $html .= '<br/>';
            $html .= '<h1 style="font-size: 18px; text-align: center;">Vipimo/Majaribio Yanayopaswa Kufanywa kwa Kila Ziara ya Kliniki</h1>';
            $html .= '<p>Jedwali hii inapaswa kutumika kumkumbusha mtoa huduma za afya na mama mjamzito vipimo gani vinapaswa kufanyika na wakati gani wa ujauzito.</p>';
            $html .= "<p><b>Kuhudhuria Kliniki kwa:</b></p>";
            $html .= "<p>Jina kamili la Mama: <b>{$mother_firstname} {$mother_secondname} {$mother_lastname}</b></p>";
            $html .= "<p>Jina kamili la Baba: <b>{$father_firstname} {$father_middlename} {$father_surname}</b>. Namba ya simu ya Baba: <b>{$father_phone_number}</b></p>";
            $html .= "<p>Tarehe ya Usajili wa Mama: <b>{$registration_date}</b></p>";

            $html .= '<div id="printableTable">';

            // Diseases Table
            $html .= '<h2><b>Magonjwa</b></h2>';
            $html .= '<table>';
            $html .= '<thead>
                        <tr>
                            <th rowspan="2">VIPIMO/MAELEZO KUHUSU</th>
                            <th colspan="7">Wiki</th>
                        </tr>
                        <tr>
                            <th>Wiki 12</th>
                            <th>Wiki 20</th>
                            <th>Wiki 26</th>
                            <th>Wiki 30</th>
                            <th>Wiki 36</th>
                            <th>Wiki 38</th>
                            <th>Wiki 40</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($groupedDiseases as $diseaseName => $group) {
                $html .= '<tr>';
                $html .= "<td>{$diseaseName}</td>";
                $html .= '<td>' . ($group->sum('week12') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week20') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week26') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week30') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week36') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week38') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week40') > 0 ? '✓' : '') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<br/>';

            // Immunities Table
            $html .= '<h2><b>Kinga</b></h2>';
            $html .= '<table>';
            $html .= '<thead>
                        <tr>
                            <th rowspan="2">MAELEZO YA KINGA</th>
                            <th colspan="7">Wiki</th>
                        </tr>
                        <tr>
                            <th>Wiki 12</th>
                            <th>Wiki 20</th>
                            <th>Wiki 26</th>
                            <th>Wiki 30</th>
                            <th>Wiki 36</th>
                            <th>Wiki 38</th>
                            <th>Wiki 40</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($groupedImmunity as $immunityName => $group) {
                $html .= '<tr>';
                $html .= "<td>{$immunityName}</td>";
                $html .= '<td>' . ($group->sum('week12') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week20') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week26') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week30') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week36') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week38') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week40') > 0 ? '✓' : '') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '<p>Upimaji wa tena wa HIV kwa mtu asiye na maambukizi hufanyika kati ya wiki 32 na 36.</p>';

            // Ultrasound Images
            if ($mother->ultrasoundImages->isNotEmpty()) {
                $html .= '<h2><b>Picha za Ultrasound</b></h2>';
                $html .= '<div class="ultrasound-images">';
                foreach ($mother->ultrasoundImages as $ultrasoundImage) {
                    // Get image contents and convert to base64
                    $imagePath = storage_path("app/public/ultrasound/{$ultrasoundImage->image_path}");
                    if (file_exists($imagePath)) {
                        $imageData = file_get_contents($imagePath);
                        $base64Image = base64_encode($imageData);
                        $html .= '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Picha ya Ultrasound" class="ultrasound-image">';
                    } else {
                        $html .= '<p>Picha haipatikani: ' . $ultrasoundImage->image_path . '</p>';
                    }
                }
                $html .= '</div>';
            } else {
                $html .= '<p>Hakuna picha za ultrasound zilizopatikana.</p>';
            }


            // Services Table
            $html .= '<h2><b>Huduma zilizotolewa kwa kila hudhurio</b></h2>';
            $html .= '<table>';
            $html .= '<thead>
                        <tr>
                            <th rowspan="2">JINA LA HUDUMA</th>
                            <th colspan="7">Wiki</th>
                        </tr>
                        <tr>
                            <th>Wiki 12</th>
                            <th>Wiki 20</th>
                            <th>Wiki 26</th>
                            <th>Wiki 30</th>
                            <th>Wiki 36</th>
                            <th>Wiki 38</th>
                            <th>Wiki 40</th>
                        </tr>
                    </thead>';
            $html .= '<tbody>';
            foreach ($groupedService as $serviceName => $group) {
                $html .= '<tr>';
                $html .= "<td>{$serviceName}</td>";
                $html .= '<td>' . ($group->sum('week12') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week20') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week26') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week30') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week36') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week38') > 0 ? '✓' : '') . '</td>';
                $html .= '<td>' . ($group->sum('week40') > 0 ? '✓' : '') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';

            $html .= '</div>'; // End printableTable

            $html .= '</br>';
            $html .= '</html>';

            // Load HTML content and generate PDF
            $pdf = PDF::loadHTML($html)->setPaper('a4', 'portrait')->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

            // Create a dynamic filename for the downloaded PDF file
            $filename = "{$mother_firstname}_{$mother_lastname}_clinicAttendance.pdf";

            // Download the PDF file
            return $pdf->download($filename);
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->route('mother_register.index')->with('error', 'Kushindwa kuzalisha PDF.');
        }
    }
}
