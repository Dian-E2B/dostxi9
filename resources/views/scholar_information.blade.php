<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            .tdviewreq {
                text-align: center;

            }

            .hidden {
                display: none;
            }

            .thisisbutton {
                padding: 2px 8px !important;
                margin: 0;
            }
        </style>
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
        <main id="main" style="padding: 1.5rem 1rem 1rem; !important;">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('approved'))
                <script>
                    let successmessage = "{{ session('approved') }}";
                    Swal.fire({
                        iconHtml: '<img src="/extraicons/approval.gif" style="width: 150px; height: 150px;">',
                        title: successmessage,
                        text: "",
                    });
                </script>
            @elseif (session('success'))
                <script>
                    let successmessage = "{{ session('disapproved') }}";
                    Swal.fire({
                        iconHtml: '<img src="/extraicons/warning.gif" style="width: 150px; height: 150px;">',
                        title: successmessage,
                        text: "",
                    });
                </script>
            @elseif (session('disapproved'))
                <script>
                    let successmessage = "{{ session('disapproved') }}";
                    Swal.fire({
                        iconHtml: '<img src="/extraicons/warning.gif" style="width: 150px; height: 150px;">',
                        title: successmessage,
                        text: "",
                    });
                </script>
            @endif

            {{-- @dd($seisourcerecord) --}}
            {{-- @dd($scholarrequirements) --}}
            @php
                $scholarStatusId = \App\Models\Sei::where('id', $seisourcerecord->id)->value('scholar_status_id');
            @endphp

            <div class="card">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="">
                            <div class="text-center">
                                <h2 class="mt-5 mb-0">{{ $seisourcerecord->lname }}, {{ $seisourcerecord->fname }}</h2>

                                @switch($scholarStatusId)
                                    @case(1)
                                        <div class="mb-2 badge bg-secondary  my-2">Pending</div>
                                    @break

                                    @case(2)
                                        <div class="mb-2 badge bg-primary  my-2">Ongoing</div>
                                    @break

                                    @case(3)
                                        <div class="mb-2 badge bg-success  my-2">Enrolled</div>
                                    @break

                                    @case(4)
                                        <div class="mb-2 badge bg-warning  my-2">Deffered</div>
                                    @break

                                    @case(5)
                                        <div class="mb-2 badge bg-warning  my-2">LOA</div>
                                    @break

                                    @case(6)
                                        <div class="mb-2 badge bg-danger  my-2">Terminated</div>
                                    @break

                                    @default
                                        None
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body mt-2">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="col">
                                <table class="table table-bordered table-sm align-text-center" style="width: 100; table-layout:fixed;">
                                    <thead class="">
                                        <tr>
                                            <th colspan="4" class="" style="text-align: center !important; background-color:rgb(144, 211, 228)">Requirements Uploaded</th>
                                        </tr>
                                        <tr>
                                            <th class="" style="">Scholarship Agreement</th>
                                            <th class="">Information Sheet</th>
                                            <th class="">Scholar's Oath</th>
                                            <th class="">Prospectus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @if (empty($scholarrequirements))
                                                <td class="tdviewreq">No File Uploaded</td>
                                            @else
                                                <td class="tdviewreq " style="text-align: center;"><a class=" d-block btn btn-sm btn-light viewreqsholarship thisisbutton" href="#" data-id="{{ $seisourcerecord->id }}" class=""><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                            @endif
                                            @if (empty($scholarrequirements))
                                                <td class="tdviewreq">No File Uploaded</td>
                                            @else
                                                <td class="tdviewreq"><a data-id="{{ $seisourcerecord->id }}" class="d-block viewreqinformation btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                            @endif
                                            @if (empty($scholarrequirements))
                                                <td class="tdviewreq">No File Uploaded</td>
                                            @else
                                                <td class="tdviewreq"><a data-id="{{ $seisourcerecord->id }}" class="d-block viewreqoath btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                            @endif
                                            @if (empty($scholarrequirements))
                                                <td class="tdviewreq">No File Uploaded</td>
                                            @else
                                                <td class="tdviewreq"><a data-id="{{ $seisourcerecord->id }}" class="d-block viewreqprospectus btn btn-sm btn-light thisisbutton"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                            @endif
                                        </tr>
                                    </tbody>
                                    <tr class="">
                                        <td colspan="4">
                                            <form id="formverify" method="POST" action="{{ route('scholarverifyendorse') }}">
                                                @csrf

                                                <input type="hidden" name="namescholar_id" value="{{ $seisourcerecord->id }}">
                                                <input type="hidden" name="namedata_id" value="{{ $scholarrequirements->id }}">
                                                <input type="hidden" name="nameprocess" id="scholarprocess" value="">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            @php
                                                                $replyslipverified = \App\Models\Replyslips::where('scholar_id', $seisourcerecord->id)->first();
                                                            @endphp
                                                            @if ($replyslipverified)
                                                                @if ($replyslipverified->replyslip_status_id == 5)
                                                                    <button disabled class="btn btn-success btn-sm">Verified</button><span class="px-2"></span>
                                                                @else
                                                                    <button type="submit" class="btn btn-success btn-sm" onclick="submitFormverify('verify');">Verify</button><span class="px-2"></span>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-start align-items-center">
                                                            <button type="submit" class="btn btn-primary btn-sm" onclick="submitFormverify('endorse');">Endorse to other region</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </table>

                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'The scholar now have access to the system!',
                                            icon: 'success',
                                            confirmButtonText: 'Okay'
                                        })
                                    </script>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                @if (count($cogpassed) > 0)
                    <div class="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr class="">
                                                    <th colspan="7" style="text-align: center !important; background-color:rgb(144, 211, 228)">COG/COR Section</th>
                                                </tr>
                                                <tr class="">
                                                    <th class="" style="">Date Uploaded</th>
                                                    <th class="">Year</th>
                                                    <th class="">Semester</th>
                                                    <th style="text-align: center;" class="">COG Details</th>
                                                    <th style="text-align: center;" class="">COR Details</th>
                                                    <th class="">Remarks</th>
                                                    <th style="text-align: center; width: 15rem;" class="">Actions</th>
                                                    {{--      <th style="text-align: center; width: 15rem;" class="">Append</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cogpassed as $cogpassed1)
                                                    <tr class="">
                                                        <td class="">{{ \Carbon\Carbon::parse($cogpassed1->date_uploaded)->format('F j, Y') }}</td>
                                                        <td class="">{{ $cogpassed1->startyear }}</td>
                                                        <td class="">{{ $cogpassed1->semester }}</td>
                                                        <td class="" style="text-align: center;"><a data-cogid="{{ $cogpassed1->id }}" class="d-block viewcog thisisbutton btn btn-light"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                                        <td class="" style="text-align: center;"><a data-corid="{{ $cogpassed1->id }}" class="d-block viewcor thisisbutton btn btn-light"><i class="fas fa-eye"></i>&nbsp;View</a></td>
                                                        <td class="">{{ $cogpassed1->cogcor_remarks }}</td>
                                                        <td class=" " style="text-align: center;">
                                                            <div class="row g-2" style="">
                                                                @if ($cogpassed1->cogcor_status == 'approved')
                                                                    <div class="col">
                                                                        Approved
                                                                    </div>
                                                                @elseif ($cogpassed1->cogcor_status == 'disapproved')
                                                                    <div class="col">
                                                                        Disapproved
                                                                    </div>
                                                                @else
                                                                    <div class="col">
                                                                        <form action="{{ route('approvecogcor', ['id' => $cogpassed1->id]) }}" class="">
                                                                            @csrf
                                                                            <button class="btn btn-sm btn-success thisisbutton"><i class="fas fa-check-square"></i>&nbsp;Approve</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col">
                                                                        <form id="disapprovecogForm" action="{{ route('approvecogcor', ['id' => $cogpassed1->id]) }}" class="">
                                                                            @csrf
                                                                            <input type="text" hidden style="display:none" name="disapprovecor" value="0">
                                                                            <button type="button" class="btn btn-sm btn-danger thisisbutton " id="disapprovecogButton"><i class="fas fa-times-circle"></i>&nbsp;Disapprove</button>
                                                                        </form>
                                                                        <script>
                                                                            document.querySelector('#disapprovecogButton').addEventListener('click', function() {
                                                                                // Show SweetAlert
                                                                                Swal.fire({
                                                                                    title: 'Disapprove this thesis COR/COG?',
                                                                                    html: `
                                                                                    <textarea id="remarks" class="form-control" placeholder="Remarks"></textarea>
                                                                                            `,
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonColor: '#3085d6',
                                                                                    cancelButtonColor: '#d33',
                                                                                    confirmButtonText: 'Yes, disapprove',

                                                                                }).then((result) => {

                                                                                    if (result.isConfirmed) {
                                                                                        var remarks = document.getElementById('remarks').value;
                                                                                        document.getElementById('disapprovecogForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="cogremarks" value="${remarks}">`);
                                                                                        document.getElementById('disapprovecogForm').submit();
                                                                                    }
                                                                                });
                                                                            });
                                                                        </script>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        {{--   <td class="">{{ $cogpassed1->cogcor_remarks }}</td> --}}
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (count($thesispassed) > 0)
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered  table-sm align-text-center">
                                        <thead>
                                            <tr class="">
                                                <th colspan="5" style="text-align: center; background-color:rgb(144, 211, 228)">Theses uploaded</th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr class="">
                                                <th class="">Date Uploaded</th>
                                                <th class="">Remarks</th>
                                                <th class="">Status</th>
                                                <th style="text-align: center;" class="">Details</th>
                                                <th style="text-align: center; width: 15rem" class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($thesispassed as $thesispassed1)
                                                <tr class="">
                                                    <td class="">{{ \Carbon\Carbon::parse($thesispassed1->updated_at)->format('F j, Y') }}</td>
                                                    <td class="">{{ $thesispassed1->thesis_remarks }}</td>
                                                    <td class="">{{ $thesispassed1->thesis_status }}</td>
                                                    <td class="" style="text-align: center;"><a data-thesisid="{{ $thesispassed1->id }}" class="viewthesis"><i class="fas fa-eye"></i></a></td>
                                                    <td class="" style="text-align: center;">

                                                        @if ($thesispassed1->thesis_status == 'Approved')
                                                            <div class="col">
                                                                Approved
                                                            </div>
                                                        @elseif ($thesispassed1->thesis_status == 'Disapproved')
                                                            <div class="col">
                                                                Disapproved
                                                            </div>
                                                        @else
                                                            <form action="{{ route('approvethesis') }}" id="thesisApprovalForm" method="POST">
                                                                <div class="row g-2">
                                                                    <div class="col">
                                                                        @csrf
                                                                        <input type="text" name="thesis_id" hidden value="{{ $thesispassed1->id }}">
                                                                        <button class="btn btn-sm btn-success thisisbutton" name="action" value="approve" type="submit"><i class="fas fa-check-square"></i>&nbsp;Approve</button>
                                                                    </div>
                                                                    <div class="col">
                                                                        <button id="disapproveThesisButton" class="btn btn-sm btn-danger thisisbutton" value="disapprove" type="button"><i class="fas fa-times-circle"></i>&nbsp;Disapprove</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <script>
                                                                document.querySelector('#disapproveThesisButton').addEventListener('click', function() {
                                                                    // Show SweetAlert
                                                                    Swal.fire({
                                                                        title: 'Disapprove this thesis proposal?',
                                                                        html: `
                                                                    <textarea id="remarksthesis" class="form-control" placeholder="Remarks"></textarea>
                                                                            `,
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Yes, disapprove',

                                                                    }).then((result) => {

                                                                        if (result.isConfirmed) {
                                                                            // Get remarks from the textarea
                                                                            var remarksthesis = document.getElementById('remarksthesis').value;
                                                                            document.getElementById('thesisApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="thesisremarks" value="${remarksthesis}">`);
                                                                            document.getElementById('thesisApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="action" value="disapprove">`);
                                                                            document.getElementById('thesisApprovalForm').submit();
                                                                        }
                                                                    });
                                                                });
                                                            </script>
                                                        @endif



                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($thesispassed[0]->finalmanuscript_details)
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-bordered  table-sm align-text-center">
                                        <thead class="">
                                            <tr class="">
                                                <th colspan="4" style="text-align: center; background-color:rgb(144, 211, 228)">Final Manuscript</th>
                                            </tr>
                                            <tr class="">
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Details</th>
                                                <th class="text-center" style="width: 15rem">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="">
                                            <td class="">{{ $thesispassed[0]->finalmanus_remarks }}</td>
                                            <td class=""><a class="d-flex p-1 justify-content-center" target="_blank" href="{{ asset($thesispassed[0]->finalmanuscript_details) }}"><i class="fas fa-eye"></i></a></td>
                                            <td class="text-center">
                                                @if ($thesispassed[0]->finalmanus_status == 'Approved' || $thesispassed[0]->finalmanus_status == 'Disapproved')
                                                    {{ $thesispassed[0]->finalmanus_status }}
                                                @else
                                                    <form id="FinalManuscriptApprovalForm" action="{{ route('finalmanuscriptaction') }}" method="POST">
                                                        @csrf
                                                        <input type="text" name="thesis_id" hidden value="{{ $thesispassed[0]->id }}">
                                                        <input type="submit" name="action" class="btn btn-success btn-sm thisisbutton" value="Approve" />
                                                        <button id="disapproveFinalManusButton" type="button" name="action" class="btn btn-danger btn-sm thisisbutton">Disapprove</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <script>
                                                document.querySelector('#disapproveFinalManusButton').addEventListener('click', function() {
                                                    Swal.fire({
                                                        title: 'Disapprove this Final Manuscript?',
                                                        html: `
                                                <textarea id="remarksFinal" class="form-control" placeholder="Remarks"></textarea>`,
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Yes, disapprove',

                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            var remarksfinalmanus = document.getElementById('remarksFinal').value; // Get remarks from the textarea
                                                            document.getElementById('FinalManuscriptApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="finalremarks" value="${remarksfinalmanus}">`);
                                                            document.getElementById('FinalManuscriptApprovalForm').insertAdjacentHTML('beforeend', `<input type="hidden" name="action" value="Disapprove">`);
                                                            document.getElementById('FinalManuscriptApprovalForm').submit();
                                                        }
                                                    });
                                                });
                                            </script>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif


            </div>

            <!-- Modal REQUIREMENTS -->
            <div class="modal fade common-modal" id="viewRequirementsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="thisdivtitlereq"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed class="modal-iframe" id="ifrmreq" src="#" type="application/pdf" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  COG-->
            <div class="modal fade common-modal" id="viewCogsModal" tabindex="-1" aria-labelledby="exampleModalCog" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="thisdivtitlecog">COG Details</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed class="modal-iframe" id="ifrmcog" src="#" type="application/pdf" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal  COR-->
            <div class="modal fade common-modal" id="viewCorModal" tabindex="-1" aria-labelledby="exampleModalCor" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="thisdivtitlecor">COR Details</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed class="modal-iframe" id="ifrmcor" src="#" type="application/pdf" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal  THESIS-->
            <div class="modal fade common-modal" id="viewThesisModal" tabindex="-1" aria-labelledby="exampleModalThesis" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div id="thisdivtitlecor">Thesis Details</div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <embed class="modal-iframe" id="ifrmthesis" src="#" type="application/pdf" width="100%" height="100%">
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
        function submitFormverify(action) {
            document.getElementById('scholarprocess').value = action;
            document.getElementById('formverify').submit();
        }

        document.querySelectorAll('.thisisbutton').forEach(function(element) {
            element.addEventListener('click', function() {
                // Store the current scroll position in sessionStorage
                sessionStorage.setItem('scrollPosition', window.scrollY);
            });
        });


        // After page reload, check if there's a stored scroll position and scroll to it
        window.addEventListener('load', function() {
            var scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                // Scroll the page to the stored position
                window.scrollTo(0, parseInt(scrollPosition));
                // Clear the stored scroll position after using it
                sessionStorage.removeItem('scrollPosition');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {



            $('.common-modal').on('hidden.bs.modal', function() {
                var modal = $(this);
                $('#viewRequirementsModal #thisdivtitlereq').empty();
                $(this).find('embed').attr('src', '');

            });

            //FOR SCHOLARSHIP ICON
            $(document).on('click', '.viewreqsholarship', function() {
                var number = $(this).data('id');

                let modal = new bootstrap.Modal('#viewRequirementsModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/requirements_view/') }}' + '/' + number,
                    method: 'GET',
                    success: function(data) {
                        var filePath = '/' + data.scholarshipagreement;
                        $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Scholarship Agreement</strong></h3');
                        $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath);
                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });
            });

            //FOR INFORMARTIONSHEET
            $(document).on('click', '.viewreqinformation', function() {
                var number = $(this).data('id');
                let modal = new bootstrap.Modal('#viewRequirementsModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/requirements_view/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        /*    console.log(data); */
                        var filePath1 = '/' + data.informationsheet;
                        $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Information Sheet</strong></h1>');
                        $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath1);
                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });
            });


            //FOR Scholar's Oath
            $(document).on('click', '.viewreqoath', function() {
                var number = $(this).data('id');
                let modal = new bootstrap.Modal('#viewRequirementsModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/requirements_view/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        /*    console.log(data); */
                        var filePath2 = '/' + data.scholaroath;
                        $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Scholar Oath</strong></h3>');
                        $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath2);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });

            $(document).on('click', '.viewreqprospectus', function() {
                var number = $(this).data('id');
                let modal = new bootstrap.Modal('#viewRequirementsModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/requirements_view/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        /*    console.log(data); */
                        var filePath3 = '/' + data.scholaroath;
                        $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>');
                        $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath3);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });


            $(document).on('click', '.viewcog', function() {
                var number = $(this).data('cogid');
                let modal = new bootstrap.Modal('#viewCogsModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/scholarcog/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        var filePathcog = '/' + data.cog_name;
                        /*    $('#viewCogsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>'); */
                        $('#viewCogsModal #ifrmcog').attr('src', '{{ url('/') }}' + filePathcog);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }); //END COG MODAL


            $(document).on('click', '.viewcor', function() {
                var number = $(this).data('corid');
                let modal = new bootstrap.Modal('#viewCorModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/scholarcog/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        var filePathcog = '/' + data.cor_name;
                        /*    $('#viewCogsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>'); */
                        $('#viewCorModal #ifrmcor').attr('src', '{{ url('/') }}' + filePathcog);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }); //END COR MODAL

            $(document).on('click', '.viewthesis', function() {
                var number = $(this).data('thesisid');
                let modal = new bootstrap.Modal('#viewThesisModal');
                modal.show()
                $.ajax({
                    url: '{{ url('/scholarthesis/') }}' + '/' + number,
                    method: 'GET',

                    success: function(data) {
                        var filePaththesis = '/' + data.thesis_details;

                        /*    $('#viewCogsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>'); */
                        $('#viewThesisModal #ifrmthesis').attr('src', '{{ url('/') }}' + filePaththesis);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }); //END THESIS MODAL

            /*   $(document).on('click', '#cogcorapprove', function() {
                  var number = $(this).data('cogid');
                  var url = '{{ url('/approvecogcor/') }}' + '/' + number;
                  window.location.href = url;
              }); */

        });
    </script>

</html>
