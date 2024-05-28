@extends('layouts.app')
@section('content')

    <div class="all-content-wrapper">
        <!-- Static Table Start -->
        <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>Expectant Registered <span class="table-project-n">Data</span> Table</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">ID</th>
                                                <th data-field="mother_firstname" data-editable="true">first name</th>
                                                <th data-field="mother_dob" data-editable="true">DOB</th>
                                                <th data-field="mother_phone_number" data-editable="true">phone number</th>
                                                <th data-field="education" data-editable="true">education</th>
                                                <th data-field="occupation" data-editable="true">occupation</th>
                                                <th data-field="marital_status" data-editable="true">marital status</th>
                                                <th data-field="immunity">Immunity</th>
                                                <th data-field="tests">Tests</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($mother as $index => $item)
                                            <tr>
                                                <td></td>
                                                <td>{{$index+1}}</td>
                                                <td>{{$item->mother_firstname}}</td>
                                                <td>{{$item->mother_dob}}</td>
                                                <td>+{{$item->mother_phone_number}}</td>
                                                <td>{{$item->education}}</td>
                                                <td>{{$item->occupation}}</td>
                                                <td>{{$item->marital_status}}</td>
                                                <td>
                                                <div class="button-style-three ">
                                                    <a class="btn btn-custon-two btn-success" href="{{ route('motherImmunity.addImmunity', ['id' => $item->id, 'sname' => $item->mother_lastname, 'name' => $item->mother_firstname]) }}" style="color: white;">Immunity</a>
                                                </div>
                                                </td>
                                                <td>
                                                <div class="button-style-three ">
                                                    <a class="btn btn-custon-two btn-success" href="{{ route('motherDisease.addDisease', ['id' => $item->id, 'sname' => $item->mother_lastname, 'name' => $item->mother_firstname]) }}" style="color: white;">Health test</a>
                                                </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->

    </div>

@endsection
