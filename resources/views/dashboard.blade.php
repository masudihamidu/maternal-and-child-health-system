@extends('layouts.app')

@section('content')
<div class="all-content-wrapper">
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotalToday())}}</span>
                            <span class="tuition-fees">Waliosajiliwa Leo</span></h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotalThisMonth())}}</span>
                            <span class="tuition-fees">Mwezi Huu</span></h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotalThisYear())}}</span>
                            <span class="tuition-fees">Mwaka Huu</span></h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotal())}}</span>
                            <span class="tuition-fees">Jumla ya Wajawazito</span></h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br/>

            <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliofanyiwa Vipimo</h5>
                            <h2><span class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getMothersWithDiseaseToday())}}</span>
                            <span class="tuition-fees">Leo</span></h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliopewa Chanjo</h5>
                            <h2><span class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getMothersWithImmunityToday())}}</span>
                            <span class="tuition-fees">Leo</span></h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Word Cloud Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="wordcloud-container">
                        <h1><b>Jumbe zilizoulizwa</b></h1>
                        <br/>
                        <div class="wordcloud">
                            @foreach ($wordFrequencies as $word => $frequency)
                                @php
                                    $fontSize = max(15, $frequency); // Ensure minimum font size of 30 pixels
                                @endphp
                                <span style="font-size: {{ $fontSize }}px; left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%;">{{ $word }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bar Chart Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Daily Conversations
                        </div>
                        <div class="card-body">
                            <canvas id="dailyDataChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route("fetch-daily-data") }}')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.date);
                const values = data.map(item => item.count);

                const ctx = document.getElementById('dailyDataChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Conversations per Day',
                            data: values,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>
@endsection

<style>
    .wordcloud-container {
        text-align: center;
        margin: 20px 0;
    }

    .wordcloud {
        position: relative;
        width: 100%;
        height: 300px;
        border: 1px solid #ccc;
        overflow: hidden;
        padding: 20px;
    }

    .wordcloud span {
        position: absolute;
        transform: translate(-50%, -50%);
    }
</style>
