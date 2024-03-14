<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        <style>
            .modal-header {
                display: flex;
                align-items: center;
                justify-content: flex-start;
            }
        </style>
    </head>

    <body>
        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
            <div class="main">

                {{--  <p>Logged-in scholar_id: {{ auth()->user()->scholar_id }}</p> --}}
                @php
                    $replyStatusId = \App\Models\Replyslips::where('scholar_id', auth()->user()->scholar_id)->value('replyslip_status_id');
                @endphp
                {{--    @dd($replyStatusId); --}}

                @if ($replyStatusId == 1 || $replyStatusId == 2 || $replyStatusId == 6) //
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header d-flex align-items-center justify-content-start">
                                    <i style="font-size: 40px" class="fas fa-info-circle"></i>
                                    <h5 style="margin-top: 0.5rem; font-weight: 900; font-size: 1.5rem" class="" id="exampleModalLabel">
                                        @if ($replyStatusId == 1)
                                            Details Of Orientation:
                                        @elseif ($replyStatusId == 2)
                                            Please Upload your requirements and wait for confirmation to access the portal.
                                        @elseif($replyStatusId == 6)
                                            Please wait for confirmation to access the portal.
                                        @endif

                                    </h5>
                                </div>
                                @if ($replyStatusId == 1)
                                    <div class="modal-body">
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
                                    </div>
                                @elseif ($replyStatusId == 2)
                                    <script>
                                        Swal.fire({
                                            title: 'Hello Scholar!',
                                            text: 'Please submit your requirements to continue to your dashboard',
                                            icon: 'info',
                                            width: '500px', // Set the width of the dialog box
                                            height: '100px', // Set the width of the dialog box
                                            confirmButtonText: 'Okay',
                                        })
                                    </script>
                                    <form method="POST" id="submit-form" action="{{ route('savefirstrequirements') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input hidden name="scholarid" value="{{ auth()->user()->scholar_id }}">
                                        <div class="modal-body">
                                            <span style="font-size: 1.3rem">
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label"> Scholarship Agreement</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="mb-1">
                                                            <input class="form-control form-control-lg" accept="application/pdf" type="file" name="scholarshipagreement">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label class="form-label"> Information Sheet</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="mb-1">
                                                            <input class="form-control form-control-lg " accept="application/pdf" type="file" name="informationsheet">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label for="formFile" class="form-label">Scholar's Oath</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="mb-1">
                                                            <input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="scholaroath">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-1">
                                                    <div class="col-4">
                                                        <div class="mb-1">
                                                            <label for="formFile" class="form-label">Prospectus</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="mb-1">
                                                            <input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="prospectus">
                                                        </div>
                                                    </div>
                                                </div>

                                            </span>
                                        </div>
                                    </form>
                                @endif
                                <div class="modal-footer">
                                    @if ($replyStatusId == 1)
                                        <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">Answer ReplySlip <i class="align-middle me-2" data-feather="edit-3"></i></a>
                                    @elseif ($replyStatusId == 2)
                                        {{-- SUBMIT FORM --}}
                                        <a id="submitBtn" href="{{ route('savefirstrequirements') }}" class="btn btn-primary" style="display: none;" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fas fa-check-square"></i><span style="margin-left:8px;">Submit</span></a>
                                    @endif
                                    <a class="btn btn-light" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="far fa-power-off"></i><span style="margin-left:8px;">Log out</span></a>
                                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($replyStatusId == 4 || $replyStatusId == 3)
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <script>
                        // Trigger SweetAlert when conditions are met
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
                                /*  document.getElementById('logout-form').submit(); */

                            }
                        });
                    </script>
                @else
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


                                        @if ($scholarstatusid === 3)
                                            {{-- IF ENROLLED --}}
                                        @endif
                                        {{--  @dd($scholarstatusid); --}}
                                        @if (count($replyslips) > 0)
                                            {{--  <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Reply Slip</h5>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">We are thrilled to offer you the
                                                <strong>DOST-SEI S&T Undergraduate Scholarship</strong> for the academic year <strong>{{ now()->year }}</strong>.
                                                As a scholarship recipient, we kindly request your prompt response by signing and returning this
                                                reply slip to confirm your acceptance of the award.
                                            </p>
                                            @if ($replyslipstatus != 1)
                                                <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">View <i class="align-middle me-2" data-feather="eye"></i></a>
                                            @else
                                                <a href="{{ route('student.replyslipview') }}" class="btn btn-success">View <i class="align-middle me-2" data-feather="edit-3"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                </div> --}}

                                            <div class="col-md-6 col-lg-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h1 style="margin: auto; text-align: center">
                                                            <p style="font-weight:900 ">{{ $scholarfullinfo->fname }} {{ $scholarfullinfo->mname }} {{ $scholarfullinfo->lname }}</p>
                                                        </h1>
                                                        <div class="row">

                                                            <div class="col-12">
                                                                <table class="table table-bordered table-striped">
                                                                    <tr>
                                                                        <th>
                                                                            <span style="color: rgb(92, 92, 92)">Mobile:</span>
                                                                        </th>
                                                                        <td>
                                                                            <span style="font-weight:900 ">{{ $scholarfullinfo->mobile }}</span>
                                                                        </td>
                                                                    </tr>
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
                                                                            <span style="color: rgb(92, 92, 92)">Email:</span>
                                                                        </th>
                                                                        <td>
                                                                            <span style="font-weight:900 ">{{ $scholarfullinfo->email }}</span>
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
                                                                </table>
                                                                {{--  @dd($scholarfullname) --}}


                                                            </div>
                                                            <div class="col-6">

                                                                {{--  @dd($scholarfullname) --}}

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {

                keyboard: false
            });
            myModal.show(); // This will show the modal immediately
        });

        var fileInputs = document.querySelectorAll('#submit-form input[type="file"]');

        // Function to check if all file inputs have a file
        function checkAllFilesSelected() {
            for (var i = 0; i < fileInputs.length; i++) {
                if (!fileInputs[i].value) {
                    document.getElementById('submitBtn').style.display = 'none';
                    return;
                }
            }

            // If all inputs have a file, show the link
            document.getElementById('submitBtn');
        }

        // Add event listeners to all file inputs
        fileInputs.forEach(function(input) {
            input.addEventListener('change', checkAllFilesSelected);
        });

        // Initial check
        checkAllFilesSelected();
    </script>


</html>
