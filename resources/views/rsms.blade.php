<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Include DataTables CSS -->
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


        <link href="{{ asset('css/all.css') }}">







        <style>
            /* div.dataTables_scrollBody thead {
    display: none;
} */

            /* #yourDataTable thead th,
#yourDataTable tbody td {
    box-sizing: border-box;
} */



            th {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-collapse: separate;
            }

            table td {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-right-width: thin;
                color: black;
            }


            .text-center {
                text-align: center;
            }

            /* body{
            background-color: rgb(255, 255, 255);
        } */
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


            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}



            <div class="main">
                @include('layouts.header')

                <main class="content" style="padding:0.5rem 0.5rem 0.5rem">




                    <div class="">


                        <div class="">
                            <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">

                            <div class="">


                                <table id="yourDataTable" class="display nowrap compact table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:center;">Action</th>
                                            <th>Batch</th>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>MF</th>
                                            <th>Scholarship Program</th>
                                            <th>School</th>
                                            <th>Course</th>
                                            <th>Grades2NDSEM20212022</th>
                                            <th>SummerREG</th>
                                            <th>REGFORMS1STSEM20222023</th>
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
                                            <th>semester</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- DataTable content will be dynamically added here -->
                                    </tbody>

                                </table>



                            </div>

                            <div>
                                <form id="filterForm" action="{{ route('rsms2') }}" method="GET">
                                    <label for="startyear">Start Year:</label>
                                    <select name="startyear" id="startyear">
                                        @foreach ($startyears as $startyear)
                                            <option value="{{ $startyear }}">{{ $startyear }}</option>
                                        @endforeach
                                    </select>

                                    <label for="endyear">End Year:</label>
                                    <select name="endyear" id="endyear">
                                        @foreach ($endyears as $endyear)
                                            <option value="{{ $endyear }}">{{ $endyear }}</option>
                                        @endforeach
                                    </select>

                                    <label for="semester">Semester:</label>
                                    <select name="semester" id="semester">

                                        <option value="1">1st</option>
                                        <option value="2">2nd</option>
                                        <option value="3">Summer</option>

                                    </select>

                                    <button id="filterBtn">Filter</button>
                            </div>
                            </form>

                        </div>


                        {{-- OFF-CANVAS --}}
                        <div class="offcanvas offcanvas-start" id="editModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="row align-items-center mb-1">
                                    <div class="col-3">
                                        <strong>ID:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="idField" name="idField" placeholder="">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3">
                                        <strong>Name:</strong>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control" id="nameField" name="nameField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3">
                                        <strong>Gender:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="genderField" name="genderField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3">
                                        <strong>Program:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="programField" name="programField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3">
                                        <strong>School:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="schoolField" name="schoolField">
                                    </div>
                                </div>
                                <div class="row align-items-center mb-1">
                                    <div class="col-3">
                                        <strong>Course:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="courseField" name="courseField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-6">
                                        <strong>GRADES2NDSEM20212022:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="gradesField" name="gradesField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>SummerREG:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="summerRegField" name="summerRegField">
                                    </div>
                                </div>

                                <div class="row">

                                    <strong>REGFORMS1STSEM20222023:</strong>


                                    <textarea class="form-control" id="regFormsField" name="regFormsField"></textarea>

                                </div>

                                <div class="row align-items-center">
                                    <div class="">
                                        <strong>REMARKS:</strong>
                                    </div>
                                    <div class="">
                                        <textarea class="form-control" id="remarksField" name="remarksField"></textarea>
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>STATUSENDORSEMENT:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="statusEndorsementField" name="statusEndorsementField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>STATUSENDORSEMENT2:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="statusEndorsement2Field" name="statusEndorsement2Field">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>STATUS:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="statusField" name="statusField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>SUMMER:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="summerField" name="summerField">
                                    </div>
                                </div>


                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>FARELEASEDTUITION:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="faReleaseTuitionField" name="faReleaseTuitionField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-md-auto">
                                        <strong>FARELEASEDTUITIONBOOKSTIPEND:</strong>
                                    </div>
                                    <div class="col-md-auto">
                                        <input class="form-control" id="faReleaseTuitionField" name="faReleaseTuitionField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>LVDCAccount:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="lvdCAccountField" name="lvdCAccountField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5">
                                        <strong>HVCNotes:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="hvcNotesField" name="hvcNotesField">
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>





                </main>

            </div>
        </div>



        <script src="{{ asset('js/all.js') }}"></script>
        <!-- Include DataTables JS -->
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            jQuery(document).ready(function($) {

                var table = $('#yourDataTable').DataTable({
                    processing: true,
                    serverSide: true,

                    // pageLength: 20, // Set the default page length to 10 rows
                    ajax: '{{ route('datatable.data') }}', // Adjust this route to your actual route
                    type: 'POST',

                    columns: [{
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                var number = row.NUMBER; // Assuming 'NUMBER' is the column name in your database

                                return '<td class="text-center" style="text-align: center !important;">' +
                                    '<a href="#" class="edit-btn" data-number="' + number +
                                    '"><i class="fa fa-pencil"></i></a></td>';
                            }
                        },
                        {
                            data: 'BATCH',
                            name: 'BATCH'
                        },
                        {
                            data: 'NUMBER',
                            name: 'NUMBER'
                        },
                        {
                            data: 'NAME',
                            name: 'NAME'
                        },
                        {
                            data: 'MF',
                            name: 'MF'
                        },
                        {
                            data: 'SCHOLARSHIPPROGRAM',
                            name: 'SCHOLARSHIPPROGRAM'
                        },
                        {
                            data: 'SCHOOL',
                            name: 'SCHOOL'
                        },
                        {
                            data: 'COURSE',
                            name: 'COURSE'
                        },
                        {
                            data: 'GRADES2NDSEM20212022',
                            name: 'GRADES2NDSEM20212022'
                        },
                        {
                            data: 'SummerREG',
                            name: 'SummerREG'
                        },
                        {
                            data: 'REGFORMS1STSEM20222023',
                            name: 'REGFORMS1STSEM20222023'
                        },
                        {
                            data: 'REMARKS',
                            name: 'REMARKS'
                        },
                        {
                            data: 'STATUSENDORSEMENT',
                            name: 'STATUSENDORSEMENT'
                        },
                        {
                            data: 'STATUSENDORSEMENT2',
                            name: 'STATUSENDORSEMENT2'
                        },
                        {
                            data: 'STATUS',
                            name: 'STATUS'
                        },
                        {
                            data: 'NOTATIONS',
                            name: 'NOTATIONS'
                        },
                        {
                            data: 'SUMMER',
                            name: 'SUMMER'
                        },
                        {
                            data: 'FARELEASEDTUITION',
                            name: 'FARELEASEDTUITION'
                        },
                        {
                            data: 'FARELEASEDTUITIONBOOKSTIPEND',
                            name: 'FARELEASEDTUITIONBOOKSTIPEND'
                        },
                        {
                            data: 'LVDCAccount',
                            name: 'LVDCAccount'
                        },
                        {
                            data: 'HVCNotes',
                            name: 'HVCNotes'
                        },
                        {
                            data: 'startyear',
                            name: 'startyear'
                        },
                        {
                            data: 'endyear',
                            name: 'endyear'
                        },
                        {
                            data: 'semester',
                            name: 'semester'
                        },

                    ],
                    columnDefs: [{
                            targets: [1], // Index of the "No" column
                            orderable: false,
                            searchable: false,
                        },
                        {
                            targets: [3, 5, 19, 4],
                            orderable: false,
                        },

                    ],
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    scrollX: true,
                    order: [
                        [0, 'asc'] //set batch sort from lowest
                    ],
                    // fixedColumns: {
                    //     leftColumns: 3,
                    // },

                    initComplete: function() {
                        this.api().columns([3, 5, 4]).every(function(d) {
                            var column = this;
                            var theadname = $("#thisdatatable th").eq([d]).text();
                            var select = $(
                                    "<select style=\"padding: 1px !important;\" class=\"form-control\"><option value=\"\"> " +
                                    theadname + " </option></select>"
                                )
                                .appendTo($(column.header()))
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });
                            column.data().unique().sort().each(function(d, j) {
                                select.append("<option value=\"" + d + "\">" + d +
                                    "</option>")
                            });
                        });
                    },

                    drawCallback: function() {


                        let start = table.page.info().start;
                        let i = start + 1;

                        table
                            .column(1, {
                                search: 'applied',
                                order: 'applied'
                            })
                            .nodes()
                            .each(function(cell, index) {
                                cell.innerHTML = i++;
                            });
                    }
                });


                $(document).on('click', '.edit-btn', function() {
                    var number = $(this).data('number');
                    // alert(number); //kuha

                    // Proceed with fetching data for editing
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
                            $('#editModal #gradesField').val(data.GRADES2NDSEM20212022);
                            $('#editModal #summerRegField').val(data.SummerREG);
                            $('#editModal #regFormsField').val(data.REGFORMS1STSEM20222023);
                            $('#editModal #statusEndorsementField').val(data.REMARKS);
                            $('#editModal #statusEndorsement2Field').val(data.STATUSENDORSEMENT);
                            $('#editModal #statusField').val(data.STATUSENDORSEMENT2);
                            $('#editModal #NOTATIONSField').val(data.NOTATIONS);
                            $('#editModal #summerField').val(data.SUMMER);
                            $('#editModal #faReleaseTuitionField').val(data.FARELEASEDTUITION);
                            $('#editModal #faReleaseTuitionBookStipendField').val(data
                                .FARELEASEDTUITIONBOOKSTIPEND);
                            $('#editModal #lvdCAccountField').val(data.LVDCAccount);
                            $('#editModal #hvcNotesField').val(data.HVCNotes);
                            // alert(data.NAME);
                            $('#editModal').offcanvas('show');
                            data.semester = $('#semesterFilter').val();
                            data.start_year = $('#startYearFilter').val();
                            data.end_year = $('#endYearFilter').val();
                        },
                        error: function(error) {
                            console.error('Error fetching data for editing:', error);
                        }
                    });

                });



                var columnsToHide = [20, 21, 22];

                columnsToHide.forEach(function(columnIndex) {
                    table.column(columnIndex).visible(false);
                });




            });






            function customExportAction(e, dt, button, config) {
                var self = this;
                var oldStart = dt.settings()[0]._iDisplayStart;
                dt.one('preXhr', function(e, s, data) {
                    // Just this once, load all data from the server...
                    data.start = 0;
                    data.length = 2147483647;
                    dt.one('preDraw', function(e, settings) {
                        // Call the original action function
                        if (button[0].className.indexOf('buttons-print') >= 0) {
                            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        }
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

            var startYear = document.getElementById("startyear").value;
            var endYear = document.getElementById("endyear").value;
            var semester = document.getElementById("semester").value;
            switch (semester) {
                case '1':
                    semester = '1st Semester';
                    break;
                case '2':
                    semester = '2nd Semester';
                    break;
                case '3':
                    semester = 'Summer';
                    break;
            }

            $.extend(true, $.fn.dataTable.defaults, {
                dom: 'Bflrtip',
                buttons: [{
                    extend: 'print',
                    text: '<i class="fas fa-print"></i>',
                    title: 'ON-GOING SCHOLARS MONITORING CHECKLIST ' + semester + ' AY ' + startYear + '-' + endYear,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                        modifier: {
                            search: 'none'
                        }
                    },
                    action: customExportAction,
                    customize: function(win) {
                        $(win.document.body).find('h1').css('font-size', '20px'); // Change the font size of the title
                        $(win.document.body).find('h1').css('font-weight', 'bold'); // Make the title bold
                        if (win.document.body.innerHTML.indexOf('<img id="logo"') === -1) {
                            $(win.document.body).prepend('<img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}">');
                        }

                        // Add your custom styles and content to the print window
                        $(win.document.body)
                            .css('font-size', '11pt')
                            .find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit')
                            .css('border', '1px solid black'); // Add border to the table

                        // Customize the header names
                        $(win.document.body).find('table thead th').each(function(index) {
                            var customHeaderName;
                            switch (index) {
                                case 0:
                                    customHeaderName = 'BATCH';
                                    break;
                                case 1:
                                    customHeaderName = 'No'; // Change the second column header to 'No'
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
                                    // Add more cases as needed
                                default:
                                    customHeaderName = 'Default Header';
                            }
                            $(this).text(customHeaderName);
                            $(this).css({
                                'white-space': 'pre-wrap',
                                'border': '1px solid black' // Add border to the header
                            });
                        });

                        // Customize the data in the second column (index 1)
                        $(win.document.body).find('table tbody td:nth-child(2)').each(function(index) {
                            // Set the content of each cell in the second column to be the index + 1
                            $(this).text(index + 1);
                        });
                    }
                }]
            });
        </script>

    </body>
    {{-- SIDEBAR TOGGLING --}}

    <!-- Include SweetAlert2 JS -->




</html>
