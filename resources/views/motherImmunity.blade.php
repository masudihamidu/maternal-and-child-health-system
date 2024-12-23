@extends('layouts.app')

@section('content')
<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Ongeza kinga kwa <b>{{ $mother_firstname }} {{ $mother_lastname }}</b>.</h1>
                            @if(Session::get('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <br/>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form method="post" action="{{ route('motherImmunity.storeImmunity') }}">
                                            @csrf
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">ID ya Mama</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="mother_id" value="{{ $id }}" id="mother_id" class="form-control" readonly required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Jina la Kinga</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="immunity_name" class="form-control" required>
                                                            <option value="Tetanus">Tetanus</option>
                                                            <option value="Flu">Flu</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Maelezo</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <textarea name="description" class="form-control" rows="4" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                            $weeks = ['12', '20', '26', '30', '36', '38', '40'];
                                            @endphp

                                            @foreach($weeks as $week)
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">{{ $week }} Wiki</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="radio" name="weeks" value="{{ $week }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                <button class="btn btn-white" type="button" onclick="window.location.href='{{ url()->previous() }}'">Ghairi</button>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Hifadhi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
