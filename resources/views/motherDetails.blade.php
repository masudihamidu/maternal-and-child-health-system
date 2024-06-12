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
                        <h1 style="font-size: 20px;">Clinic attendance for <b>{{ $mother_firstname }} {{ $mother_secondname }} {{ $mother_lastname }}</b>. </h1>
                        <br/>
                        <div id="printableTable">
                            <table>
                                <thead>
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
                                </thead>
                                <tbody>
                                    <!-- Loop through diseases -->
                                    @foreach($diseases as $disease)
                                    <tr>
                                        <td>{{ $disease->disease_name }}</td>
                                        <td>{!! $disease->week12 ? '&#10004;' : '' !!}</td>
                                        <td>{!! $disease->week20 ? '&#10004;' : '' !!}</td>
                                        <td>{!! $disease->week26 ? '&#10004;' : '' !!}</td>
                                        <td>{!! $disease->week30 ? '&#10004;' : '' !!}</td>
                                        <td>{!! $disease->week36 ? '&#10004;' : '' !!}</td>
                                        <td>{!! $disease->week38 ? '&#10004;' : '' !!}</td>
                                        <td>{!! $disease->week40 ? '&#10004;' : '' !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p>The HIV retest for a person without an infection is done between weeks 32 and 36.</p>
                            <div class="form-group-inner">
                                <div class="login-btn-inner">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-9">
                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                <button onclick="printTable()" class="btn btn-sm btn-primary login-submit-cs">Print Table</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
