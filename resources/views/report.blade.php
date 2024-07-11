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
                                margin-bottom: 20px;
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

                        <h1 style="font-weight: bold; font-size: 25px; text-align: center;">System-Wide Reports</h1>
                        <p style="font-weight: bold; font-size: 15px; text-align: center;">Displaying overall system statistics or reports here.</p>

                        <!-- Example System-Wide Reports -->
                        <div>
                            <p>Total Mothers: {{ $totalMothers }}</p>
                            <p>Total Mothers Today: {{ $totalMothersToday }}</p>
                            <p>Total Mothers This Month: {{ $totalMothersThisMonth }}</p>
                            <p>Total Mothers This Year: {{ $totalMothersThisYear }}</p>
                            <!-- Add more system-wide statistics as needed -->
                        </div>

                        <!-- Download PDF Button -->
                        <div class="form-group-inner">
                            <div class="login-btn-inner">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                            <a href="{{ route('system.pdf') }}" class="btn btn-sm btn-primary login-submit-cs">Download System Report as PDF</a>
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
