@extends('layouts.appMaternal')

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
                                margin-bottom: 20px; /* Added margin to tables */
                            }
                            th, td {
                                border: 1px solid black;
                                padding: 8px;
                                text-align: center;
                            }
                            th {
                                background-color: #f2f2f2;
                            }
                            .ultrasound-image {
                                max-width: 400px;
                                height: 400px;
                                margin-bottom: 10px;
                            }
                        </style>
                        <br/>
                        <br/>
                        <br/>

                        <h1 style="font-weight: bold; font-size: 25px; text-align: center;">Vipimo/Maoni ya Kufanywa kwa Kila Hudhurio</h1>
                        <p style="font-weight: bold; font-size: 15px; text-align: center;">Jedwali hili linapaswa kutumika kukumbusha mtoa huduma za afya na mama mjamzito ni vipimo gani vinapaswa kufanywa na wakati gani wa ujauzito.</p>
                        <br/>

                        <!-- Diseases Table -->
                        <h2><b>Magonjwa</b></h2>
                        <table>
                            <thead>
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
                            </thead>
                        </table>

                        <p><b>Kipimo cha HIV kwa mtu ambaye hana maambukizi hufanywa kati ya wiki 32 na 36.</b></p>
                        <br/>

                        <!-- Immunity Table -->
                        <h2><b>Kingamwili</b></h2>
                        <table>
                            <thead>
                                <tr>
                                    <th rowspan="2">MAELEZO YA KINGAMWILI</th>
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
                            </thead>

                        </table>
                        <br/>


                        <!-- Services Table -->
                        <h1><b>Huduma zilizotolewa kwa kila hudhurio</b></h1>
                        <table>
                            <thead>
                                <tr>
                                    <th rowspan="2">MAELEZO YA HUDUMA</th>
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
                            </thead>

                        </table>


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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
