<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>
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
                        <div class="row mt-3 ">
                            <div class="row">
                                <div class="col">
                                    <div class="h4 mb-1" style="">Ongoing Endorsed List</div>
                                </div>
                                <div class="col">
                                    <div class="card">

                                        <div class="card-body">

                                            <div class="row g-3 mt-1">

                                                <div class="col-sm">
                                                    <select class="form-control form-control-sm" name="year" id="year" class="" style="width: 100%;">
                                                        <option value="">--Year--</option>
                                                        <!-- Generate options for the current year to the next 10 years -->
                                                        @php
                                                            $currentYear = date('Y');
                                                            $endYear = $currentYear + 10;
                                                        @endphp
                                                        @for ($year = $currentYear; $year <= $endYear; $year++)
                                                            <option value="{{ $year }}">{{ $year }}</option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <div class="col-sm">
                                                    <select class="form-control form-control-sm" style="margin:none;" name="semester" id="semester" style="width: 100%;">
                                                        <option value="">--Semester--</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="0">Summer</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm" style="">
                                                    <button class="btn btn-light print-button btn-sm" style="padding: 2px 12px; width: 100%;"><i style="color: black" class="fas fa-print"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table id="endorsementsTable" class="table-striped table-compact table-sm" style="table-layout: fixed; width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>School</th>
                                                    <th>Course</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#endorsementsTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20,
                ajax: {
                    url: 'endorsedongoing',
                    type: 'get'
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'school',
                        name: 'school',
                        orderable: false,
                    },
                    {
                        data: 'course',
                        name: 'course',
                        orderable: false,
                    },

                ],
                initComplete: function() {
                    var api = this.api();

                    api.columns([1, 2]).every(function(d) {
                        var column = this;
                        // Get the column header name
                        var theadname = $(api.column(d).header()).text();
                        // Create select element
                        var select = document.createElement('select');
                        select.add(new Option(' ' + theadname, ''));

                        // Add styles to the select element
                        select.style.padding = '1px'; // Example padding
                        // Replace the header with the select element
                        column.header().replaceChildren(select);

                        // Apply listener for user change in value
                        select.addEventListener('change', function() {
                            var val = DataTable.util.escapeRegex(select.value);

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                        // Add list of options excluding theadname
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
                    });
                },
            });


            $(document).on('click', '.print-button', function() {
                // Get the value of the input fields with the IDs 'year' and 'semester'
                var year = $('#year').val();
                var semester = $('#semester').val();

                // Check if both year and semester have values
                if (year && semester) {
                    // Construct the URL
                    var url = '{{ url('/endorsedongoingprint/') }}' + '/' + year + '/' + semester;

                    // Redirect to the constructed URL
                    var newWindow = window.open(url, '_blank');

                    // Once the new window is open, initiate the print action
                    newWindow.onload = function() {
                        newWindow.print();
                    };
                } else {
                    // Handle the case where either year or semester is empty
                    Swal.fire({
                        icon: "error",
                        title: "Please select year and semester!",
                    });

                }
            });
        });
    </script>

</html>
