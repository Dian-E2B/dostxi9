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
        <style>
            .form-control {
                color: #000000 !important;
            }

            td {
                user-select: none;
            }


            td:not(.action-column) {
                padding-left: 10px;
                padding-right: 20pt;
            }

            table td {
                border-bottom: 0.5px solid #dddddd;
                border-right: 0.5px solid #dddddd;
                color: #000000
            }

            .form-control-sm {
                font-weight: bold;
            }

            th {
                border-collapse: separate;
                padding-left: 8px;
                padding-right: 8px;
            }

            label {
                font-size: 9pt;
                font-weight: bold;
                color: #000000
            }

            .action-column {
                text-align: center !important;
                border-left: 0.5px solid #dddddd;
            }

            .red {
                color: rgb(6, 185, 240) !important;

            }

            body {}
        </style>
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
        <main id="main">
            <div class="main">

                @error('excel_file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                @if (session('error'))
                    <script>
                        let errorMessage = "{{ session('error') }}";
                        Swal.fire({
                            icon: "error",
                            title: "ERROR!",
                            text: errorMessage,
                            showConfirmButton: true, // Add a confirm button
                            confirmButtonText: "OK" // Customize the text of the confirm button
                        });
                    </script>
                @elseif (session('success'))
                    <script>
                        let successmessage = "{{ session('success') }}";
                        Swal.fire({
                            icon: "success",
                            title: "SUCCESS!",
                            text: successmessage,
                            showConfirmButton: true, // Add a confirm button
                            confirmButtonText: "OK" // Customize the text of the confirm button
                        });
                    </script>
                @endif

                <main class="content">
                    <div class="container-fluid p-0">

                        <div class="card" style="user-select: none !important;">
                            <div class="card-body mt-3">
                                <div class="card col-lg-6 p-2" style="text-align: center; vertical-align: center">
                                    <div class="" style="font-size:1.5em; font-weight: 700">Qualifiers (<span id="divToUpdate">{{ $maxyear }}-{{ $maxyear + 1 }}</span>)
                                    </div>

                                </div>
                                <div class="">
                                    <div class="row row-cols-auto">
                                        <div class="col"> {{-- DROPDOWN FILTER --}}
                                            <button class="btn rounded-pill btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-filter"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <div style="">
                                                    <form id="yearForm" method="POST" action="{{ route('seilistviewajax') }}">
                                                        @csrf
                                                        <div class="px-2" style="max-width: 4.9cm; margin: auto;">
                                                            <select style="" name="startYear" id="startYear" class="form-select">
                                                                @foreach ($years as $year)
                                                                    <option style="" value=" {{ $year }}"> {{ $year }} &nbsp;- &nbsp;{{ $year + 1 }}</option>
                                                                @endforeach
                                                            </select>
                                                            <button id="submitButton" style="background-color: #e3f2fd" class="btn btn-sm mt-2" type="submit"><i class="fas fa-check"></i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col"> {{-- UPDATE SEI BUTTON --}}

                                            <div>
                                                <button style="background-color: #1e88e5; color:rgb(255, 255, 255); {{ request()->is('seilist') ? '' : 'display:none' }}" id="uploadlist" type="button" class="btn dropdown-toggle rounded-pill" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Import SEI List
                                                </button>

                                                <form method="POST" enctype="multipart/form-data" action="{{ route('sei.store') }}">
                                                    <ul style=" " class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <li style="padding: 0px 10px 0px 10px ;min-width: 50% !important;">
                                                            @csrf
                                                            <input class="form-control" type="file" name="excel_file" accept=".xlsx">
                                                        </li>
                                                        <div style="padding: 1%"></div>
                                                        <li style="padding-left: 10px;"><button class="btn btn-primary" type="submit">Import</button></li>
                                                    </ul>
                                                </form>

                                            </div>
                                        </div>
                                        <div class=" col">
                                            <div class="d-flex justify-content-end"> {{-- EMAIL NOTICE BUTTON --}}
                                                <a style="{{ request()->is('seilist') || request()->is('emaileditor') ? '' : 'display:none' }}; background-color: #2979FF; color: snow;" href="{{ route('sendmail') }} " class="btn rounded-pill"> Email Notice to All</a>
                                            </div>
                                        </div>
                                        <div class=" col">
                                            <div class="d-flex justify-content-end"> {{-- EMAIL NOTICE BUTTON --}}
                                                <button type="button" class="btn rounded-pill" data-bs-toggle="modal" style="background-color: #0D47A1; color: snow;" data-bs-target="#endorsedmodal">
                                                    Endorsed
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <br>

                                </div>



                                {{-- TABLE --}}
                                <div class="mt-1">
                                    <table id="thisdatatable" class="table-striped compact table-hover nowrap">

                                        <thead>
                                            <tr>



                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>Middlename</th>
                                                <th>SPAS NO.</th>
                                                <th>Email</th>
                                                <th style="  padding-left: 5px !important; padding-right: 5px !important;">
                                                    <span></span>App ID
                                                </th>
                                                <th style="  padding-left: 5px !important; padding-right: 5px !important;">
                                                    <span style="display: none">Strand </span>
                                                </th>
                                                <th style="  padding-left: 5px !important; padding-right: 5px !important;">
                                                    <span>Program </span>
                                                </th>
                                                <th>Sex</th>
                                                <th>Bithdate</th>
                                                <th>Contact</th>
                                                <th>House number</th>
                                                <th>Street</th>
                                                <th>Village</th>
                                                <th>Barangay</th>
                                                <th style="  padding-left: 5px !important; padding-right: 5px !important;">
                                                    <span> Municipality </span>
                                                </th>
                                                <th>Province</th>
                                                <th>Zipcode</th>
                                                <th>District</th>
                                                <th>Region</th>
                                                <th>HSname</th>
                                                <th>Remarks</th>
                                                <th>Email</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </main>
            </div>

            {{-- MODAL --}}
            <div class="modal fade " id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel" style="font-weight: bold">Scholar Details
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container " style="">
                                <div class="row align-items-center mb-1">
                                    <div class="col-2 customlabel"> <label>ID: </label></div>
                                    <div class="col-4 "> <input class="  form-control  form-control-sm" id="IdField" name="IdField" disabled></div>
                                    <div class="col-2 customlabel"> <label>App ID: </label></div>
                                    <div class="col-4"><input class=" form-control  form-control-sm" id="AppIDField" name="AppIDField"></div>
                                </div>
                                <div class="row align-items-center mb-1">
                                    <div class="col-2 customlabel"> <label>Email: </label></div>
                                    <div class="col-4"> <input class=" form-control   form-control-sm" id="EmailField" name="EmailField"></div>
                                    <div class="col-2 customlabel"> <label>Program: </label></div>
                                    <div class="col-4">
                                        <select name="ProgramField" id="ProgramField" class="form-control form-control-sm">
                                            <option value="101">RA 7687</option>
                                            <option value="201">MERIT</option>
                                            <option value="301">RA 10612</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row align-items-center mb-1">
                                    <div class="col-2 customlabel"> <label>Surname: </label></div>
                                    <div class="col-4 "> <input class="  form-control  form-control-sm" id="SurnameField" name="SurnameField"></div>
                                    <div class="col-2 customlabel"> <label>Strand: </label></div>
                                    <div class="col-4">
                                        <select name="StrandField" id="StrandField" class="form-control form-control-sm">
                                            <option value="STEM">STEM</option>
                                            <option value="NON-STEM">NON-STEM</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="row align-items-center mb-1">


                                    <div class="col-2 customlabel"> <label>Contact: </label></div>
                                    <div class="col-4">
                                        <input class=" form-control   form-control-sm" id="ContactField" name="ContactField">
                                    </div>

                                    <div class="col-2 customlabel"> <label>Gender: </label></div>
                                    <div class="col-4">
                                        <select name="GenderField" id="GenderField" class="form-control form-control-sm">
                                            <option value="1">F</option>
                                            <option value="2">M</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-2 customlabel"> <label>Middlename: </label></div>
                                    <div class="col-4 "> <input class="  form-control  form-control-sm" id="MiddlenameField" name="MiddlenameField"></div>

                                </div>
                                <div class="row align-items-center mb-1">
                                    <div class="col-2 customlabel"> <label>Remarks: </label></div>
                                    <div class="col-10">
                                        <textarea class="form-control  form-control-sm" id="RemarksField" name="RemarksField"></textarea>
                                    </div>
                                </div>
                            </div>
                            {{-- FOOTER --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="saveChangesBtn" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- ENDORSED MODAL --}}
            <div class="modal fade" id="endorsedmodal" tabindex="-1" aria-labelledby="endorsedmodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="endorsedmodalLabel">Endorsed from other region</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Firstname:</span>
                                        <input type="text" class="form-control" placeholder="Firstname" name="Firstname" aria-label="Firstname" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Middlename:</span>
                                        <input type="text" class="form-control" placeholder="Middlename" name="Middlename" aria-label="Middlename" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Surname:</span>
                                        <input type="text" class="form-control" placeholder="Surname" name="Surname" aria-label="Surname" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Birthdate:</span>
                                        <input type="text" class="form-control" placeholder="Birthdate" name="Birthdate" aria-label="Birthdate" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Email:</span>
                                        <input type="text" class="form-control" placeholder="" name="Firstname" aria-label="Firstname" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Birthdate:</span>
                                        <input type="text" class="form-control" placeholder="" name="Middlename" aria-label="Middlename" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">LDVaccount:</span>
                                        <input type="text" class="form-control" placeholder="" name="Surname" aria-label="Surname" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">AppID:</span>
                                        <input type="text" class="form-control" placeholder="" name="Birthdate" aria-label="Birthdate" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontaws.js') }}"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            jQuery.noConflict();

            jQuery(document).ready(function($) {

                $('#submitButton').click(function() {
                    var selectedYear = $('#startYear').val();
                    var nextYear = parseInt(selectedYear) + 1;
                    var yearRange = selectedYear + ' - ' + nextYear;
                    $('#divToUpdate').text(yearRange);
                });

                var table = $('#thisdatatable').DataTable({
                    scrollResize: true,
                    pageResize: true,
                    processing: true,
                    serverSide: true,
                    pageLength: 25,
                    fixedHeader: false,
                    scrollX: true,
                    select: false,
                    ajax: {
                        url: '{{ route('seilistviewajax') }}',
                        type: 'GET',

                    },
                    columns: [{
                            data: 'lname',
                        },
                        {
                            data: 'fname',
                        },
                        {
                            data: 'mname',
                        },
                        {
                            data: 'spasno',
                        },
                        {
                            data: 'email',

                        },
                        {
                            data: 'app_id',
                        },
                        {
                            data: 'strand',
                        },
                        {
                            data: 'progname',
                        },
                        {
                            data: 'gendername',
                            render: function(data, type, row) {
                                // Apply custom styles to the email address
                                var styledgender = '<span style="padding-right: 10px;">' + data +
                                    '</span>';
                                return styledgender;
                            },
                        },
                        {
                            data: 'bday',
                        },
                        {
                            data: 'mobile',
                        },
                        {
                            data: 'houseno',
                        },
                        {
                            data: 'street',
                        },
                        {
                            data: 'village',
                        },
                        {
                            data: 'barangay',
                        },
                        {
                            data: 'municipality',
                        },
                        {
                            data: 'province',
                        },
                        {
                            data: 'zipcode',
                        },
                        {
                            data: 'district',
                        },
                        {
                            data: 'region',
                        },
                        {
                            data: 'hsname',
                        },
                        {
                            data: 'remarks',
                        },
                        {
                            data: 'scholar_status_id',

                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            className: 'action-column',
                            render: function(data, type, row) {
                                var number = row.id;
                                return '' + '<a class="table-edit" data-id="' + number +
                                    '" ><i class="fas fa-edit"></i></a>' + ''
                            }
                        },



                    ],
                    scrollX: true,
                    order: [
                        [1, 'asc'] //set batch sort from lowest
                    ],
                    fixedColumns: {
                        right: 1,
                        left: 1,
                    },
                    columnDefs: [{
                            targets: 'action-column', // Use a class to target the specific column
                            className: 'text-center',
                        },
                        {

                            targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, , 9, , 10, 11, 12, 13, 14, 15, 16],
                            orderable: false,
                        }, {
                            visible: false,
                            searchable: true,
                            targets: 22,


                        }

                    ],
                    "createdRow": function(row, data, dataIndex) {
                        if (data.scholar_status_id != '0') {
                            $(row).find('td:first-child')
                                .css('color', 'green')
                                .css('font-weight', 'bold');
                            // console.log("Row with value '0' found.");
                        }
                        // alert();
                    },
                    drawCallback: function(settings) {
                        var api = this.api();

                        api.columns([6, 7, 8, 15, 16]).every(function(d) {
                            var column = this;
                            // Get the column header name
                            var theadname = $(api.column(d).header()).text();
                            // Check if the select element already exists for this column
                            var select = column.header().querySelector('select');

                            // If the select element doesn't exist or is empty, create it
                            if (!select || select.options.length === 0) {
                                select = document.createElement('select');
                                // Add styles to the select element
                                select.style.padding = '1px'; // Example padding
                                // Add the default option
                                select.add(new Option(' ' + theadname, ''));
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
                            }
                        });
                    },
                });





                $(document).on('click', '.table-edit', function() {
                    var number = $(this).data('id');
                    // alert(number);
                    // Show the modal


                    let modal = new bootstrap.Modal('#editModal');
                    modal.show()

                    $.ajax({
                        url: '{{ url('/get-seilistrecord/') }}' + '/' + number,
                        method: 'GET',
                        success: function(data) {
                            $('#editModal #IdField').val(data.id);
                            $('#editModal #AppIDField').val(data.app_id);
                            $('#editModal #EmailField').val(data.email);
                            $('#editModal #RemarksField').val(data.remarks);
                            $('#editModal #ProgramField').val(data.program_id);
                            $('#editModal #StrandField').val(data.strand);
                            $('#editModal #ContactField').val(data.mobile);
                            $('#editModal #SurnameField').val(data.lname);
                            $('#editModal #FirstnameField').val(data.fname);
                            $('#editModal #MiddlenameField').val(data.mname);
                            $('#editModal #DistrictField').val(data.district);
                        },
                        error: function(error) {
                            console.error('Error fetching data for editing:', error);
                        }
                    });


                    $('#editModal').on('hidden.bs.modal', function() {
                        $(this).trigger('reset'); ///works
                    })

                    $('#saveChangesBtn').off('click').click(function() {

                        var selectElementProgram = document.querySelector('#ProgramField');
                        var selectElementGender = document.querySelector('#GenderField');
                        var selectedValueProgram = parseInt(selectElementProgram.value, 10);
                        var selectedValueGender = parseInt(selectElementGender.value, 10);
                        // Gather the updated data from the modal fields
                        var updatedData = {
                            app_id: $('#editModal #AppIDField').val(),
                            email: $('#editModal #EmailField').val(),
                            program_id: $('#editModal #ProgramField').val(),
                            remarks: $('#editModal #RemarksField').val(),
                            strand: $('#editModal #StrandField').val(),
                            mobile: $('#editModal #ContactField').val(),
                            lname: $('#editModal #SurnameField').val(),
                            fname: $('#editModal #FirstnameField').val(),
                            mname: $('#editModal #MiddlenameField').val(),
                            gender_id: $('#editModal #GenderField').val(),

                        };

                        // Send the updated data to the server using AJAX
                        $.ajax({
                            url: '{{ url('/savechangesseilist/') }}' + '/' +
                                number, // Replace with your server endpoint
                            method: 'POST', // You can use POST or PUT based on your server-side implementation
                            data: updatedData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Handle success, e.g., close the modal or show a success message
                                Swal.fire({
                                    icon: "success",
                                    title: "",
                                    text: 'Record has been edited',
                                });
                                // Update specific cells in DataTable with new data
                                var dataTable = $('#thisdatatable').DataTable();
                                // Redraw the DataTable
                                table.ajax.reload(null, false);
                                $('#editModal input').val('');
                                $('#editModal').modal(
                                    'hide'
                                ); // Assuming you want to hide the modal on success

                            },
                            error: function(error) {
                                console.error('Error saving changes:', error);
                            }
                        });
                    });

                });

                $('#yearForm').on('submit', function(e) { //DONT DELETE
                    e.preventDefault();
                    var startYear = $(this).find('select[name="startYear"]').val();
                    table.ajax.url("seilistviewajax?startYear=" + startYear).load();
                });



            });
        </script>

    </body>

</html>
