<!DOCTYPE html>
<html lang="en">

    <head>
        </title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        {{-- Datatables css --}}
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Jquery Js --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    </head>
    <style class=""> </style>

    <body>
        @include('layouts.headernew')
        @include('layouts.sidebarnew')
        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
            <div class="main">

                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="h4" style="">Endorsed</div>
                            <table id="endorsementsTable" class="table-striped table-compact" style="table-layout: fixed; width:100%">
                                <!-- Table header -->
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>School</th>
                                        <th>Course</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <!-- Table body -->
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                        <div class="btn btn-primary print-button btn-sm">Print</div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable

            $('#endorsementsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'endorsedongoing',
                    type: 'get'
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'scholar_id',
                        name: 'scholar_id'
                    },
                    {
                        data: 'course',
                        name: 'course'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    } // Add action column
                ]
            });


            $(document).on('click', '.print-button', function() {
                // Get the value of the input field with the class 'print-btn'
                var number = $('.print-btn').val();
                // Assuming you want to append the value to a URL
                var url = '{{ url('/officialrsms/') }}' + '/' + number;
                // Redirect to the constructed URL

                // Open a new window or a new tab with the specified URL
                var newWindow = window.open(url, '_blank');

                // Once the new window is open, initiate the print action
                newWindow.onload = function() {
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
                };

            });
        });
    </script>

</html>
