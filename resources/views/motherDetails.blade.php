@extends('layouts.app')
@section('content')

<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline13-list">
                    <div class="sparkline13-graph">
    <style>
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
    </style>

<h1 style="font-weight: bold; font-size: 25px; text-align: center;">Tests/diagnosis to be done for each attendance</h1>
<p style="font-weight: bold; font-size: 15px; text-align: center;">This table should be used to remind the healthcare provider and the expectant mother which tests should be conducted and at what stage of pregnancy.</p>


    <table>
        <thead>
            <tr>
                <th rowspan="2">TESTS/DETAILS ABOUT</th>
                <th colspan="7">Weeks</th>
            </tr>
            <tr>
                <th>12 wks</th>
                <th>20 wks</th>
                <th>26 wks</th>
                <th>30 wks</th>
                <th>36 wks</th>
                <th>38 wks</th>
                <th>40 wks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Anemia</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Blood group</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Eclampsia</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Proteinuria</td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Blood pressure</td>
                <td></td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Preeclampsia</td>
                <td></td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Ask about tobacco use</td>
                <td></td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Ask about alcohol/drug use</td>
                <td></td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
                <td>&#10004;</td>
            </tr>
            <tr>
                <td>Malaria</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>HIV</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Syphilis</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tuberculosis</td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Obstetric ultrasound</td>
                <td></td>
                <td></td>
                <td></td>
                <td>&#10004;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <p>The HIV retest for a person without an infection is done between weeks 32 and 36.</p>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
