@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
<div class="container-fluid">
<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Expectant father information</h1>
                                    @if(Session::get('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
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

                                                        <form  method="post" action="{{ route('motherInformation.submitForm') }}">
                                                    @csrf
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Expectant ID</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="mother_id" value="{{ $id }}" id="mother_id" class="form-control" readonly required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Firstname</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="father_firstname" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Middle name</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="father_middlename" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Surname</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="father_surname" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Phone number</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="father_phone_number" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Education level</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <select name="father_education" class="form-control">
                                                                <option value="illiterate">Illiterate</option>
                                                                    <option value="primary">Primary School</option>
                                                                    <option value="secondary">Secondary School</option>
                                                                    <option value="higher secondary">Higher Secondary School</option>
                                                                    <option value="ordinary diploma">Ordinary diploma</option>
                                                                    <option value="bachelors">Bachelor's Degree</option>
                                                                    <option value="masters">Master's Degree</option>
                                                                    <option value="phd">Ph.D. or Equivalent</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Occupation</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-smi-9 col-xs-12">
                                                                <input type="text" name="father_occupation" class="form-control"  />
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Close relative information</h1>
                                </div>
                            </div>
                            <br/>

                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Firstname</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="sibling_firstname" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Middle name</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="sibling_middlename" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Surname</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="sibling_surname" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">Phone number</label>
                                                                </div>
                                                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                 <input type="text" name="sibling_phone_number" class="form-control" required/>

                                                                 </div>
                                                                </div>
                                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Local chairman information</h1>
                                </div>
                            </div>
                            <br/>

                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Chairman full name</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="chairman_name" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">Phone number</label>
                                                                </div>
                                                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                 <input type="text" name="chairman_phone_number" class="form-control" required/>
                                                                 </div>
                                                                </div>
                                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>health care professional information</h1>
                                </div>
                            </div>
                            <br/>

                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Full name</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="professional_name" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">Rank</label>
                                                                </div>
                                                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                 <input type="text" name="rank" class="form-control" required/>
                                                                 </div>
                                                                </div>
                                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Pregnancy summary</h1>

                                </div>
                            </div>
                            <br/>

                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">

                                            <div class="form-group-inner">
                                                <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right pull-right-pro">LNMP</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="date" name="lnmp" id="lnmp" class="form-control" required/>
                </div>
            </div>
        </div>

        <div class="form-group-inner">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right pull-right-pro">EDD</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="date" name="edd" id="edd" class="form-control" readonly/>
                </div>
            </div>
        </div>



                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">Menstrual cycle: day</label>
                                                                </div>
                                                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                 <input type="number" name="menstrual_cycle" class="form-control" required/>
                                                                 </div>
                                                            </div>
                                                        </div>



                                                        <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Normal cycle</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <select name="normal_cycle" class="form-control">
                                                                    <option value="yes">Yes</option>
                                                                    <option value="no">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Expectant background</h1>
                                </div>
                            </div>
                            <br/>

                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Allergy</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="text" name="allergy" class="form-control" required/>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Gravidity</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="number" name="gravidity" class="form-control" required/>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">Parity</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                 <input type="number" name="parity" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                            </div>



                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">childrens born niti</label>
                                                                </div>
                                                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                 <input type="number" name="childrens_born_niti" class="form-control" required/>
                                                                 </div>
                                                            </div>
                                                    </div>


                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Miscarriages</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="number" name="miscarriages" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Out-of-pocket pregnancies</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="number" name="out_of_pocket" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Giving birth to a stillborn child</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="number" name="died_child" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Number of living children</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                            <input type="number" name="living_children" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>
                                                                <div class="col-lg-9">
                                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save</button>
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

                <script>
        document.getElementById('lnmp').addEventListener('change', function() {
            var lnmp = new Date(this.value);
            var edd = new Date(lnmp);
            edd.setMonth(edd.getMonth() + 9);

            // Adjust the date if adding 9 months goes into the next year
            if (edd.getDate() !== lnmp.getDate()) {
                edd.setDate(0);
            }

            // Format the EDD date to yyyy-mm-dd
            var eddFormatted = edd.toISOString().split('T')[0];
            document.getElementById('edd').value = eddFormatted;
        });
    </script>
@endsection
