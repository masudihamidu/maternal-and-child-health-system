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
            <!-- Word Cloud Section -->
            <div class="row">
                <div class="col-lg-12">
                <br/>
                    <div class="wordcloud-container">
                    <h1><b>Jumbe zilizoulizwa</b></h1>
                    <br/>

                        <div class="wordcloud">
                            <span style="font-size: 45px; left: 50%; top: 30%;">habari</span>
                            <span style="font-size: 40px; left: 70%; top: 50%;">mama</span>
                            <span style="font-size: 35px; left: 30%; top: 70%;">mjanzito</span>
                            <span style="font-size: 30px; left: 60%; top: 20%;">wa</span>
                            <span style="font-size: 25px; left: 80%; top: 40%;">kipimo</span>
                            <span style="font-size: 20px; left: 20%; top: 50%;">physics</span>
                            <span style="font-size: 15px; left: 40%; top: 80%;">cha</span>
                            <span style="font-size: 10px; left: 60%; top: 70%;">health</span>
                            <span style="font-size: 50px; left: 50%; top: 50%;">jamzito</span>
                            <span style="font-size: 5px; left: 10%; top: 20%;">what</span>
                            <span style="font-size: 12px; left: 70%; top: 10%;">kwetu</span>
                            <span style="font-size: 14px; left: 30%; top: 30%;">health</span>
                            <!-- Add more words as needed with varying font sizes -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
