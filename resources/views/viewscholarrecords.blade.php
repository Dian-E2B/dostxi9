<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Jquery Js --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
    </head>
    <style>
        .customtable,
        .customth,
        .customtd {
            /* border-width: thin;
            border: 1px solid rgb(198, 198, 198); */
            border-collapse: collapse;
        }

        .customth,
        .customtd {
            padding: 3px;
            text-align: left;
        }

        .table td,
        .table th {

            padding: 0 !important;
            margin: 0 !important;
            border-collapse: collapse !important;
            text-align: center;
        }


        /* Add more styles as needed */
    </style>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
            <div class="wrapper">

                <div class="row">
                    <div class="col-md-6 col-lg-9">
                        <div class="card">

                            <div class="card-body">
                                <div class="">
                                    <div class="mt-3 h5 mb-3" style="font-weight: 700">Grades Submitted</div>
                                    <div class="tab mt-2">

                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item"><a class="nav-link tablinks" href="{{ url()->previous() }}"><i class="fas fa-arrow-square-left"></i></a></li>
                                            <li class="nav-item"><a class="nav-link tablinks active" href="#tab-1" data-bs-toggle="tab" role="tab">Grading</a></li>
                                            {{-- <li class="nav-item"><a class="nav-link tablinks" id="tab2" href="#tab-2" data-bs-toggle="tab" role="tab">Comments</a></li> --}}
                                            {{--  <li class="nav-item"><a class="nav-link tablinks" id="tab3" href="#tab-3" data-bs-toggle="tab" role="tab">Documents</a></li> --}}
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-1" role="tabpanel">
                                                @php
                                                    $years = 0; // Initialize $years with an initial value
                                                @endphp
                                                @foreach ($resultArray as $year => $semesters)
                                                    @php
                                                        $years++; // Increment $years by 1 for each year
                                                    @endphp
                                                    <div style="text-align: center">SCHOOL YEAR {{ $year }} - {{ $year + 1 }}</div>
                                                    <div class="row">
                                                        @foreach ($semesters as $semester => $data)
                                                            <div class="col-lg-3">
                                                                <div class="table-responsive">
                                                                    <table id="thisdatatable" class="datatable table display nowrap compact table-bordered" style="width:100%; border-color: black">
                                                                        <thead>
                                                                            <tr class="">
                                                                                <th colspan="4" class="">
                                                                                    @if ($semester == 1)
                                                                                        1ST SEMESTER
                                                                                    @elseif ($semester == 2)
                                                                                        2ND SEMESTER
                                                                                    @else
                                                                                        SUMMER
                                                                                    @endif
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Subject</th>
                                                                                <th>Grade</th>
                                                                                <th>Unit</th>
                                                                                <th>Verify</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($data as $record)
                                                                                {{-- Check if "cogdetails" is not empty and is an array --}}
                                                                                @if (!empty($record['cogdetails']) && is_array($record['cogdetails']))
                                                                                    {{-- If "cogdetails" is an array and not empty, loop through its items --}}
                                                                                    @foreach ($record['cogdetails'] as $cogDetail)
                                                                                        <tr>
                                                                                            <td>{{ $cogDetail['subjectname'] ?? 'N/A' }}</td>
                                                                                            <td>{{ $cogDetail['grade'] ?? 'N/A' }}</td>
                                                                                            <td>{{ $cogDetail['unit'] ?? 'N/A' }}</td>
                                                                                            <td> <a href="#" class="edit-btn" data-number="{{ $cogDetail['id'] }}"><i class="fad fa-pencil" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></a></td>
                                                                                        </tr>

                                                                                        {{-- Add other columns from "CogDetails" as needed --}}
                                                                                    @endforeach
                                                                                @else
                                                                                    {{-- If "cogdetails" is empty or not an array --}}
                                                                                    <tr>
                                                                                        <td>{{ $record['cogdetails']['subjectname'] ?? 'N/A' }}</td>
                                                                                        <td>{{ $record['cogdetails']['grade'] ?? 'N/A' }}</td>
                                                                                        <td>{{ $record['cogdetails']['unit'] ?? 'N/A' }}</td>
                                                                                        <td> <a href="#" class="edit-btn" data-number="{{ $record['cogdetails']['id'] ?? 'N/A' }}"><i class="fad fa-pencil" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></a></td>
                                                                                    </tr>

                                                                                    {{-- Add other columns from "CogDetails" as needed --}}
                                                                                @endif
                                                                                <tr>
                                                                                    <td>scholarshipstatus</td>
                                                                                    <td colspan="2">
                                                                                        @if (isset($record['scholarshipstatus']))
                                                                                            {{ $record['scholarshipstatus'] }}
                                                                                        @endif
                                                                                    </td>
                                                                                    <td><a href="#" class="edit-scholarshipstatusbtn" data-cognumber="{{ $record['id'] }}"><i class="fad fa-pencil" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></i></a></td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        <div class="col-lg-3">
                                                            <div style="text-align: center">
                                                                <table class="table">
                                                                    <thead class="">
                                                                        <th class="">
                                                                            @if ($years == 1)
                                                                                1st year
                                                                            @elseif ($years == 2)
                                                                                2nd year
                                                                            @elseif ($years == 3)
                                                                                3rd year
                                                                            @else
                                                                                {{ $years }}th year
                                                                            @endif
                                                                        </th>

                                                                    </thead>
                                                                    <tbody class="">
                                                                        @php

                                                                        @endphp
                                                                        <td class="">GWA</td>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <button class="print-button btn " style="background-color: rgb(240, 240, 240)"><input hidden type="text" class="print-btn" id="print-btn" value="{{ $number }}" /><i class="fad fa-print" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></button>

                                                {{-- START OFFCANVAS --}}
                                                <div class="offcanvas offcanvas-start" id="editModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                                                    <div class="offcanvas-header">
                                                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
                                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <table class="datatable customtable" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="customth">ID</th>
                                                                    <td class="customtd"> <input disabled class="form-control form-control-sm" id="idField" name="idField" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="customth">Subject Name:</th>
                                                                    <td class="customtd"> <input class="form-control form-control-sm" id="subjectField" name="subjectField"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="customth">Grade:</th>
                                                                    <td class="customtd"> <input class="form-control form-control-sm" id="gradeField" name="gradeField"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="customth">Unit:</th>
                                                                    <td class="customtd"> <input class="form-control form-control-sm" id="unitField" name="unitField"></td>
                                                                </tr>
                                                        </table>
                                                        <button type="button" class="btn btn-success mt-3" id="CompletegradeBtn">Complete</button><br>
                                                        <button type="button" class="btn btn-primary mt-3" id="saveChangesBtn">Save Changes</button>
                                                    </div>

                                                </div>

                                                {{-- SCHOLARSHIP OFFCANVAS --}}
                                                <div class="offcanvas offcanvas-start" id="editscholarshipModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" aria-labelledby="offcanvasScrollingLabel">
                                                    <div class="offcanvas-header">
                                                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
                                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <table class="customtable" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="customth">ID</th>
                                                                    <td class="customtd"> <input class="form-control form-control-sm" id="cogdetaildIDField" name="cogdetaildIDField" placeholder=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="customth">Scholarship Status</th>
                                                                    <td class="customtd"> <input class="form-control form-control-sm" id="scholarshipField" name="scholarshipField" placeholder=""></td>
                                                                </tr>

                                                            <tbody>
                                                            </tbody>
                                                        </table>

                                                        <button type="button" class="btn btn-primary mt-3" id="SaveChangesScholarshipStatusBtn">Save Changes</button>
                                                    </div>
                                                </div>

                                            </div>
                                            {{--  <div class="tab-pane" id="tab-2" role="tabpanel">
                                                <table id="thisdatatable2" class="display nowrap compact table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>View: </th>
                                                            <th>COR/COG detail: </th>
                                                            <th>Semester:</th>
                                                            <th>Startyear:</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div> --}}
                                            {{--    <div class="tab-pane" id="tab-3" role="tabpanel">
                                                <table id="thisdatatable3" class="datatable display nowrap compact table-striped" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>View: </th>
                                                            <th>Document Name: </th>
                                                            <th>Document Name: </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-3">
                                        <thead class="">
                                            <tr class="">
                                                <th class="">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <tr class="">
                                                <td class="">
                                                    <textarea class="form-control" name="" id="" rows="5" class=""></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function($) {

            $(document).on('click', '.print-button', function() {
                // Get the value of the input field with the class 'print-btn'
                var number = $('.print-btn').val();
                // Assuming you want to append the value to a URL
                var url = '{{ url('/officialrsms/') }}' + '/' + number;
                // Redirect to the constructed URL

                // Open a new window or a new tab with the specified URL
                var newWindow = window.open(url, '_blank');

                // Once the new window is open, initiate the print action
                /*  newWindow.onload = function() {
                     newWindow.print();

                     // Check every second if the new window is closed or canceled
                     var intervalId = setInterval(function() {
                         if (newWindow.closed || !newWindow.printing) {
                             clearInterval(intervalId);
                             // Close the new window if it's not already closed
                             if (!newWindow.closed) {
                                 newWindow.close();
                             }
                         }
                     }, 1000);
                 }; */

            });

            var table = $('').DataTable({});

            $(document).on('click', '.edit-btn', function() {
                var number = $(this).data('number');
                $.ajax({
                    url: '{{ url('/getscholargrades/') }}' + '/' + number,
                    method: 'GET',
                    success: function(data) {
                        $('#editModal #idField').val(data.id);
                        $('#editModal #subjectField').val(data.subjectname);
                        $('#editModal #gradeField').val(data.grade);
                        $('#editModal #unitField').val(data.unit);
                        $('#editModal').offcanvas('show');


                        $('#saveChangesBtn').off('click').click(function() {
                            // Gather the updated data from the modal fields
                            var updatedData = {
                                // NUMBER: $('#editModal #idField').val(),
                                subjectname: $('#editModal #subjectField').val(),
                                grade: $('#editModal #gradeField').val(),
                                unit: $('#editModal #unitField').val(),

                            };

                            // Send the updated data to the server using AJAX
                            $.ajax({
                                url: '{{ url('/savecholargrades/') }}' + '/' + number, // Replace with your server endpoint
                                method: 'POST', // You can use POST or PUT based on your server-side implementation
                                data: updatedData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    // Handle success, e.g., close the modal or sho w a success message
                                    console.log('Changes saved successfully:', response);
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Record updated.',
                                        icon: 'info',
                                        width: '500px',
                                        confirmButtonText: 'Okay',
                                    })

                                    location.reload();

                                    $('#editModal input').val('');
                                    $('#editModal').offcanvas('hide'); // Assuming you want to hide the modal on success

                                },
                                error: function(error) {
                                    console.error('Error saving changes:', error);
                                }
                            });
                        });

                        $('#CompletegradeBtn').off('click').click(function() {

                            // Send the updated data to the server using AJAX
                            $.ajax({
                                url: '{{ url('/completescholargrades/') }}' + '/' + number,
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {

                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Record updated.',
                                        icon: 'info',
                                        width: '500px',
                                        confirmButtonText: 'Okay',
                                    })

                                    location.reload();

                                    $('#editModal input').val('');
                                    $('#editModal').offcanvas('hide');

                                },
                                error: function(error) {
                                    console.error('Error saving changes:', error);
                                }
                            });
                        });

                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });

            });




            $(document).on('click', '.edit-scholarshipstatusbtn', function() {
                var number = $(this).data('cognumber');
                // scholarshipField
                // SaveChangesScholarshipStatusBtn
                // editscholarshipModal
                $.ajax({
                    url: '{{ url('/getscholarshipstatus/') }}' + '/' + number,
                    method: 'GET',
                    success: function(scholarshipstatusupdateddata) {
                        $('#editscholarshipModal #cogdetaildIDField').val(scholarshipstatusupdateddata.id);
                        $('#editscholarshipModal #scholarshipField').val(scholarshipstatusupdateddata.scholarshipstatus);
                        $('#editscholarshipModal').offcanvas('show');

                        $('#SaveChangesScholarshipStatusBtn').off('click').click(function() {
                            var scholarshipstatusupdateddata = {
                                // id: $('#editscholarshipModal #cogdetaildIDField').val();
                                scholarshipstatus: $('#editscholarshipModal #scholarshipField').val(),
                            };

                            // Send the updated data to the server using AJAX
                            $.ajax({
                                url: '{{ url('/savescholarshipstatus/') }}' + '/' + number, // Replace with your server endpoint
                                method: 'POST', // You can use POST or PUT based on your server-side implementation
                                data: scholarshipstatusupdateddata,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    // Handle success, e.g., close the modal or sho w a success message
                                    console.log('Changes saved successfully:', response);
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Record updated.',
                                        icon: 'info',
                                        width: '500px', // Set the width of the dialog box
                                        confirmButtonText: 'Okay',
                                    })

                                    location.reload();

                                    $('#editscholarshipModal input').val('');
                                    $('#editscholarshipModal').offcanvas('hide');

                                },
                                error: function(error) {
                                    console.error('Error saving changes:', error);
                                }
                            });
                        });

                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });

            });

            var table1;
            var table2;
            var table3;

            $('#tab-1').on('shown.bs.tab', function(e) {
                if (!table1Initialized) {
                    $('#thisdatatable').DataTable().columns.adjust().responsive.recalc().draw();
                    table1Initialized = true;
                }
            });

            /*  $('#tab2').on('click', function() {
                 if (!table2) {
                     table2 = $('#thisdatatable2').DataTable({
                         autoWidth: true,
                         select: true,
                         processing: true,
                         serverSide: true,
                         responsive: true,

                         // pageLength: 20, // Set the default page length to 10 rows
                         ajax: "{{ route('getprospectusdata', ['number' => $number]) }}", // Adjust this route to your actual route
                         type: 'GET',
                         columns: [{
                                 data: null,
                                 orderable: false,
                                 searchable: false,
                                 render: function(data, type, row) {
                                     var number = row
                                         .id; // Assuming 'NUMBER' is the column name in your database

                                     return '<td >' +
                                         '<a href="#" class="view-btn" data-id="' + number +
                                         '"><i class="fa fa-eye"></i></a>' + '</td>';
                                 }
                             },
                             // {
                             //     data: 'id',
                             // },
                             {
                                 data: 'date_uploaded',
                             },
                             {
                                 data: 'semester',
                             },
                             {
                                 data: 'startyear',
                             },

                         ],
                         fixedHeader: {
                             header: true,
                             footer: true
                         },
                         scrollX: true,

                     });
                 } else {
                     table2.columns.adjust().responsive.recalc().draw();
                 }
             }); */

            /*  $('#tab3').on('click', function() {
                 if (!table3) {
                     table3 = $('#thisdatatable3').DataTable({
                         autoWidth: true,
                         select: true,
                         processing: true,
                         serverSide: true,
                         responsive: true,

                         // pageLength: 20, // Set the default page length to 10 rows
                         ajax: "{{ route('getdocumentsdata', ['number' => $number]) }}", // Adjust this route to your actual route
                         type: 'GET',
                         columns: [{
                                 data: null,
                                 orderable: false,
                                 searchable: false,
                                 render: function(data, type, row) {
                                     var number = row
                                         .id; // Assuming 'NUMBER' is the column name in your database

                                     return '<td >' +
                                         '<a href="#" class="view-btndocument" data-id="' + number +
                                         '"><i class="fad fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></a>' + '</td>';
                                 }
                             },
                             {
                                 data: 'document_details',
                             },
                             {
                                 data: 'document',
                             },

                         ],
                         fixedHeader: {
                             header: true,
                             footer: true
                         },
                         scrollX: true,

                     });
                 } else {
                     table3.columns.adjust().responsive.recalc().draw();
                 }
             }); */
            /*
                        $(document).on('click', '.view-btndocument', function() {
                            var number = $(this).data('id');
                            var url = '{{ url('/viewdocument/') }}' + '/' + number;
                            window.location.href = url;
                        });

                        $(document).on('click', '.view-btn', function() {
                            var number = $(this).data('id');
                            var url = '{{ url('/viewscholarprospectus/') }}' + '/' + number;
                            window.location.href = url;
                        }); */





            // Code for the second tab


        });
    </script>
    <script></script>

</html>
