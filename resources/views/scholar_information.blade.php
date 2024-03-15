<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <style>
            body,
            html {
                background-color: #dddddd;
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .tdviewreq {
                text-align: center;
                font-size: 15px
            }
        </style>
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">


            {{-- @dd($seisourcerecord) --}}
            {{-- @dd($scholarrequirements) --}}
            @php
                $scholarStatusId = \App\Models\Sei::where('id', $seisourcerecord->id)->value('scholar_status_id');
            @endphp

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: rgb(58, 58, 58)">Student Profile</h5>
                            </div>
                            <div class="card-body text-center">
                                <h2 class=" mb-0">{{ $seisourcerecord->lname }}, {{ $seisourcerecord->fname }}</h2>

                                @switch($scholarStatusId)
                                    @case(1)
                                        <div class="mb-2 badge bg-secondary  my-2"> Pending</div>
                                    @break

                                    @case(2)
                                        <div class="mb-2 badge bg-primary  my-2"> Ongoing</div>
                                    @break

                                    @case(3)
                                        <div class="mb-2 badge bg-success  my-2">Enrolled</div>
                                    @break

                                    @case(4)
                                        <div class="mb-2 badge bg-warning  my-2"> Deffered</div>
                                    @break

                                    @case(5)
                                        <div class="mb-2 badge bg-warning  my-2"> LOA</div>
                                    @break

                                    @case(6)
                                        <div class="mb-2 badge bg-danger  my-2"> Terminated</div>
                                    @break

                                    @default
                                        None
                                @endswitch

                            </div>
                            <hr class="my-1" />
                            <div class="card-body">
                                <h3 class="bold mt-2" style="color: black; font-weight: 900">Requirements Uploaded</h3>
                                <table class="nowrap compact table table-bordered table-sm" width="100%">
                                    <tr>
                                        <td>Scholarship Agreement</td>
                                        @if (empty($scholarrequirements))
                                            <td class="tdviewreq">No File Uploaded</td>
                                        @else
                                            <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqsholarship"><box-icon type='solid' name='show'></box-icon></a></td>
                                        @endif
                                    </tr>
                                    <tr>

                                        <td>Information Sheet</td>
                                        @if (empty($scholarrequirements))
                                            <td class="tdviewreq">No File Uploaded</td>
                                        @else
                                            <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqinformation"><box-icon type='solid' name='show'></box-icon></a></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Scholar's Oath</td>
                                        @if (empty($scholarrequirements))
                                            <td class="tdviewreq">No File Uploaded</td>
                                        @else
                                            <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqoath"><box-icon type='solid' name='show'></box-icon></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Prospectus</td>
                                        @if (empty($scholarrequirements))
                                            <td class="tdviewreq">No File Uploaded</td>
                                        @else
                                            <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqprospectus"><box-icon type='solid' name='show'></box-icon></td>
                                        @endif
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
                                <form id="formverify" method="POST" action="{{ route('scholarverifyendorse') }}">
                                    @csrf
                                    <input type="hidden" name="namescholar_id" value="{{ $seisourcerecord->id }}">
                                    <input type="hidden" name="nameprocess" id="scholarprocess" value="">
                                    <div class="row">
                                        <div class="col-1">
                                            @php
                                                $replyslipverified = \App\Models\Replyslips::where('scholar_id', $seisourcerecord->id)->first();
                                            @endphp
                                            @if ($replyslipverified)
                                                @if ($replyslipverified->replyslip_status_id == 5)
                                                    <button disabled class="btn btn-success">Verified</button><span style="padding: 5px;"></span>
                                                @else
                                                    <button type="submit" class="btn btn-success" onclick="submitFormverify('verify');">Verify</button><span style="padding: 5px;"></span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-primary" onclick="submitFormverify('endorse');">Endorse to other region</button>
                                        </div>
                                    </div>
                                </form>




                            </div>
                            <hr class="my-3" />

                            <div class="card-body">
                                <div class="row">
                                    {{--  COR SECTION --}}
                                    <div class="col-6">
                                        <div class="text mb-2">
                                            COG uploaded section
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="">
                                                    <th class="">Date Uploaded</th>
                                                    <th class="">Semester</th>
                                                    <th class="">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cogpassed as $cogpassed1)
                                                    <tr class="">
                                                        <td class="">{{ \Carbon\Carbon::parse($cogpassed1->date_uploaded)->format('F j, Y') }}</td>
                                                        <td class="">{{ $cogpassed1->semester }}</td>
                                                        <td class=""><a href="#" data-cogid="{{ $cogpassed1->id }}" class="viewcog"><box-icon type='solid' name='show'></box-icon></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                    {{--  COR SECTION --}}
                                    <div class="col-6">
                                        <div class="text mb-2">
                                            COR uploaded section
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr class="">
                                                    <th class="">Date Uploaded</th>
                                                    <th class="">Semester</th>
                                                    <th class="">Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($corpassed as $corpassed1)
                                                    <tr class="">
                                                        <td class="">{{ \Carbon\Carbon::parse($corpassed1->date_uploaded)->format('F j, Y') }}</td>
                                                        <td class="">{{ $corpassed1->semester }}</td>
                                                        <td class=""><a href="#" data-corid="{{ $corpassed1->id }}" class="viewcor"><box-icon type='solid' name='show'></box-icon></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text">
                                            Thesis section
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <embed id="ifrmreq" src="#" type="application/pdf" width="100%" height="100%">
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
                            <embed id="ifrmcog" src="#" type="application/pdf" width="100%" height="100%">
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
                            <embed id="ifrmcor" src="#" type="application/pdf" width="100%" height="100%">
                        </div>
                    </div>
                </div>
            </div>


        </main>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script>
        function submitFormverify(action) {
            document.getElementById('scholarprocess').value = action;
            document.getElementById('formverify').submit();
        }
        document.addEventListener('DOMContentLoaded', function() {


            $('.common-modal').on('hidden.bs.modal', function() {
                var modal = $(this);
                $('#viewRequirementsModal #thisdivtitlereq').empty();
                modal.find('#' + modal.data('src')).attr('src', '');
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
                        $('#viewRequirementsModal #ifrm').attr('src', '{{ url('/') }}' + filePath2);
                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
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
                        console.error('Error fetching data for editing:', error);
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
                        console.error('Error fetching data for editing:', error);
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
                        console.error('Error fetching data for editing:', error);
                    }
                });
            }); //END COR MODAL
        });
    </script>

</html>
