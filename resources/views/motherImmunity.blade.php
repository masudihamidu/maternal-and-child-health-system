@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
<div class="container-fluid">
<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline12-list">
                            <div class="sparkline12-hd">
                                <div class="main-sparkline12-hd">
                                    <h1>Add Immunity for <b>{{ $mother_firstname }} {{ $mother_lastname }}</b>.</h1>
                                    @if(Session::get('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                    @endif
                                </div>
                            </div>
                            <br/>
                            <div class="sparkline12-graph">
                                <div class="basic-login-form-ad">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="all-form-element-inner">

                                                <form  method="post" action="{{ route('motherImmunity.storeImmunity') }}" >
                                                    @csrf
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Mother ID</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <input type="text" name="mother_id" value="{{ $id }}" id="mother_id" class="form-control" readonly required/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="login2 pull-right pull-right-pro">Immunity name</label>
                                                            </div>
                                                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                <select name="immunity_name" class="form-control">
                                                                    <option value="Tetanus">Tetanus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group-inner">
                                                         <div class="row">
                                                             <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                 <label class="login2 pull-right pull-right-pro">Description</label>
                                                                </div>
                                                                 <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                                                 </div>
                                                                </div>
                                                            </div>


                                                    <div class="form-group-inner">
                                                        <div class="login-btn-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3"></div>
                                                                <div class="col-lg-9">
                                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                        <button class="btn btn-white" type="submit">Cancel</button>
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
@endsection
