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
                    <div class="" style="padding:2px">
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

    <script>
        var startyearValue = $('#startyear').val();
        var endyearValue = $('#endyear').val();
        var semesterValue = $('#semester').val();

        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "MM d, yy",
                showOtherMonths: true,
                selectOtherMonths: true
            });
        });

        function showSuggestionsAlertRemarks() {
            Swal.fire({
                title: 'Select Remarks',
                html: '<ul class="list-group">' +
                    '<li class="list-group-item btn btn-light btn-sm" onclick="selectSuggestion(\'tuition + stipend - OK\')">tuition + stipend - OK</li>' +
                    '<li class="list-group-item btn btn-light  btn-sm" onclick="selectSuggestion(\'stipend - OK\')">stipend - OK</li>' +
                    '</ul>',
                showCloseButton: true,
                showConfirmButton: false,
            });
        }

        function selectSuggestion(suggestion) {
            var remarksInput = document.getElementById('remarksField');
            remarksInput.value = suggestion;
            Swal.close();
        }

        function showStatusEndorsementSuggestionsAlert() {
            Swal.fire({
                title: 'Select a status endorsement',
                html: '<ul class="list-group">' +
                    '<li class="list-group-item" onclick="selectStatusEndorsement(\'NO COR\')">NO COR</li>' +
                    '<li class="list-group-item" onclick="selectStatusEndorsement(\'LOA: PENDING APPLICATION\')">LOA: PENDING APPLICATION</li>' +
                    '</ul>',
                showCloseButton: true,
                showConfirmButton: false,
            });
        }

        function selectStatusEndorsement(option) {
            var statusEndorsementInput = document.getElementById('statusEndorsement2Field');
            statusEndorsementInput.value = option;
            Swal.close(); // Close the SweetAlert popup
        }

        $(document).ready(function($) {

            $('#getSelectedRows').hide();

            var semesterValue2;

            if (semesterValue == 1) {
                semesterValue2 = semesterValue + 1;
            } else if (semesterValue == 2) {
                semesterValue2 = semesterValue - 1;
            } else {
                semesterValue2 = "SUMMER";
            }


            var url = '{{ route('getongoinglistgroupsajaxviewclicked') }}';
            var selectedRows = [];
            var table = $('#yourDataTable').DataTable({
                orderCellsTop: true,
                select: true,
                serverSide: true,
                pageLength: 100,
                ajax: {
                    url: url,
                    type: 'GET',
                    data: {
                        startyear: startyearValue,
                        endyear: endyearValue,
                        semester: semesterValue
                    },
                },
                columns: [

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'action-column',

                        render: function(data, type, row) {
                            var number = row
                                .NUMBER; // Assuming 'NUMBER' is the column name in your database
                            return '<td class="">' +
                                '<a href="#" class="edit-btn" data-number="' + number +
                                '"><i class="bi bi-pencil-fill"></i><a href="#" class="view-btn" data-number="' +
                                number +
                                '"><i class="bi bi-eye-fill"></i></a>' +
                                '</td>';
                        }
                    },

                    {
                        className: 'action-column',
                        data: 'BATCH',

                    },
                    {
                        className: 'action-column',
                        data: 'NUMBER',

                    },
                    {
                        data: 'NAME',

                    },
                    {
                        className: 'MF-column',
                        data: 'MF',
                        render: function(data, type, row) {
                            // Apply custom styles to the email address
                            var styledgender =
                                '<span style="width: 3% !important">' + data +
                                '</span>';
                            return styledgender;
                        },

                    },
                    {
                        className: 'action-column',
                        data: 'SCHOLARSHIPPROGRAM',
                        render: function(data, type, row) {
                            // Apply custom styles to the email address
                            var styledprogram = '<span style="text-align:center !important">' + data +
                                '</span>';
                            return styledprogram;
                        }

                    },
                    {
                        className: 'action-column',
                        data: 'SCHOOL',
                        render: function(data, type, row) {
                            // Apply custom styles to the email address
                            var styledschool = '<span >' + data +
                                '</span>';
                            return styledschool;
                        }
                    },
                    {
                        className: 'action-column',
                        data: 'COURSE',

                        render: function(data, type, row) {
                            // Apply custom styles to the email address
                            var stylecourse = '<span>' + data +
                                '</span>';
                            return '<td class="" style="color: blue;">' + stylecourse + '</td>';
                        }

                    },
                    {

                        className: 'action-column',
                        data: 'GRADES',
                        name: 'GRADES' + semesterValue2 + 'SEM' + startyearValue - 1 + endyearValue - 1,


                    },
                    {
                        className: 'action-column',
                        data: 'SummerREG',

                    },
                    {
                        className: 'action-column',
                        data: 'REGFORMS',

                    },
                    {
                        className: 'action-column',
                        data: 'REMARKS',

                    },
                    {
                        data: 'STATUSENDORSEMENT',

                    },
                    {
                        data: 'STATUSENDORSEMENT2',

                    },
                    {
                        data: 'STATUS',
                        render: function(data, type, row) {

                            if (data === null) {
                                return "";
                            }

                            var stylestatus = '<span>' + data + '</span>';
                            return stylestatus;
                        }
                    },
                    {
                        data: 'NOTATIONS',

                    },
                    {
                        data: 'SUMMER',

                    },
                    {
                        data: 'FARELEASEDTUITION',

                    },
                    {
                        data: 'FARELEASEDTUITIONBOOKSTIPEND',

                    },
                    {
                        data: 'LVDCAccount',

                    },
                    {
                        data: 'HVCNotes',

                    },
                    {
                        data: 'startyear',

                    },
                    {
                        data: 'endyear',

                    },


                ],
                columnDefs: [{
                        targets: 'action-column', // Use a class to target the specific column
                        className: 'text-center',
                    },
                    {
                        targets: 'MF-column', // Use a class to target the specific column
                        orderable: false,
                        searchable: false,
                    },
                    {
                        targets: [0, 2], // Index of the "No" column, now correctly targeting the first column (0)
                        orderable: false,
                        searchable: false,
                    },
                    {
                        targets: [1, 2, 3, 5, 6, 7, 8, 9, 19, 4, 10, 11, 12, 13, 14, 15, 16, 17, 18, 20], // Adjusted to correctly target the intended columns
                        orderable: false,
                    },
                ],

                scrollX: true,
                order: [
                    /*   [1, 'asc'] //set batch sort from lowest */
                ],
                fixedColumns: {
                    leftColumns: 1,
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).find('.action-column').addClass('text-center');
                },
                drawCallback: function(settings) {
                    var api = this.api();
                    api.columns([4, 5, 6, 7]).every(function(d) {
                        var column = this;
                        var theadname = $(api.column(d).header()).text();
                        var select = column.header().querySelector('select');

                        if (!select || select.options.length === 0) {
                            select = document.createElement('select');
                            select.style.padding = '2px';
                            select.add(new Option(' ' + theadname, ''));
                            column.header().replaceChildren(select);
                            select.addEventListener('change', function() {
                                var val = DataTable.util.escapeRegex(select.value);
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    // Skip theadname from the dropdown options
                                    if (d !== theadname) {
                                        select.add(new Option(d));
                                    }
                                });
                        }

                    });
                    /*  let start = table.page.info().start;
                     let i = start + 1;
                     table
                         .column(2, {
                             search: 'applied',
                             order: 'applied'
                         })
                         .nodes()
                         .each(function(cell, index) {
                             cell.innerHTML = i++;
                         }); */
                },

            });


            /*  $('#yourDataTable').on('search.dt', function() {
                 $(this).DataTable().columns.adjust();
                 //  table.columns.adjust().draw();
             }); */



            $('#nav-Ongoing-tab').click(function() {
                table.columns.adjust().draw();
            });

            var selectAllClicked = false;
            $('#selectAllRows').on('click', function() {
                selectAllClicked = !selectAllClicked;
                if (selectAllClicked) {
                    table.rows().select();

                } else {
                    table.rows().deselect();
                }
            });
            $('#getSelectedRows2').on('click', function() {
                var selectedRows = table.rows({
                    selected: true
                }).data().toArray();
                var selectedRowIds = selectedRows.map(row => row.NUMBER); // Assuming 'id' is the column name containing the IDs
                var startYear = $('#startyear').val();
                var semester = $('#semester').val();
                var datepicker = $('#datepicker').val();
                axios.post('/endorseongoing', {
                        selectedRowIds: selectedRowIds,
                        startYear: startYear,
                        semester: semester,
                        datepicker: datepicker
                    })
                    .then(function(response) {
                        /*  console.log('Selected rows data sent successfully:', response.data); */
                        Swal.fire({
                            title: 'Endorsed!',
                            text: 'Scholar(s) has ben endorsed!',
                            icon: 'success',
                            confirmButtonText: 'Okay',
                        })
                        table.ajax.reload(null, false);
                        table.columns.adjust().draw();

                    })
                    .catch(function(error) {
                        console.error('Error sending selected rows data:', error);

                    });
            });


            table.on('select deselect', function() { //
                var selectedRowsCount = table.rows({
                    selected: true
                }).count();
                if (selectedRowsCount > 0) {
                    $('#getSelectedRows').show();
                } else {
                    $('#getSelectedRows').hide();
                }
            });


            $(document).on('click', '.view-btn', function() {
                var number = $(this).data('number');
                var url = '{{ url('/viewscholarrecords/') }}' + '/' + number;
                window.location.href = url;
            });

            $(document).on('click', '.edit-btn', function() {
                var number = $(this).data('number');
                $.ajax({
                    url: '{{ url('/get-ongoing/') }}' + '/' + number + '/' + semesterValue + '/' + startyearValue,
                    method: 'GET',
                    success: function(data) {
                        $('#editModal #idField').val(data.NUMBER);
                        $('#editModal #nameField').val(data.NAME);
                        $('#editModal #genderField').val(data.MF);
                        $('#editModal #programField').val(data.SCHOLARSHIPPROGRAM);
                        $('#editModal #schoolField').val(data.SCHOOL);
                        $('#editModal #courseField').val(data.COURSE);
                        $('#editModal #gradesField').val(data.GRADES);
                        $('#editModal #summerRegField').val(data.SummerREG);
                        $('#editModal #regFormsField').val(data.REGFORMS); //ongoingregforms table
                        $('#editModal #remarksField').val(data.REMARKS); //ongoingremarks table
                        $('#editModal #statusEndorsementField').val(data.STATUSENDORSEMENT);
                        $('#editModal #statusEndorsement2Field').val(data.STATUSENDORSEMENT2);
                        $('#editModal #statusField').val(data.STATUS);
                        $('#editModal #notationsField').val(data.NOTATIONS);
                        $('#editModal #summerField').val(data.SUMMER);
                        $('#editModal #faReleaseTuitionField').val(data.FARELEASEDTUITION);
                        $('#editModal #faReleaseTuitionBookStipendField').val(data.FARELEASEDTUITIONBOOKSTIPEND);
                        $('#editModal #lvdCAccountField').val(data.LVDCAccount);
                        $('#editModal #hvcNotesField').val(data.HVCNotes);
                        $('#editModal #startyearField').val(data.startyear);
                        $('#editModal #endyearField').val(data.endyear);
                        $('#editModal #semesterField').val(data.semester);
                        /*  alert(data.startyear); */
                        $('#editModal').offcanvas('show');

                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });

                /* Save Changes Button */
                //TODO
                $('#saveChangesBtn').off('click').click(function() {
                    // Gather the updated data from the modal fields
                    var updatedData = {
                        /*  NUMBER: $('#editModal #idField').val(), */
                        NAME: $('#editModal #nameField').val(),
                        MF: $('#genderField').val(),
                        SCHOLARSHIPPROGRAM: $('#editModal #programField').val(),
                        SCHOOL: $('#editModal #schoolField').val(),
                        COURSE: $('#editModal #courseField').val(),
                        GRADES: $('#editModal #gradesField').val(),
                        SummerREG: $('#editModal #summerRegField').val(),
                        REGFORMS: $('#editModal #regFormsField').val(), //ongoingregforms table
                        STATUSENDORSEMENT: $('#editModal #statusEndorsementField').val(),
                        STATUSENDORSEMENT2: $('#editModal #statusEndorsement2Field').val(),
                        STATUS: $('#editModal #statusField').val(),
                        NOTATIONS: $('#editModal #notationsField').val(),
                        SUMMER: $('#editModal #summerField').val(),
                        FARELEASEDTUITION: $('#editModal #faReleaseTuitionField').val(),
                        FARELEASEDTUITIONBOOKSTIPEND: $('#editModal #faReleaseTuitionBookStipendField').val(),
                        LVDCAccount: $('#editModal #lvdCAccountField').val(),
                        HVCNotes: $('#editModal #lvdCAccountField').val(),
                        HVCNotes: $('#editModal #lvdCAccountField').val(),
                        /*    semester: $('#editModal #semesterField').val(),
                           startyear: $('#editModal #startyearField').val(),
                           endyear: $('#editModal #endyearField').val(), */
                        REMARKS: $('#editModal #remarksField').val(), //ongoingremarks table
                    };



                    $.ajax({
                        url: '{{ url('/savechangesongongoing/') }}' + '/' + number, //
                        method: 'POST', //
                        data: updatedData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            //
                            console.log(response);
                            swal.fire({
                                icon: 'success',
                                text: 'Record has been edited',
                                title: 'Success!',
                            })

                            // Redraw the DataTable
                            table.ajax.reload(null, false);
                            $('#editModal input').val('');
                            $('#editModal').offcanvas(
                                'hide'
                            ); //

                        },
                        error: function(error) {
                            console.error('Error saving changes:', error);
                        }
                    });
                });

            });

            var columnsToHide = [1, 2, 21, 22, 22];
            columnsToHide.forEach(function(columnIndex) {
                table.column(columnIndex).visible(false);
            });

        });

        function customExportAction(e, dt, button, config) {

            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function(e, s, data) {
                //
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function(e, settings) {

                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                    dt.one('preXhr', function(e, s, data) {
                        //
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    //
                    setTimeout(dt.ajax.reload, 0);

                    return false;
                });
            });
            dt.ajax.reload();

        }


        $.extend(true, $.fn.dataTable.defaults, {

            dom: 'flrtipB',
            buttons: [{
                    extend: 'print',

                    autoPrint: true,
                    orientation: 'landscape',
                    pageSize: 'A4',
                    text: '<i class="bi bi-printer-fill"></i>',
                    title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15],
                        modifier: {
                            search: 'none'
                        }
                    },
                    action: customExportAction,
                    customize: function(win) {
                        $(win.document.body).css({
                            'background-color': '#fff', //

                        });
                        $(win.document.body).find('table td').css({
                            'white-space': 'normal',
                            'word-wrap': 'break-word'
                        });

                        //ADDED APRIL 8 2024
                        $(win.document.body).find('div.DTTT_container').remove();

                        $(win.document.body).find('table td:nth-child(3)').css({
                            'white-space': 'nowrap',
                            'word-wrap': 'normal'
                        });
                        $(win.document.body).find('table td:nth-child(6)').css({
                            'white-space': 'nowrap',
                            'word-wrap': 'normal'
                        });


                        $(win.document.body).find('h1').css('font-size', '50pt');
                        $(win.document.body).find('h1').css('font-weight', 'bold');
                        if (win.document.body.innerHTML.indexOf('<img id="logo"') === -1) {
                            $(win.document.body).prepend(
                                '<img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}">');
                        }
                        $(win.document.body)
                            .css('font-size', '36pt')
                            .find('td')
                            .css('font-size', '36pt')
                            .css('background-color', 'white')
                        $(win.document.body).find('table td').css({
                            'border': '1px solid black',
                            'border': 'none !important',



                        });
                        $(win.document.body).find('table th').css({
                            'border': 'none !important',
                        });


                        $(win.document.body).find('table td, table th').css({
                            'padding-left': '0.5rem',
                            'padding-right': '0.5rem'
                        });

                        $(win.document.body).find('table thead th').each(function(index) {
                            var customHeaderName;
                            switch (index) {
                                case 0:
                                    customHeaderName = 'BATCH';
                                    break;
                                case 1:
                                    customHeaderName =
                                        'No'; // Change the second column header to 'No'
                                    break;
                                case 2:
                                    customHeaderName = 'NAME';
                                    break;
                                case 3:
                                    customHeaderName = 'M/F';
                                    break;
                                case 4:
                                    customHeaderName = 'SCHOLARSHIP\nPROGRAM';
                                    break;
                                case 5:
                                    customHeaderName = 'School';
                                    break;
                                case 6:
                                    customHeaderName = 'Course';
                                    break;
                                case 7:
                                    customHeaderName = 'Grades';
                                    break;
                                case 8:
                                    customHeaderName = 'Summer\nREG';
                                    break;
                                case 9:
                                    customHeaderName = 'REG\nFORMS';
                                    break;
                                case 10:
                                    customHeaderName = 'REMARKS';
                                    break;
                                case 11:
                                    customHeaderName = 'ENDORSEMENT';
                                    break;
                                case 12:
                                    customHeaderName = 'STATUS';
                                    break;
                                case 13:
                                    customHeaderName = 'NOTATION';
                                    break;

                                default:
                                    customHeaderName = 'Default Header';
                            }
                            $(this).text(customHeaderName);
                            $(this).css({
                                'font-size': '40pt',
                                'white-space': 'pre-wrap',
                                'border': '1px solid black', //
                            });
                        });
                        $(win.document.body).find('table tbody td:nth-child(2)').each(function(index) {

                            $(this).text(index + 1); //modified dec 18 2023
                        });
                        $(win.document.body).find('table').removeClass('table-striped');
                        var style = 'table { width: 100%; } ';
                        var head = win.document.head || win.document.getElementsByTagName('head')[0];
                        var link = document.createElement('style');
                        link.type = 'text/css';
                        link.appendChild(document.createTextNode(style));
                        head.appendChild(link);
                    },

                },
                /*   {
                      extend: 'excel',
                      text: '<i class="fas fa-file-excel"></i>',
                      title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                      exportOptions: {
                          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                          modifier: {
                              search: 'none'
                          }
                      },
                  },
                  {
                      extend: 'csv',
                      text: '<i class="fas fa-file-csv"></i>',
                      title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                      exportOptions: {
                          columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                          modifier: {
                              search: 'none'
                          }
                      },
                  }, */

            ]
        });
    </script>
@endsection
