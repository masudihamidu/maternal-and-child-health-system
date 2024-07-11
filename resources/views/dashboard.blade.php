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
                            <h2><span
                                    class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotalToday())}}</span>
                                <span class="tuition-fees">Waliosajiliwa Leo</span>
                            </h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">230%
                                        Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span
                                    class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotalThisMonth())}}</span>
                                <span class="tuition-fees">Mwezi Huu</span>
                            </h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20%
                                        Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span
                                    class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotalThisYear())}}</span>
                                <span class="tuition-fees">Mwaka Huu</span>
                            </h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20%
                                        Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Jumla ya Wajawazito Waliosajiliwa</h5>
                            <h2><span
                                    class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getTotal())}}</span>
                                <span class="tuition-fees">Jumla ya Wajawazito</span>
                            </h2>
                            <span class="text-success"></span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20%
                                        Imekamilika</span> </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br />

            <div class="product-sales-area mg-tb-30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12" >
                            <div class="product-sales-chart" >
                                <div class="pie-bar-line-area mg-t-30 mg-b-15">
                                    @include('layouts.bar');
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div
                                class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                                <h3 class="box-title">Jumla ya Wajawazito Waliofanyiwa Vipimo Leo </h3>
                                <ul class="list-inline two-part-sp">
                                    <li>
                                        <div id="sparklinedash"></div>
                                    </li>
                                    <li class="text-right sp-cn-r"><i class="fa fa-level-up" aria-hidden="true"></i>
                                        <span
                                            class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getMothersWithDiseaseSysToday())}}</span>

                                    </li>
                                </ul>
                            </div>

                            <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 tb-sm-res-d-n dk-res-t-d-n">
                            <h3 class="box-title">Jumla ya Wajawazito Waliopewa Chanjo Leo</h3>
                            <ul class="list-inline two-part-sp">
                                <li>
                                    <div id="sparklinedash2"></div>
                                </li>
                                <li class="text-right graph-two-ctn"><i class="fa fa-level-up" aria-hidden="true"></i>
                                <span
                                    class="counter">{{(app(\App\Http\Controllers\HealthProfessionalController::class)->getMothersWithImmunitySysToday())}}</span>
                                </li>
                            </ul>
                        </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Word Cloud Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="wordcloud-container">
                        <h2><b>Jumbe zilizoulizwa</b></h2>
                        <br />
                        <div class="wordcloud">
                            @foreach ($wordFrequencies as $word => $frequency)
                                                        @php
                                                            $fontSize = max(15, $frequency); // Ensure minimum font size of 30 pixels
                                                        @endphp
                                                        <span
                                                            style="font-size: {{ $fontSize }}px; left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%;">{{ $word }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

<script defer async>
  document.addEventListener('DOMContentLoaded', function() {
    // setting global variables
    window.botId = 3930

    // create div with id = sarufi-chatbox
    const div = document.createElement("div")
    div.id = "sarufi-chatbox"
    document.body.appendChild(div)

    // create and attach script tag
    const script = document.createElement("script")
    script.crossOrigin = true
    script.type = "module"
    script.src = "https://cdn.jsdelivr.net/gh/flexcodelabs/sarufi-chatbox/example/vanilla-js/script.js"
    document.head.appendChild(script)

    // create and attach css
    const style = document.createElement("link")
    style.crossOrigin = true
    style.rel = "stylesheet"
    style.href = "https://cdn.jsdelivr.net/gh/flexcodelabs/sarufi-chatbox/example/vanilla-js/style.css"
    document.head.appendChild(style)
  });
</script>

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
