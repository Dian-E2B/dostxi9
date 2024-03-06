<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/all.css') }}">
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

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">
            @include('layouts.sidebar')
            <div class="main">
                @include('layouts.header')
                {{-- @dd($seisourcerecord) --}}
                {{-- @dd($scholarrequirements) --}}
                @php
                    $scholarStatusId = \App\Models\Sei::where('id', $seisourcerecord->id)->value('scholar_status_id');
                @endphp

                <main class="main">
                    <div class="container-fluid p-2">
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
                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <h3 class="bold" style="color: black; font-weight: 900">Requirements Uploaded</h3>
                                        <table class="nowrap compact table table-bordered table-sm" width="100%">
                                            <tr>
                                                <td>Scholarship Agreement</td>
                                                @if (empty($scholarrequirements))
                                                    <td class="tdviewreq">No File Uploaded</td>
                                                @else
                                                    <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqsholarship"><i style="font-size: 15px;" class="fas fa-eye"></i></a></td>
                                                @endif
                                            </tr>
                                            <tr>

                                                <td>Information Sheet</td>
                                                @if (empty($scholarrequirements))
                                                    <td class="tdviewreq">No File Uploaded</td>
                                                @else
                                                    <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqinformation"><i class="fas fa-eye"></a></i></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Scholar's Oath</td>
                                                @if (empty($scholarrequirements))
                                                    <td class="tdviewreq">No File Uploaded</td>
                                                @else
                                                    <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqoath"><i class="fas fa-eye"></a></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>Prospectus</td>
                                                @if (empty($scholarrequirements))
                                                    <td class="tdviewreq">No File Uploaded</td>
                                                @else
                                                    <td class="tdviewreq"><a style="display:block" href="#" data-id="{{ $seisourcerecord->id }}" class="viewreqprospectus"><i class="fas fa-eye"></td>
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
                                                    <button type="submit" class="btn btn-success" onclick="submitFormverify('verify');">Verify</button><span style="padding: 5px;"></span>
                                                </div>
                                                <div class="col-4">
                                                    <button type="submit" class="btn btn-primary" onclick="submitFormverify('endorse');">Endorse to other region</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="viewRequirementsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-fullscreen-xxl-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div id="thisdiv"></div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <embed id="ifrm" src="#" type="application/pdf" width="100%" height="600px">
                                    {{--  <iframe id="ifrm" frameborder="0" scrolling="no" height="100%" width="100%" type="application/pdf" title="blankdashboard"></iframe> --}}
                                </div>
                                {{--  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
            </div>
            </main>
        </div>
        </div>
    </body>
    <script src="{{ asset('js/all.js') }}"></script>

    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script>
        function submitFormverify(action) {
            document.getElementById('scholarprocess').value = action;
            document.getElementById('formverify').submit();
        }
        document.addEventListener('DOMContentLoaded', function() {



            $('#viewRequirementsModal').on('hidden.bs.modal', function() {
                /*  console.log('Modal is hidden'); */
                $('#viewRequirementsModal #thisdiv').empty();
                $('#viewRequirementsModal #ifrm').attr('src', '');

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
                        console.log(data.scholarshipagreement);
                        var filePath = '/' + data.scholarshipagreement;
                        $('#viewRequirementsModal #thisdiv').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Scholarship Agreement</strong></h3');
                        $('#viewRequirementsModal #ifrm').attr('src', '{{ url('/') }}' + filePath);
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
                        $('#viewRequirementsModal #thisdiv').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Information Sheet</strong></h1>');
                        $('#viewRequirementsModal #ifrm').attr('src', '{{ url('/') }}' + filePath1);
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
                        $('#viewRequirementsModal #thisdiv').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Scholar Oath</strong></h3>');
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
                        $('#viewRequirementsModal #thisdiv').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>');
                        $('#viewRequirementsModal #ifrm').attr('src', '{{ url('/') }}' + filePath3);
                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });
            });
        });
    </script>

</html>
