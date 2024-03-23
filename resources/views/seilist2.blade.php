<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


            .sidebar {}

            .action-column {
                text-align: center !important;

            }
        </style>
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}

        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
            <div class="main">

                @if (session('error'))
                    <script>
                        let errorMessage = "{{ session('error') }}";
                        Swal.fire({
                            icon: "error",
                            title: "ERROR!",
                            text: errorMessage,
                        });
                    </script>
                @elseif (session('success'))
                    <script>
                        let successmessage = "{{ session('success') }}";
                        Swal.fire({
                            icon: "success",
                            title: "",
                            text: successmessage,
                        });
                    </script>
                @endif


                @error('excel_file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div class="card-body mt-2">
                                    <div class="card  col-lg-6 p-2" style="text-align: center; vertical-align: center">
                                        <div class="" style="font-size:1.5em; font-weight: 700">Potential Qualifiers</div>
                                    </div>

                                    <table id="thisdatatable" class="hover table-striped table-hover compact nowrap" style="width:100%;">

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
                                                <th>Lacking</th>
                                                <th>Remarks</th>
                                                <th>ID</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

            {{-- MODAL --}}
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel" style="font-weight: bold">Scholar Details
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

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
                                <div class="col-2 customlabel"> <label>Firstname: </label></div>
                                <div class="col-4"><input class=" form-control  form-control-sm" id="FirstnameField" name="FirstnameField"></div>

                                <div class="col-2 customlabel"> <label>Contact: </label></div>
                                <div class="col-4">
                                    <input class=" form-control   form-control-sm" id="ContactField" name="ContactField">
                                </div>
                            </div>

                            <div class="row align-items-center mb-1">
                                <div class="col-2 customlabel"> <label>Middlename: </label></div>
                                <div class="col-4 "> <input class="  form-control  form-control-sm" id="MiddlenameField" name="MiddlenameField"></div>
                                <div class="col-2 customlabel"> <label>Gender: </label></div>
                                <div class="col-4">
                                    <select name="GenderField" id="GenderField" class="form-control form-control-sm">
                                        <option value="1">F</option>
                                        <option value="2">M</option>

                                    </select>

                                </div>
                            </div>
                            <div class="row align-items-center mb-1">
                                <div class="col-2 customlabel"> <label>Remarks: </label></div>
                                <div class="col-10">
                                    <textarea class="form-control  form-control-sm" id="RemarksField" name="RemarksField"></textarea>
                                </div>
                            </div>
                            <div class="row align-items-center mb-1">
                                <div class="col-2 customlabel"> <label>Lacking: </label></div>
                                <div class="col-10">
                                    <textarea class="form-control  form-control-sm" id="LackingField" name="LackingField"></textarea>
                                </div>
                            </div>

                            {{-- FOOTER --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="saveChangesBtn" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/fontaws.js') }}"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>

        <script>
            jQuery(document).ready(function($) {
                var table = $('#thisdatatable').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 100,
                    fixedHeader: true,
                    select: true,
                    ajax: '{{ route('seilistviewajaxpotential') }}',
                    type: 'GET',
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
                            data: 'lacking',
                        },
                        {
                            data: 'remarks',
                        },
                        {
                            data: 'id',
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
                        left: 3,
                    },
                    columnDefs: [{
                            targets: 'action-column', // Use a class to target the specific column
                            className: 'text-center',
                        },
                        {
                            targets: [6, 7, 8, 15, 16],
                            orderable: false,
                        },


                    ],


                    initComplete: function() {
                        var api = this.api();

                        api.columns([6, 7, 8, 15, 16]).every(function(d) {
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




                $(document).on('click', '.table-edit', function() {
                    var number = $(this).data('id');
                    // alert(number);
                    // Show the modal
                    $("#editModal").modal({
                        backdrop: false
                    });
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
                            $('#editModal #LackingField').val(data.lacking);
                        },
                        error: function(error) {

                            console.error('Error fetching data for editing:', error);
                        }
                    });


                    $('#editModal').on('hidden.bs.modal', function() {
                        $(this).trigger('reset');

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
                            lacking: $('#editModal #LackingField').val(),

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
                                console.log('Changes saved successfully:', response);
                                swal.fire({
                                    text: 'Record has been edited.',
                                    icon: 'success',
                                    title: '',
                                })
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



            });
        </script>

    </body>

</html>
