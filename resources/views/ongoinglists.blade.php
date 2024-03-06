<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Include DataTables CSS -->

        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">


        <link href="{{ asset('css/all.css') }}">

        <!-- Include jQuery -->






        <style>
            /* div.dataTables_scrollBody thead {
    display: none;
} */

            /* #yourDataTable thead th,
#yourDataTable tbody td {
    box-sizing: border-box;
} */
            body {
                background-color: #dddddd;

                /*  font-size: 12pt; */
            }



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

            .viewtd,
            .viewth {
                text-align: center !important;
                vertical-align: middle !important;

                margin-left: auto;
                margin-right: auto;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
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


                        <div class="">
                            <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">

                            <div class="">


                                <table id="yourDataTable" class="display nowrap compact table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Startyear</th>
                                            <th>Endyear</th>
                                            <th>Semester</th>
                                            <th>Total Records</th>
                                            <th class="viewth" style="align-items: center !important;">View</th>
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

                                                        @case(3)
                                                            Summer
                                                        @break

                                                        @default
                                                            Unknown
                                                    @endswitch
                                                </td>
                                                <td>{{ $result->group_year }}</td>
                                                <td style="width: 40px !important; text-align: center"><a class="view-btn" data-startyear="{{ $result->startyear }}" data-endyear="{{ $result->endyear }}" data-semester="{{ $result->semester }}"><i class=" fas fa-eye"></i></a></td>
                                                <!-- Add other columns as needed -->
                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>



                            </div>

                            <div>


                            </div>




                        </div>





                </main>







            </div>
        </div>



        <script src="{{ asset('js/all.js') }}"></script>

        <!-- Include DataTables JS -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            jQuery(document).ready(function($) {
                jQuery.noConflict();
                var table = $('#yourDataTable').DataTable({
                    processing: true,
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    scrollX: true,
                    "order": [],
                    "columnDefs": [{
                        "targets": 4, // Index of the 5th column (zero-based index)
                        "orderable": false // Disable sorting for this column
                    }]
                });
                console.log('Document is ready!');

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
    {{-- SIDEBAR TOGGLING --}}

    <!-- Include SweetAlert2 JS -->




</html>
