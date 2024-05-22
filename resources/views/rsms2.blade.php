@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <style>
        .ongoinglisttable th {
            padding-left: 8px;
            padding-right: 8px;
            border-bottom-width: thin;
            text-align: center !important;

            /*   border-left: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    border-right: none;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         */
        }

        /*    thead select {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                width: 100%;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            } */

        .ongoinglisttable td {
            padding-left: 8px;
            padding-right: 8px;
            border: 1px solid black !important;
            color: black;
        }



        /*   .ongoinglisttable td {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-width: thin;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-top: #000 solid 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-bottom: #000 solid 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-left: #000 solid 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-right: #000 solid 0.5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    } */

        .action-column {}


        .content {
            background-color: white;
        }


        div.dataTables_scrollFootInner table.table-bordered tr th:first-child,
        div.dataTables_scrollHeadInner table.table-bordered tr th:first-child {
            border-left: none !important;
        }

        @media print {


            #logo {
                display: block;
                position: relative;
                top: 0;
                left: 0;

            }


            th {
                border: 1px solid !important;
            }

            /* Scale content to 10% */
            body {
                zoom: 0.2;
            }

            /* Scale content to 10% */
            body {
                zoom: 0.2;
            }
        }

        .ongoinglisttable th {
            vertical-align: bottom !important;
            text-align: center !important;
        }

        .offcanvas.offcanvas-end {
            width: 700px !important;
        }

        .canvastable {
            border-collapse: collapse;
        }


        canvasth {
            vertical-align: center !important;
        }

        .view-btn {
            padding-left: 6px;
        }


        .endorsedcardbody {
            width: 35px;
            max-width: 200px;
            overflow: hidden;
            /* Hide overflowing content */
            transition: width 0.3s;

        }

        .endorsedcardbody:hover {
            width: 200px;
        }

        .textendorsed {
            white-space: nowrap;
            /* Prevent text from wrapping */
            transition: transform 0.3s;
            /* Smooth transition */
        }

        .nav-tabs .nav-link {
            background-color: #dddddd;
        }
    </style>
@endsection




@section('content')
    <input hidden id="semester" value="{{ $semester }}">
    <input hidden id="startyear" value="{{ $startyear }}">
    <input hidden id="endyear" value="{{ $endyear }}">

    {{-- ENDORSED OVERLAY --}}
    {{--   <div class="z-1 endorsedcardbody" style="position: absolute; top: 70px; right: 0; ">
        <div class="card" style="background-color: rgb(232, 230, 230);">
            <div class="card-body " style="text-align: center; padding: 10px; cursor: pointer;">
            <a href="#"><di v class="textendorsed" style="font-size: 20px"><i class="bi bi-file-earmark-text-fill" style="margin-right:10px"></i><span class="thistext">Endorsed</span></div></a>
            </div>
        </div>
    </div> --}}
    <div class="">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-Ongoing-tab" data-bs-toggle="tab" data-bs-target="#nav-Ongoing" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Ongoing</button>
                <button class="nav-link" id="nav-Endorsed-tab" data-bs-toggle="tab" data-bs-target="#nav-Endorsed" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Endorsed</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-Ongoing" role="tabpanel" aria-labelledby="nav-Ongoing-tab" tabindex="0" style="background-color: rgb(255, 255, 255)">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-6">
                                        <h3 class="mt-3">
                                            @if ($semester == 1)
                                                @php
                                                    echo $semester . 'ST SEM ' . $startyear . '-' . $startyear + 1;
                                                @endphp
                                            @elseif ($semester == 2)
                                                @php
                                                    echo $semester . 'ND SEM ' . $startyear . '-' . $startyear + 1;
                                                @endphp
                                            @else
                                                @php
                                                    echo 'SUMMER ' . $startyear . '-' . $startyear + 1;
                                                @endphp
                                            @endif
                                        </h3>
                                    </div>

                                    <div class="col mt-3">
                                        <button id="getSelectedRows" class="btn rounded-pill btn-outline-primary" data-bs-toggle="modal" data-bs-target="#endorsemodal">Endorse</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="endorsemodal" tabindex="-1" aria-labelledby="endorsemodal" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="endorsemodal">Input Date</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" id="datepicker" class="form-control">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" id="getSelectedRows2" data-bs-dismiss="modal" class="btn btn-outline-primary btn-sm">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">
                                    <div class="">

                                        <table id="yourDataTable" class="ongoinglisttable  display nowrap compact table-striped" style="user-select: none; table-layout: auto">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: bottom;">Action <i style=" cursor: pointer;" id="selectAllRows" class="bi bi-check2-square"></i></th>
                                                    <th>Batch</th>
                                                    <th style="width:5% !important">No</th>
                                                    <th>Name</th>
                                                    <th style="width:2% !important">MF</th>
                                                    <th>Program</th>
                                                    <th>School</th>
                                                    <th>Course</th>
                                                    <th style="vertical-align: bottom;">
                                                        @if ($semester == 1)
                                                            {{-- 1ST SEM --}}
                                                            @php
                                                                $semester2 = $semester + 1; //2ND
                                                                $startyear2 = $startyear - 1;
                                                                $endyear2 = $endyear - 1;
                                                            @endphp
                                                            {{ 'GRADES' }} <br> {{ $semester2 . 'ND-SEM' }} <br> {{ $startyear2 . '-' . $endyear2 }}
                                                        @elseif ($semester == 2)
                                                            {{-- 2ND SEM --}}
                                                            @php
                                                                $semester2 = $semester - 1; //1ST
                                                                $startyear2 = $startyear;
                                                                $endyear2 = $endyear;
                                                            @endphp
                                                            {{ 'GRADES' }} <br> {{ $semester2 . 'ST-SEM' }} <br> {{ $startyear2 . '-' . $endyear2 }}
                                                        @elseif ($semester == 0)
                                                            {{-- SUMMER --}}
                                                            @php
                                                                $semester2 = $semester + 2; //2ND SEM
                                                                $startyear2 = $startyear - 1; //CURRENT
                                                                $endyear2 = $startyear; //
                                                            @endphp
                                                            {{ 'GRADES' }} <br> {{ $semester2 . 'ND-SEM' . $startyear2 . '-' . $endyear2 }}
                                                        @endif
                                                    </th>
                                                    <th>SummerREG</th>
                                                    <th>
                                                        @if ($semester == 1)
                                                            {{-- 1ST SEM --}}
                                                            @php
                                                                $semester2 = $semester;
                                                                $startyear2 = $startyear;
                                                                $endyear2 = $endyear;
                                                            @endphp
                                                            {{ 'REG FORMS' }} <br> {{ $semester2 . 'ST-SEM' }} <br> {{ $startyear2 . '-' . $endyear2 }}
                                                        @elseif ($semester == 2)
                                                            {{-- 2ND SEM --}}
                                                            @php
                                                                $semester2 = $semester;
                                                                $startyear2 = $startyear;
                                                                $endyear2 = $endyear;
                                                            @endphp
                                                            {{ 'REG FORMS' }} <br> {{ $semester2 . 'ND-SEM' }} <br> {{ $startyear2 . '-' . $endyear2 }}
                                                        @elseif ($semester == 0)
                                                            {{-- SUMMER --}}
                                                            @php
                                                                $semester2 = $semester - 2; //1ST SEM
                                                                $startyear2 = $startyear; //(SAME STARTYEAR,+1 ENDYEAR)
                                                                $endyear2 = $endyear; //
                                                            @endphp
                                                            {{ 'REG FORMS' }} <br>{{ $semester2 . 'ST-SEM' }} <br> {{ $startyear2 . '-' . $endyear2 }}
                                                        @endif
                                                    </th>
                                                    <th>REMARKS</th>
                                                    <th>STATUS<br>ENDORSEMENT</th>
                                                    <th>STATUS<br>ENDORSEMENT2</th>
                                                    <th>STATUS</th>
                                                    <th>NOTATIONS</th>
                                                    <th>SUMMER</th>
                                                    <th>FARELEASED<br>TUITION</th>
                                                    <th>FARELEASED<br>BOOK<br>STIPEND</th>
                                                    <th>LVDCAccount</th>
                                                    <th>HVCNotes</th>
                                                    <th>startyear</th>
                                                    <th>endyear</th>
                                                    {{-- <th>semester</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- DataTable content will be dynamically added here -->
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="tab-pane fade" id="nav-Endorsed" role="tabpanel" aria-labelledby="nav-Endorsed-tab" tabindex="0" style="background-color: rgb(255, 255, 255)">
                <div class="card-body " style="padding-top: 1rem;">
                    <div class="" style="padding:2px" wire:poll.visible>
                        @livewire('endorsed-ongoing', ['startyear' => $startyear, 'semester' => $semester])

                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="offcanvas offcanvas-end " id="editModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="canvastable table table-sm" style="width: 100%; table-layout: fixed;">

                <tr>
                    <th style="" class="canvasth">ID:</th>
                    <td class="canvastable">
                        <input disabled class="form-control form-control-sm" id="idField" name="idField" placeholder="">
                    </td>
                    <th class="canvasth">Gender:</th>
                    <td class="canvastable">
                        {{--   <input class="form-control form-control-sm" id="genderField" name="genderField"> --}}
                        <select class="form-control form-control-sm" id="genderField" name="genderField">
                            <option value="F">F</option>
                            <option value="M">M</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="canvasth">Name:</th>
                    <td colspan="3" class="canvastable">
                        <input class="form-control form-control-sm" id="nameField" name="nameField">
                    </td>
                </tr>
                <tr>

                    <th class="canvasth">Program:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="programField" name="programField">
                    </td>
                    <th class="canvasth">School:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="schoolField" name="schoolField">
                    </td>
                </tr>
                <tr>

                    <th class="canvasth">Course:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="courseField" name="courseField">
                    </td>
                    <th class="canvasth"> LVDCAccount:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="lvdCAccountField" name="lvdCAccountField">
                    </td>
                </tr>

                <tr>
                    <th class="canvasth">Grades:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="gradesField" name="gradesField">
                    </td>
                    <th class="canvasth">SummerREG:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="summerRegField" name="summerRegField">
                    </td>
                </tr>
                <tr>
                    <th class="canvasth">REGForms:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="regFormsField" name="regFormsField">
                    </td>
                    <th class="canvasth">Status:</th>
                    <td style="" class="canvastable">
                        <input class="form-control form-control-sm" id="statusField" name="statusField">
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align:center" class="canvasth">Remarks:</th>
                    <td style="height:100px;   " class="canvastable">
                        <textarea style=" height: 100px;" class="form-control form-control-sm" id="remarksField" name="remarksField" placeholder="Type here..."></textarea>
                        <button class="btn btn-light btn-sm mt-1 mb-1" onclick="showSuggestionsAlertRemarks()"><i class="fas fa-question-square"></i></button>
                    </td>
                    <th class="canvasth">Notations:</th>
                    <td style="" class="canvastable">
                        <textarea style=" height: 100px;" class="form-control form-control-sm" id="notationsField" name="notationsField"></textarea>
                    </td>
                </tr>
                <tr>
                    <th class="canvasth">Status Endorsement:</th>
                    <td style="" class="canvastable">
                        <input class="form-control form-control-sm" id="statusEndorsementField" name="statusEndorsementField">

                    </td>
                    <th class="canvasth">Status Endorsement(2):</th>
                    <td style="" class="canvastable">
                        <input class="form-control form-control-sm" id="statusEndorsement2Field" name="statusEndorsement2Field">
                        <button class="btn btn-light btn-sm mt-1" onclick="showStatusEndorsementSuggestionsAlert()"><i class="fas fa-question-square"></i></button>
                    </td>
                </tr>

                <tr>

                </tr>
                <tr>
                    <th class="canvasth">Summer Stipend:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="summerField" name="summerField">
                    </td>
                    <th class="canvasth">HVCNotes:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="hvcNotesField" name="hvcNotesField">
                    </td>
                </tr>
                <tr>
                    <th class="canvasth">FA Released Tuition:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="faReleaseTuitionField" name="faReleaseTuitionField">
                    </td>
                    <th class="canvasth"> FA ReleasedTuition BookStipend:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="faReleaseTuitionBookStipendField" name="faReleaseTuitionBookStipendField">
                    </td>
                </tr>
                <tr class="d-none" style="">
                    <th class="canvasth"> <strong>Semester:</strong></th>
                    <td class="canvastable">
                        <input disabled class="form-control form-control-sm" id="semesterField" name="semesterField">
                    </td>
                </tr>
                <tr style="display:none">
                    <th class="canvasth">Startyear:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="startyearField" name="startyearField">
                    </td>
                </tr>
                <tr style="display:none">
                    <th class="canvasth">Endyear:</th>
                    <td class="canvastable">
                        <input class="form-control form-control-sm" id="endyearField" name="endyearField">
                    </td>
                </tr>

            </table>
            <button type="button" class="btn btn-primary mt-1" id="saveChangesBtn">SaveChanges</button>

        </div>


    </div> {{-- END OFF-CANVAS --}}
@endsection

@section('scripts')
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script type="text/javasript" src="{{ asset('js/rsms2.js') }}"></script>
@endsection
