<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>

        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <!-- Include DataTables CSS -->
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
            .ongoinglisttable th {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-collapse: separate;
                border-top: none;
                border-left: none !important;
                border-right: none;
                /* vertical-align: bottom; */
            }

            .ongoinglisttable table td {
                padding-left: 8px;
                padding-right: 8px;

                color: black;
            }

            .ongoinglisttable td {

                border-top: #000 solid 0.5px;
                border-bottom: #000 solid 1px;
                border-left: #000 solid 1px;
                border-right: #000 solid 1px;
            }

            .action-column {}


            .content {
                background-color: white;
            }



            @media print {


                #logo {
                    display: block;
                    position: relative;
                    top: 0;
                    left: 0;

                }


                .ongoinglisttable,
                .ongoinglisttable tr,
                .ongoinglisttable td {
                    text-align: center !important;
                    border-top: #000 solid 1px;
                    border-bottom: #000 solid 1px;
                    border-left: #000 solid 1px;
                    border-right: #000 solid 1px;
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
        </style>
    </head>

    <body>
        @include('layouts.headernew')
        @include('layouts.sidebarnew')
        <div class="wrapper">

            <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">

                <div class="main">
                    <div class="container-fluid">
                        <input hidden id="semester" value="{{ $semester }}">
                        <input hidden id="startyear" value="{{ $startyear }}">
                        <input hidden id="endyear" value="{{ $endyear }}">



                        {{-- <form method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="wordFile">
                            <button type="submit">Upload</button>
                        </form> --}}
                        <div class="card">

                            <div class="card-body">

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
                                <div class="">
                                    <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">
                                    <div class="">
                                        <table id="yourDataTable" class="ongoinglisttable  display nowrap compact table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="vertical-align: bottom;">Action</th>
                                                    <th>Batch</th>
                                                    <th style="width:20px !important;">No.</th>
                                                    <th>Name</th>
                                                    <th style="width:30px !important;"><span style="" hidden>MF</span>
                                                    </th>
                                                    <th style="width:100px !important;"><span style="" hidden>Program</span></th>
                                                    <th style="width:150px !important;"><span style="" hidden>School</span></th>
                                                    <th style="width:150px !important;"><span style="" hidden>Course</span></th>
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
                                                    <th style="width:80px !important;"><span style="" hidden>STATUS</span></th>
                                                    <th>NOTATIONS</th>
                                                    <th>SUMMER</th>
                                                    <th>FARELEASED<br>TUITION</th>
                                                    <th>FARELEASED<br>TUITION<br>BOOK<br>STIPEND</th>
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

                    </div>

                </div>
            </main>
        </div>



        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontaws.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            var startyearValue = $('#startyear').val();
            var endyearValue = $('#endyear').val();
            var semesterValue = $('#semester').val();

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
                Swal.close(); // Close the SweetAlert popup
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
                var semesterValue2;

                if (semesterValue == 1) {
                    semesterValue2 = semesterValue + 1;
                } else if (semesterValue == 2) {
                    semesterValue2 = semesterValue - 1;
                } else {
                    semesterValue2 = "SUMMER";
                }



                var url = '{{ route('getongoinglistgroupsajaxviewclicked') }}';
                var table = $('#yourDataTable').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: {
                        url: url,
                        type: 'GET',
                        data: {
                            startyear: startyearValue,
                            endyear: endyearValue,
                            semester: semesterValue
                        },
                    },
                    columns: [{
                            data: null,
                            orderable: false,
                            searchable: false,
                            className: 'action-column',
                            render: function(data, type, row) {
                                var number = row
                                    .NUMBER; // Assuming 'NUMBER' is the column name in your database
                                return '<td class="">' +
                                    '<a href="#" class="edit-btn" data-number="' + number +
                                    '"><i name="edit-alt" class="fas fa-edit"></i></a> <a href="#" class="view-btn" data-number="' +
                                    number +
                                    '"><i class="fas fa-eye" name="show"></box-icon></a>' +
                                    '</td>';
                            }
                        },
                        {
                            data: 'BATCH',

                        },
                        {
                            data: 'NUMBER',

                        },
                        {
                            data: 'NAME',

                        },
                        {
                            data: 'MF',
                            render: function(data, type, row) {
                                // Apply custom styles to the email address
                                var styledgender =
                                    '<span style="padding-left:20px;padding-right: 20px;">' + data +
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
                                var stylecourse = '<span style="padding-right: 50px;">' + data +
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

                                var stylestatus = '<span style="padding-right: 60px;">' + data + '</span>';
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
                            targets: [0, 2], // Index of the "No" column, now correctly targeting the first column (0)
                            orderable: false,
                            searchable: false,
                        },
                        {
                            targets: [1, 2, 3, 5, 6, 7, 8, 9, 19, 4, 10, 11, 12, 13, 14, 15, 16, 17, 18, 20], // Adjusted to correctly target the intended columns
                            orderable: false,
                        },
                    ],
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    scrollX: true,
                    order: [
                        /*   [1, 'asc'] //set batch sort from lowest */
                    ],
                    fixedColumns: {
                        leftColumns: 4,
                    },
                    createdRow: function(row, data, dataIndex) {
                        $(row).find('.action-column').addClass('text-center');
                    },


                    initComplete: function() {
                        this.api().columns([5, 4, 6, 7, 14]).every(function(d) {
                            var column = this;
                            var select = $(
                                    "<select style=\"padding-top:1px !important; padding-bottom:1px !important;\" ><option value=\"\">" +
                                    column.header().textContent + "</option></select>"
                                )
                                .appendTo($(column.header()))
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                select.append("<option value=\"" + d + "\">" + d +
                                    "</option>");
                            });
                        });
                    },

                    drawCallback: function() {
                        let start = table.page.info().start;
                        let i = start + 1;
                        table
                            .column(2, {
                                search: 'applied',
                                order: 'applied'
                            })
                            .nodes()
                            .each(function(cell, index) {
                                cell.innerHTML = i++;
                            });
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


                        // Send the updated data to the server using AJAX
                        $.ajax({
                            url: '{{ url('/savechangesongongoing/') }}' + '/' + number, // Replace with your server endpoint
                            method: 'POST', // You can use POST or PUT based on your server-side implementation
                            data: updatedData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Handle success, e.g., close the modal or show a success message
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
                                ); // Assuming you want to hide the modal on success

                            },
                            error: function(error) {
                                console.error('Error saving changes:', error);
                            }
                        });
                    });

                });

                var columnsToHide = [21, 22, 22];
                columnsToHide.forEach(function(columnIndex) {
                    table.column(columnIndex).visible(false);
                });

            });





            function customExportAction(e, dt, button, config) {

                var oldStart = dt.settings()[0]._iDisplayStart;
                dt.one('preXhr', function(e, s, data) {
                    // Just this once, load all data from the server...
                    data.start = 0;
                    data.length = 2147483647;
                    dt.one('preDraw', function(e, settings) {
                        // Call the original action function
                        $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        dt.one('preXhr', function(e, s, data) {
                            // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                            // Set the property to what it was before exporting.
                            settings._iDisplayStart = oldStart;
                            data.start = oldStart;
                        });
                        // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                        setTimeout(dt.ajax.reload, 0);
                        // Prevent rendering of the full data to the DOM
                        return false;
                    });
                });

                // Requery the server with the new one-time export settings
                dt.ajax.reload();

            }


            $.extend(true, $.fn.dataTable.defaults, {

                dom: 'flrtipB',
                buttons: [{
                        extend: 'print',

                        autoPrint: true,
                        orientation: 'landscape',
                        pageSize: 'A4',
                        text: '<i class="fas fa-print" ></i>',
                        title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15],
                            modifier: {
                                search: 'none'
                            }
                        },
                        action: customExportAction,
                        customize: function(win) {
                            $(win.document.body).find('table td').css({
                                'white-space': 'normal',
                                'word-wrap': 'break-word'
                            });

                            //ADDED APRIL 8 2024
                            $(win.document.body).find('div.DTTT_container').remove(); // This removes the DataTables title and buttons

                            // Remove wrapping style from the 3rd column
                            $(win.document.body).find('table td:nth-child(3)').css({
                                'white-space': 'nowrap',
                                'word-wrap': 'normal'
                            });
                            $(win.document.body).find('table td:nth-child(6)').css({
                                'white-space': 'nowrap',
                                'word-wrap': 'normal'
                            });

                            // Apply wrapping style to all columns except the 3rd column

                            $(win.document.body).find('h1').css('font-size',
                                '50pt'); // Change the font size of the title
                            $(win.document.body).find('h1').css('font-weight', 'bold'); // Make the title bold
                            if (win.document.body.innerHTML.indexOf('<img id="logo"') === -1) {
                                $(win.document.body).prepend(
                                    '<img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}">');
                            }
                            $(win.document.body)
                                .css('font-size', '36pt')
                                .find('td')
                                .css('font-size', '36pt')
                            //.css('border', '1px solid black');
                            //Add borders to the table
                            //$(win.document.body).find('table').css('border', '2px solid black');
                            $(win.document.body).find('table td').css({
                                'border': '1px solid black',

                            });
                            //$(win.document.body).find('table th').css({'border': '1px solid black','margin': '10px'});


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
                                        // Add more cases as needed
                                    default:
                                        customHeaderName = 'Default Header';
                                }
                                $(this).text(customHeaderName);
                                $(this).css({
                                    'font-size': '40pt',
                                    'white-space': 'pre-wrap',
                                    'border': '1px solid black', // Add border to the header
                                    /*    'width': '100%', // Corrected syntax for the width property */
                                });
                            });
                            $(win.document.body).find('table tbody td:nth-child(2)').each(function(index) {
                                // Set the content of each cell in the second column to be the index + 1
                                $(this).text(index + 1); //modified dec 18 2023
                            });
                            $(win.document.body).find('table').removeClass('table-striped');
                            var style = 'table { width: 100%; } }';
                            var head = win.document.head || win.document.getElementsByTagName('head')[0];
                            var link = document.createElement('style');
                            link.type = 'text/css';
                            link.appendChild(document.createTextNode(style));
                            head.appendChild(link);
                        },

                    },
                    {
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
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-csv"></i>',
                        title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                            modifier: {
                                search: 'none'
                            }
                        },

                    }
                ]
            });
        </script>

    </body>





</html>
