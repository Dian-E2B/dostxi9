<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        <style>
            .modal-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }

            button {
                border: none;
                padding: none !important;
            }
        </style>
    </head>

    <body>
        @php
            $replyStatusId = \App\Models\Replyslips::where('scholar_id', auth()->user()->scholar_id)->value('replyslip_status_id');
        @endphp

        @if (session('errors'))
            <script>
                let errorMessage = "{{ session('error') }}";
                Swal.fire({
                    icon: "error",
                    title: "ERROR!",
                    text: errorMessage,
                    showConfirmButton: true,
                    confirmButtonText: "OK"
                });
            </script>
        @elseif (session('success'))
            <script>
                let successmessage = "{{ session('success') }}";
                Swal.fire({
                    icon: "success",
                    title: "SUCCESS!",
                    text: successmessage,
                    showConfirmButton: true,
                    confirmButtonText: "OK"
                });
            </script>
        @endif
        @if ($replyStatusId == 1 || $replyStatusId == 2 || $replyStatusId == 6)

            <div class="row justify-content-center mt-3" style="margin-auto; !important">
                <div class="card col-10">
                    <div class="card-body">
                        <h5 style="margin-top: 0.5rem; font-weight: 900; font-size: 1.5rem" class="" id="exampleModalLabel">
                            @if ($replyStatusId == 1)
                                <div>
                                    Details Of Orientation:
                                </div>
                                <hr>
                                <span style="font-size: 1.5rem">
                                    @php
                                        $emailcontent = DB::table('emailcontent')->first();
                                        $dateValue = $emailcontent->thisdate;
                                        $venueValue = $emailcontent->venue;
                                        $timeValue = $emailcontent->time;
                                    @endphp
                                    Venue : {{ $venueValue }}
                                    <br>
                                    Date : {{ $dateValue }}
                                    <br>
                                    Time : {{ $timeValue }}
                                </span>
                                <hr>
                                <div class="">
                                    <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">Answer ReplySlip <i class="align-middle me-2" data-feather="edit-3"></i></a>

                                </div>
                            @elseif ($replyStatusId == 2)
                                <script>
                                    Swal.fire({
                                        title: 'Hello Scholar!',
                                        text: 'Please submit your requirements to continue to your portal',
                                        icon: 'info',
                                        width: '500px'
                                        confirmButtonText: 'Okay',
                                    })
                                </script>
                                <div class="d-flex ">
                                    <div class=" ms-auto ">
                                        <a class="btn btn-light d-flex align-items-center" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <box-icon name='log-out'></box-icon>
                                            <span style="margin-left: 8px;">Log out</span>
                                        </a>
                                    </div>
                                </div>

                                <hr>
                                <div class="row ">
                                    Please Upload your requirements and wait for confirmation to access your dashboard.
                                    <table class="mt-4">
                                        <form method="POST" id="submit-form" action="{{ route('savefirstrequirements') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input hidden name="scholarid" value="{{ auth()->user()->scholar_id }}">
                                            <tr class="">
                                                <th class="">Scholarship Agreement</th>
                                                <td class=""><input class="form-control form-control-lg" accept="application/pdf" type="file" name="scholarshipagreement" required></td>
                                            </tr>
                                            <tr class="">
                                                <th class="">Information Sheet</th>
                                                <td class=""> <input class="form-control form-control-lg " accept="application/pdf" type="file" name="informationsheet" required></td>
                                            </tr>
                                            <tr class="">
                                                <th class="">Scholar's Oath</th>
                                                <td class=""> <input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="scholaroath" required></td>
                                            </tr>
                                            <tr class="">
                                                <th class="">Prospectus</th>
                                                <td class=""> <input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="prospectus" required></td>
                                            </tr>
                                            <tr class="">
                                                <th class=""> <button id="submitBtn" type="submit" class="btn btn-primary"><span style="">Submit </span></button></th>
                                                <th class=""></th>
                                            </tr>
                                        </form>
                                    </table>

                                </div>


                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @elseif($replyStatusId == 6)
                                <div class="mt-3">
                                    Please wait for confirmation to your dashboard.
                                </div>
                                <br>
                                <div class="d-flex">
                                    <div class=" ms-auto ">
                                        <a class="btn btn-light d-flex align-items-center" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <box-icon name='log-out'></box-icon>
                                            <span style="margin-left: 8px;">Log out</span>
                                        </a>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        @elseif ($replyStatusId == 4 || $replyStatusId == 3)
            <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <script>
                Swal.fire({
                    title: 'Decision Received.',
                    text: 'Thank you for letting us know your decision about the scholarship. We respect your choice and wish you all the best for the future. Feel free to contact us if you have any questions.',
                    iconHtml: '<img src="/extraicons/double-check.gif" style="width: 150px; height: 150px;">',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = '{{ url('/studentnoaccess/') }}';
                        window.location.href = url;
                    }
                });
            </script>
        @else
            {{-- VERIFIED/ACCEPTED REQUIREMENTS --}}
            <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
                <div class="main">
                    <div class="wrapper">
                        @include('student.layoutsst.sidebar')
                        <div class="main">
                            @include('student.layoutsst.header')
                            <div class="card">
                                <div class="card-body">

                                    <div class="container-fluid p-0">
                                        <label>
                                            <input style="display: none;" value="{{ $scholarId }}">
                                        </label>
                                        @if ($scholarstatusid == 3 || $scholarstatusid == 2)
                                            <div class="col-md-6 col-lg-12">
                                                <div class="">
                                                    <div class="card-body">
                                                        <h1 style="margin: auto; text-align: center">
                                                            <p style="font-weight:900 ">{{ $scholarfullinfo->fname }} {{ $scholarfullinfo->mname }} {{ $scholarfullinfo->lname }}</p>
                                                        </h1>
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <table class="table table-bordered table-striped">

                                                                    <tr>
                                                                        <th>
                                                                            <span style="color: rgb(92, 92, 92)">Program:</span>
                                                                        </th>

                                                                        <td>
                                                                            <span style="font-weight:900 "> @switch($scholarfullinfo->program_id)
                                                                                    @case(101)
                                                                                        RA 7687
                                                                                    @break

                                                                                    @case(201)
                                                                                        MERIT
                                                                                    @break

                                                                                    @case(301)
                                                                                        RA 106
                                                                                    @break

                                                                                    @default
                                                                                @endswitch
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <th>
                                                                            <span style="color: rgb(92, 92, 92)">Address:</span>
                                                                        </th>
                                                                        <td>
                                                                            <span style="font-weight:900 "> {{ $scholarfullinfo->barangay }}, {{ $scholarfullinfo->province }}, {{ $scholarfullinfo->municipality }}, {{ $scholarfullinfo->zipcode }}</span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>
                                                                            <span style="color: rgb(92, 92, 92)">Gender:</span>
                                                                        </th>
                                                                        <td>
                                                                            <span style="color: rgb(92, 92, 92); font-weight: 900">
                                                                                @if ($scholarfullinfo->gender_id == 1)
                                                                                    Female
                                                                                @else
                                                                                    Male
                                                                                @endif
                                                                            </span>
                                                                        </td>
                                                                    </tr>

                                                                    <form action="{{ route('editschoolcourse') }}" method="POST">
                                                                        @csrf
                                                                        <tr>
                                                                            <th>
                                                                                <span style="color: rgb(92, 92, 92)">Mobile:</span>
                                                                            </th>
                                                                            <td>
                                                                                <input type="text" name="mobile" class="editable-input form-control" disabled value=" {{ $scholarfullinfo->mobile }}">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <span style="color: rgb(92, 92, 92)">Email:</span>
                                                                            </th>
                                                                            <td>
                                                                                <input type="text" name="email" class="editable-input form-control" disabled value=" {{ $scholarfullinfo->email }}">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style=>
                                                                                <span style="color: rgb(92, 92, 92)">School:</span>
                                                                            </th>
                                                                            <td>
                                                                                <span style="color: rgb(92, 92, 92); font-weight: 900">
                                                                                    <input type="text" name="school" class="editable-input form-control" disabled value=" {{ $scholarfullinfo->school }}">
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>
                                                                                <span style="color: rgb(92, 92, 92)">Course:</span>
                                                                            </th>
                                                                            <td>
                                                                                <span style="color: rgb(92, 92, 92); font-weight: 900">
                                                                                    <input type="text" name="course" class="editable-input form-control" disabled value="{{ $scholarfullinfo->course }}">
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="2">
                                                                                <button type="button" id="editscholarcourseButton" data-bs-toggle="tooltip" data-bs-title="Edit" class="btn btn-sm" style="background-color: #c0c0c0"><i class="fas fa-edit fa-lg" style="color: #2e2e2e;"></i></button>
                                                                                <button type="button" id="canceleditscholarcourseButton" data-bs-toggle="tooltip" data-bs-title="Cancel" class=" btn btn-sm d-none" style="background-color: #ec9107"><i class="fas fa-lg fa-window-close" style="color: #2e2e2e;"></i></button>
                                                                                <button type="submit" id="submitscholarcourseButton" data-bs-toggle="tooltip" data-bs-title="Submit" class="btn btn-sm d-none btn-success"><i class="fad fa-lg fa-save"></i></button>
                                                                            </th>
                                                                        </tr>
                                                                    </form>
                                                                </table>
                                                            </div>
                                                            <div class="col-6">

                                                                {{--  @dd($scholarfullname) --}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        @endif
        </main>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
    <script>
        document.getElementById('editscholarcourseButton').addEventListener('click', function() {
            // Enable editing for all editable inputs
            document.querySelectorAll('.editable-input').forEach(function(input) {
                input.removeAttribute('disabled');
            });
            document.getElementById('canceleditscholarcourseButton').classList.remove('d-none');
            document.getElementById('submitscholarcourseButton').classList.remove('d-none');
        });

        document.getElementById('canceleditscholarcourseButton').addEventListener('click', function() {
            // Disable editing for all editable inputs
            document.querySelectorAll('.editable-input').forEach(function(input) {
                input.setAttribute('disabled', 'disabled');
            });
            // Hide the submit button
            document.getElementById('canceleditscholarcourseButton').classList.add('d-none');
            document.getElementById('submitscholarcourseButton').classList.add('d-none');
        });
    </script>


</html>
