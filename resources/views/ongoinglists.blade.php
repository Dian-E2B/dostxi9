<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        <!-- Include DataTables CSS -->
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">


        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        {{-- Jquery Js --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            /* div.dataTables_scrollBody thead {
    display: none;
} */

            /* #yourDataTable thead th,
#yourDataTable tbody td {
    box-sizing: border-box;
} */
            body {


                /*  font-size: 12pt; */
            }



            /*     th {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-collapse: separate;
            } */

            /*   table td {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-right-width: thin;
                color: black;
            } */


            /*  .text-center {
                text-align: center;
            } */


            /* body{
            background-color: rgb(255, 255, 255);
        } */
            .content {}

            @media print {
                #logo {
                    display: block;
                    position: relative;
                    top: 0;
                    left: 0;

                }


            }

            /* .viewtd,
            .viewth {
                text-align: center !important;
                vertical-align: middle !important;

                margin-left: auto;
                margin-right: auto;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            } */
        </style>
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}

        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
            <div class="main">

                <div class="container-fluid">
                    <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col">
                                    <table id="yourDataTable" cellspacing="0" class="table-striped compact datatable" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Acadyear</th>
                                                <th></th>
                                                <th>Semester</th>
                                                <th>Total Records</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($results as $result)
                                                <tr>
                                                    <td>{{ $result->startyear }}</td>
                                                    <td>{{ $result->endyear }}</td>
                                                    <td>
                                                        @switch($result->semester)
                                                            @case(1)
                                                                1st Semester
                                                            @break

                                                            @case(2)
                                                                2nd Semester
                                                            @break

                                                            @case(0)
                                                                Summer
                                                            @break

                                                            @default
                                                                3rd
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $result->group_year }}</td>
                                                    <td><a class="view-btn" data-startyear="{{ $result->startyear }}" data-endyear="{{ $result->endyear }}" data-semester="{{ $result->semester }}"><i class="fas fa-eye"></i>
                                                    </td>
                                                    <!-- Add other columns as needed -->
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
        </main>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontaws.js') }}"></script>

        <script>
            jQuery(document).ready(function($) {

                var table = $('#yourDataTable').DataTable({
                    autoWidth: false,
                    processing: true,
                    scrollX: true,
                    "order": [],
                    "columnDefs": [{
                        "targets": 4, // Index of the 5th column (zero-based index)
                        "orderable": false // Disable sorting for this column
                    }]


                });


            });

            $(document).on('click', '.view-btn', function() {
                var startyear = $(this).data('startyear');
                var endyear = $(this).data('endyear');
                var semester = $(this).data('semester');

                var url = '{{ url('/rsms2/') }}' + '/' + startyear + '/' + endyear + '/' + semester;
                window.location.href = url;
            });
        </script>

    </body>

</html>
