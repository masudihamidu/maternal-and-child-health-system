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
                                    <h1>Mama watarajiwa walioandikishwa <span class="table-project-n">Data</span> Jedwali</h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar">
                                        <select class="form-control dt-tb">
											<option value="">Kuuza Msingi</option>
											<option value="all">Kuuza Yote</option>
											<option value="selected">Kuuza Iliyochaguliwa</option>
										</select>
                                    </div>
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state" data-checkbox="true"></th>
                                                <th data-field="id">No</th>
                                                <th data-field="mother_firstname" data-editable="true">Jina la kwanza</th>
                                                <th data-field="mother_lastname" data-editable="true">Jina la ukoo</th>
                                                <th data-field="mother_phone_number" data-editable="true">Namba ya simu</th>
                                                <th data-field="marital_status" data-editable="true">Hali ya ndoa</th>
                                                <th data-field="immunity">Kinga</th>
                                                <th data-field="tests">Vipimo</th>
                                                <th data-field="details">Maelezo</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($mother as $index => $item)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    {{$index+1}}
                                                </td>
                                                <td>
                                                    {{$item->mother_firstname}}
                                                </td>
                                                <td>
                                                    {{$item->mother_lastname}}
                                                </td>
                                                <td>
                                                    +{{$item->mother_phone_number}}
                                                </td>
                                                <td>
                                                    {{$item->marital_status}}
                                                </td>
                                                <td>
                                                <div class="button-style-three ">
                                                    <a class="btn btn-custon-two btn-success" href="{{ route('motherImmunity.addImmunity', ['id' => $item->id, 'sname' => $item->mother_lastname, 'name' => $item->mother_firstname]) }}" style="color: white;">Kinga</a>
                                                </div>
                                                </td>
                                            <td>
                                                <div class="button-style-three ">
                                                    <a class="btn btn-custon-two btn-success" href="{{ route('motherDisease.addDisease', ['id' => $item->id, 'sname' => $item->mother_lastname, 'name' => $item->mother_firstname]) }}" style="color: white;">Vipimo vya Afya</a>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="button-style-three">
                                                <a class="btn btn-custon-two btn-success" href="{{ route('motherInformation.motherDetails', ['id' => $item->id, 'sname' => $item->mother_lastname, 'name' => $item->mother_firstname]) }}" style="color: white;">Maelezo</a>
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

@endsection
