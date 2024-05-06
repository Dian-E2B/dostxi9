@extends('layouts.app')

@section('styles')
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
@endsection
@section('content')
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
                                    Filter
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
                                                <button id="submitButton" style="background-color: #e3f2fd" class="btn btn-sm mt-2" type="submit"><i class="bi bi-check-square-fill"></i></button>
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
                                <div class="d-flex justify-content-end">
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
    @endsection






    @section('scripts')
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            var dataTableUrl = "{{ route('seilistviewajax') }}";
            var getSeirecord = "{{ url('/get-seilistrecord/') }}";
            var saveSeirecord = "{{ url('/savechangesseilist/') }}";
        </script>
        <script type="text/javascript" src="{{ asset('js/seilist.js') }}"></script>
    @endsection
