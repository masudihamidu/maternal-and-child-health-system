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

                        <h1 style="font-weight: bold; font-size: 25px; text-align: center;">Vipimo/Maoni ya Kufanywa kwa Kila Hudhurio</h1>
                        <p style="font-weight: bold; font-size: 15px; text-align: center;">Jedwali hili linapaswa kutumika kukumbusha mtoa huduma za afya na mama mjamzito ni vipimo gani vinapaswa kufanywa na wakati gani wa ujauzito.</p>
                        <h1 style="font-size: 20px;">Hudhurio la Kliniki kwa <b>{{ $mother_firstname }} {{ $mother_secondname }} {{ $mother_lastname }}</b>. </h1>
                        <br/>
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
                            <tbody>
                                @foreach($groupedDiseases as $diseaseName => $diseaseGroup)
                                <tr>
                                    <td>{{ $diseaseName }}</td>
                                    <td>{!! $diseaseGroup->contains('week12', 1) ? '&#10004;' : '' !!}</td>
                                    <td>{!! $diseaseGroup->contains('week20', 1) ? '&#10004;' : '' !!}</td>
                                    <td>{!! $diseaseGroup->contains('week26', 1) ? '&#10004;' : '' !!}</td>
                                    <td>{!! $diseaseGroup->contains('week30', 1) ? '&#10004;' : '' !!}</td>
                                    <td>{!! $diseaseGroup->contains('week36', 1) ? '&#10004;' : '' !!}</td>
                                    <td>{!! $diseaseGroup->contains('week38', 1) ? '&#10004;' : '' !!}</td>
                                    <td>{!! $diseaseGroup->contains('week40', 1) ? '&#10004;' : '' !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br/>
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
                            <tbody>
    @foreach($groupedImmunity as $immunityName => $immunityGroup)
    <tr>
        <td>{{ $immunityName }}</td>
        <td>{!! $immunityGroup->contains('week12', 1) ? '&#10004;' : '' !!}</td>
        <td>{!! $immunityGroup->contains('week20', 1) ? '&#10004;' : '' !!}</td>
        <td>{!! $immunityGroup->contains('week26', 1) ? '&#10004;' : '' !!}</td>
        <td>{!! $immunityGroup->contains('week30', 1) ? '&#10004;' : '' !!}</td>
        <td>{!! $immunityGroup->contains('week36', 1) ? '&#10004;' : '' !!}</td>
        <td>{!! $immunityGroup->contains('week38', 1) ? '&#10004;' : '' !!}</td>
        <td>{!! $immunityGroup->contains('week40', 1) ? '&#10004;' : '' !!}</td>
    </tr>
    @endforeach
</tbody>
                        </table>
                        <p><b>Kipimo cha HIV kwa mtu ambaye hana maambukizi hufanywa kati ya wiki 32 na 36.</b></p>
                        <br/>

                        @if($ultrasoundImages->isNotEmpty())
                            <h2><b>Picha za Ultrasound</b></h2>
                            <div class="ultrasound-images">
                                @foreach($ultrasoundImages as $ultrasoundImage)
                                    <img src="{{ asset('storage/ultrasound/'.$ultrasoundImage->image_path) }}" alt="Picha ya Ultrasound" class="ultrasound-image">
                                    <p>{{ $ultrasoundImage->description }}</p>
                                @endforeach
                            </div>
                        @else
                            <p>Hakuna picha za ultrasound zilizopatikana.</p>
                        @endif

                        <div class="form-group-inner">
                            <div class="login-btn-inner">
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                            <a href="{{ route('mother.pdf', ['id' => $id]) }}" class="btn btn-sm btn-primary login-submit-cs">Pakua PDF</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
