
@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
<div class="analytics-sparkle-area">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Total Expectant Registered</h5>
                                <h2><span class="counter">{{(app(\App\Http\Controllers\MotherController::class)->getTotalToday())}}</span>
                                <span class="tuition-fees">Registered Today</span></h2>
                                <span class="text-success"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Total Expectant Registered</h5>
                                <h2><span class="counter">{{(app(\App\Http\Controllers\MotherController::class)->getTotal())}}</span>
                                 <span class="tuition-fees">These Month</span></h2>
                                <span class="text-success"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Total Expectant Registered</h5>
                                <h2><span class="counter">{{(app(\App\Http\Controllers\MotherController::class)->getTotal())}}</span>
                                 <span class="tuition-fees">These year</span></h2>
                                <span class="text-success"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="analytics-sparkle-line reso-mg-b-30">
                            <div class="analytics-content">
                                <h5>Total Expectant Registered</h5>
                                <h2><span class="counter">{{(app(\App\Http\Controllers\MotherController::class)->getTotal())}}</span>
                                 <span class="tuition-fees">Total Expectant</span></h2>
                                <span class="text-success"></span>
                                <div class="progress m-b-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
</div>
@endsection
