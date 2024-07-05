@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Sajili ya Wajawazito</h1>
                            @if(Session::get('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form method="post" action="{{ route('mother_register.store') }}">
                                            @csrf
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Jina la Kwanza</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="mother_firstname" id="mother_firstname" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Jina la Kati</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="mother_secondname" id="mother_secondname" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Jina la Mwisho</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="mother_lastname" id="mother_lastname" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Tarehe ya Kuzaliwa</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="date" name="mother_dob" id="mother_dob" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Namba ya Simu</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="mother_phone_number" id="mother_phone_number" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Kiwango cha Elimu</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="education" class="form-control">
                                                            <option value="illiterate">Hana Elimu</option>
                                                            <option value="primary">Shule ya Msingi</option>
                                                            <option value="secondary">Shule ya Sekondari</option>
                                                            <option value="higher secondary">Sekondari ya Juu</option>
                                                            <option value="ordinary diploma">Stashahada ya Kawaida</option>
                                                            <option value="bachelors">Shahada</option>
                                                            <option value="masters">Shahada ya Uzamili</option>
                                                            <option value="phd">Shahada ya Uzamivu (Ph.D.)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Kazi</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="occupation" class="form-control"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Hali ya Ndoa</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="marital_status" class="form-control">
                                                            <option value="single">Sijaolewa</option>
                                                            <option value="married">Nimeolewa</option>
                                                            <option value="divorced">Nimeachika</option>
                                                            <option value="widowed">Mjaane</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                <button class="btn btn-white" type="submit">Ghairi</button>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Hifadhi</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var dobField = document.getElementById('mother_dob');
                                                var today = new Date();

                                                var minDate = new Date();
                                                minDate.setFullYear(today.getFullYear() - 55);

                                                var maxDate = new Date();
                                                maxDate.setFullYear(today.getFullYear() - 12);

                                                // Format dates to YYYY-MM-DD
                                                var formatDate = function(date) {
                                                    var year = date.getFullYear();
                                                    var month = ('0' + (date.getMonth() + 1)).slice(-2);
                                                    var day = ('0' + date.getDate()).slice(-2);
                                                    return year + '-' + month + '-' + day;
                                                }

                                                dobField.setAttribute('min', formatDate(minDate));
                                                dobField.setAttribute('max', formatDate(maxDate));
                                            });
                                        </script>

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
