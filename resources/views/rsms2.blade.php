<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />

        <!-- Include DataTables CSS -->
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">


        <link href="{{ asset('css/all.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            th {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-collapse: separate;
                /* vertical-align: bottom; */
            }

            table td {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-right-width: thin;
                color: black;
            }

            .action-column {}


            body {
                background-color: rgb(255, 255, 255);
                background-color: #dddddd;
            }

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


                table,
                table tr,
                table td {
                    border-top: #000 solid 1px;
                    border-bottom: #000 solid 1px;
                    border-left: #000 solid 1px;
                    border-right: #000 solid 1px;
                }
            }


            table.dataTable>thead .sorting::before,
            table.dataTable>thead .sorting::after {
                /* bottom: 2px !important; */
                /*
                top: 2px !important; */
            }

            .offcanvas.offcanvas-end {
                width: 500px !important;
            }

            .canvastable td {
                border-top: #b7b7b7 solid 1px;
                border-bottom: #b7b7b7 solid 1px;
                border-left: #b7b7b7 solid 1px;
                border-right: #b7b7b7 solid 1px;
            }

            .canvastable input,
            .canvastable textarea {
                border: none;
            }

            .canvastable th {
                width: 2in !important;
                border-top: #b7b7b7 solid 1px;
                border-bottom: #b7b7b7 solid 1px;
                border-left: #b7b7b7 solid 1px;
                border-right: #b7b7b7 solid 1px;
                /* Adjust the minimum width as needed */
            }

            .view-btn {
                padding-left: 6px;
            }
        </style>
    </head>

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">
            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}
            <div class="main">
                @include('layouts.header')

                <main class="content" style="padding:0.5rem 0.5rem 0.5rem">
                    <div class="">
                        <input hidden id="semester" value="{{ $semester }}">
                        <input hidden id="startyear" value="{{ $startyear }}">
                        <input hidden id="endyear" value="{{ $endyear }}">
                        <h3>
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


                        {{-- <form method="POST" action="/upload" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="wordFile">
                            <button type="submit">Upload</button>
                        </form> --}}

                        <div class="">
                            <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">
                            <div class="">
                                <table id="yourDataTable" class="display nowrap compact table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Batch</th>
                                            <th style="width:100px !important;">Number</th>
                                            <th>Name</th>
                                            <th style="width:100px !important;"><span style="" hidden>MF</span>
                                            </th>
                                            <th style="width:100px !important;"><span style="" hidden>Program</span></th>
                                            <th style="width:150px !important;"><span style="" hidden>School</span></th>
                                            <th style="width:150px !important;"><span style="" hidden>Course</span></th>
                                            <th>
                                                @if ($semester == 1)
                                                    {{-- 1ST SEM --}}
                                                    @php
                                                        $semester2 = $semester + 1; //2ND
                                                        $startyear2 = $startyear - 1;
                                                        $endyear2 = $endyear - 1;
                                                    @endphp
                                                    {{ 'GRADES' . $semester2 . 'NDSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 2)
                                                    {{-- 2ND SEM --}}
                                                    @php
                                                        $semester2 = $semester - 1; //1ST
                                                        $startyear2 = $startyear;
                                                        $endyear2 = $endyear;
                                                    @endphp
                                                    {{ 'GRADES' . $semester2 . 'STSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 3)
                                                    {{-- SUMMER --}}
                                                    @php
                                                        $semester2 = $semester - 1; //2ND SEM
                                                        $startyear2 = $startyear - 1; //CURRENT
                                                        $endyear2 = $endyear; //
                                                    @endphp
                                                    {{ 'GRADES' . $semester2 . 'NDSEM' . $startyear2 . '' . $endyear2 }}
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
                                                    {{ 'REG FORMS' . $semester2 . 'STSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 2)
                                                    {{-- 2ND SEM --}}
                                                    @php
                                                        $semester2 = $semester;
                                                        $startyear2 = $startyear;
                                                        $endyear2 = $endyear;
                                                    @endphp
                                                    {{ 'REG FORMS' . $semester2 . 'NDSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 3)
                                                    {{-- SUMMER --}}
                                                    @php
                                                        $semester2 = $semester - 2; //1ST SEM
                                                        $startyear2 = $startyear; //(SAME STARTYEAR,+1 ENDYEAR)
                                                        $endyear2 = $endyear + 1; //
                                                    @endphp
                                                    {{ 'REG FORMS' . $semester2 . 'STSEM' . $startyear2 . '' . $endyear2 }}
                                                @endif
                                            </th>
                                            <th>REMARKS</th>
                                            <th>STATUSENDORSEMENT</th>
                                            <th>STATUSENDORSEMENT2</th>
                                            <th>STATUS</th>
                                            <th>NOTATIONS</th>
                                            <th>SUMMER</th>
                                            <th>FARELEASEDTUITION</th>
                                            <th>FARELEASEDTUITIONBOOKSTIPEND</th>
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



                        {{-- YEAR LOGIC --}}




                        {{-- OFF-CANVAS --}}
                        <div class="offcanvas offcanvas-end" id="editModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <table class="canvastable" style="width: 100%">

                                    <tr>
                                        <th class="canvasth"><strong>ID:</strong></th>
                                        <td class="canvastable">
                                            <input disabled class="form-control form-control-sm" id="idField" name="idField" placeholder="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>Name:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="nameField" name="nameField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>Gender:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="genderField" name="genderField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>Program:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="programField" name="programField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>School:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="schoolField" name="schoolField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>Course:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="courseField" name="courseField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>GRADES:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="gradesField" name="gradesField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>SummerREG:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="summerRegField" name="summerRegField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>REGFORMS:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="regFormsField" name="regFormsField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>REMARKS:</strong></th>
                                        <td style="height:100px;   " class="canvastable">
                                            <textarea style=" height: 100px;" class="form-control form-control-sm" id="remarksField" name="remarksField"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>STATUSENDORSEMENT :</strong></th>
                                        <td style="" class="canvastable">
                                            <input class="form-control form-control-sm" id="statusEndorsementField" name="statusEndorsementField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>STATUSENDORSEMENT2 :</strong></th>
                                        <td style="" class="canvastable">
                                            <input class="form-control form-control-sm" id="statusEndorsement2Field" name="statusEndorsement2Field">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>STATUS :</strong></th>
                                        <td style="" class="canvastable">
                                            <input class="form-control form-control-sm" id="statusField" name="statusField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>NOTATIONS :</strong></th>
                                        <td style="" class="canvastable">
                                            <textarea style=" height: 100px;" class="form-control form-control-sm" id="notationsField" name="notationsField"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>SUMMER :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="summerField" name="summerField">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="canvasth"><strong>FARELEASEDTUITION :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="faReleaseTuitionField" name="faReleaseTuitionField">
                                        </td>
                                    </tr>
                                    <tr style="">
                                        <th class="canvasth"> <strong>FARELEASEDTUITION BOOKSTIPEND:</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="faReleaseTuitionBookStipendField" name="faReleaseTuitionBookStipendField">
                                        </td>
                                    </tr>
                                    <tr style="">
                                        <th class="canvasth"> <strong>LVDCAccount :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="lvdCAccountField" name="lvdCAccountField">
                                        </td>
                                    </tr>
                                    <tr style="">
                                        <th class="canvasth"> <strong>HVCNotes :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="hvcNotesField" name="hvcNotesField">
                                        </td>
                                    </tr>
                                    <tr style="">
                                        <th class="canvasth"> <strong>SEMESTER :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="semesterField" name="semesterField">
                                        </td>
                                    </tr>
                                    <tr style="display:none">
                                        <th class="canvasth"> <strong>STARTYEAR :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="startyearField" name="startyearField">
                                        </td>
                                    </tr>
                                    <tr style="display:none">
                                        <th class="canvasth"> <strong>ENDYEAR :</strong></th>
                                        <td class="canvastable">
                                            <input class="form-control form-control-sm" id="endyearField" name="endyearField">
                                        </td>
                                    </tr>


                                </table>
                                <button type="button" class="btn btn-primary mt-1" id="saveChangesBtn">Save
                                    Changes</button>
                            </div>


                        </div>

                    </div>
                </main>
            </div>
        </div>



        <script src="{{ asset('js/all.js') }}"></script>
        <!-- Include DataTables JS -->
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            jQuery(document).ready(function($) {

                jQuery.noConflict();
                var startyearValue = $('#startyear').val();
                var endyearValue = $('#endyear').val();
                var semesterValue = $('#semester').val();

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

                                return '<td >' +
                                    '<a href="#" class="edit-btn" data-number="' + number +
                                    '"> <i class="fad fa-pencil" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></a> <a href="#" class="view-btn" data-number="' +
                                    number +
                                    '"><i class="fad fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></a>' +
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
                            data: 'SCHOLARSHIPPROGRAM',
                            render: function(data, type, row) {
                                // Apply custom styles to the email address
                                var styledgender = '<span style="padding-right: 50px;">' + data +
                                    '</span>';
                                return styledgender;
                            }

                        },
                        {
                            data: 'SCHOOL',
                            render: function(data, type, row) {
                                // Apply custom styles to the email address
                                var styledschool = '<span style="padding-right: 30px;">' + data +
                                    '</span>';
                                return styledschool;
                            }
                        },
                        {
                            data: 'COURSE',
                            render: function(data, type, row) {
                                // Apply custom styles to the email address
                                var stylecourse = '<span style="padding-right: 30px;">' + data +
                                    '</span>';
                                return stylecourse;
                            }

                        },
                        {
                            data: 'GRADES',
                            name: 'GRADES' + semesterValue2 + 'SEM' + startyearValue - 1 + endyearValue - 1
                        },
                        {
                            data: 'SummerREG',

                        },
                        {
                            data: 'regformsDetails',

                        },
                        {
                            data: 'remarksDetails',

                        },
                        {
                            data: 'STATUSENDORSEMENT',

                        },
                        {
                            data: 'STATUSENDORSEMENT2',

                        },
                        {
                            data: 'STATUS',

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
                        // {
                        //     data: 'semester',

                        // }



                    ],
                    columnDefs: [{
                            targets: 'action-column', // Use a class to target the specific column
                            className: 'text-center',
                        },
                        {
                            targets: [0, 2], // Index of the "No" column
                            orderable: false,
                            searchable: false,
                        },
                        {
                            targets: [0, 3, 5, 6, 7, 19, 4],
                            orderable: false,
                        },

                    ],
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    scrollX: true,
                    order: [
                        [1, 'asc'] //set batch sort from lowest
                    ],
                    fixedColumns: {
                        leftColumns: 4,
                    },
                    createdRow: function(row, data, dataIndex) {
                        $(row).find('.action-column').addClass('text-center');
                    },


                    initComplete: function() {
                        this.api().columns([5, 4, 6, 7]).every(function(d) {
                            var column = this;
                            var select = $(
                                    "<select style=\"padding-top:1px !important; padding-bottom:1px !important;\" class=\"form-control\"><option value=\"\">" +
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
                        url: '{{ url('/get-ongoing/') }}' + '/' + number,
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
                            $('#editModal #regFormsField').val(data.regformsDetails); //ongoingregforms table
                            $('#editModal #remarksField').val(data.remarksDetails); //ongoingremarks table
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
                            NUMBER: $('#editModal #idField').val(),
                            NAME: $('#editModal #nameField').val(),
                            MF: $('#editModal #genderField').val(),
                            SCHOLARSHIPPROGRAM: $('#editModal #programField').val(),
                            SCHOOL: $('#editModal #schoolField').val(),
                            COURSE: $('#editModal #courseField').val(),
                            GRADES: $('#editModal #gradesField').val(),
                            SummerREG: $('#editModal #summerRegField').val(),
                            regformsDetails: $('#editModal #regFormsField').val(), //ongoingregforms table
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
                            semester: $('#editModal #semesterField').val(),
                            startyear: $('#editModal #startyearField').val(),
                            endyear: $('#editModal #endyearField').val(),
                            remarksDetails: $('#editModal #remarksField').val(), //ongoingremarks table
                        };


                        // Send the updated data to the server using AJAX
                        $.ajax({
                            url: '{{ url('/savechangesongongoing/') }}' + '/' + number, // Replace with your server endpoint
                            method: 'post', // You can use POST or PUT based on your server-side implementation
                            data: updatedData,
                            success: function(response) {
                                // Handle success, e.g., close the modal or show a success message

                                notyf.success({
                                    message: 'Record has been edited.',
                                    duration: 3000,
                                    position: {
                                        x: 'right',
                                        y: 'top',
                                    },
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
                        text: '<i class="fas fa-print"></i>',
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
                                'border': '2px solid black',
                                'margin': '0.5rem'
                            });
                            //$(win.document.body).find('table th').css({'border': '1px solid black','margin': '10px'});


                            $(win.document.body).find('table td, table th').css({
                                'padding-left': '0.5rem',
                                'padding-right': '0.5rem'
                            });


                            // Customize the header names
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
                                    'border': '2px solid black', // Add border to the header
                                    'width': '100%', // Corrected syntax for the width property
                                });
                            });

                            // Customize the data in the second column (index 1)
                            $(win.document.body).find('table tbody td:nth-child(2)').each(function(index) {
                                // Set the content of each cell in the second column to be the index + 1
                                $(this).text(index + 1); //modified dec 18 2023
                            });


                            $(win.document.body).find('table').removeClass('table-striped');

                            var style = '@page { margin: 1cm; } @media print { body { margin: 1cm; } table { width: 100%; } }';
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
