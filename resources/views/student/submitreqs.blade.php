<!DOCTYPE html>
<html lang="en">

    <head>
        <link href="{{ asset('css/all.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>DOST XI</title>
        <link rel="icon" href="storage\thisicons\DOSTLOGOsmall.png" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

        {{-- Datatables css --}}
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

        <style>


        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">

            {{-- SIDEBAR START --}}
            @include('student.layoutsst.sidebar')

            <div class="main">
                @include('student.layoutsst.header')

                <main class="content" style="padding:0.5rem 0.5rem 0.5rem; !important;">
                    <div class="container-fluid p-0">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="card ">
                                    <form method="POST" action="{{ route('student.submitreqsperiodicsave') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" name="scholaridname" hidden value="{{ auth()->user()->scholar_id }}">
                                        <div class="card-body">
                                            <div style="font-size: 20px; font-weight: 900; text-align: center; margin-bottom: 5px;">SUBMIT PERIODIC REQUIREMENTS</div>
                                            <div class=""><span style="font-size: 15px">Certificate Of Registration: </span><input required name="corname" class="form-control" type="file" accept="application/pdf"></div>
                                            <div class="mt-3"><span style="font-size: 15px">Certificate Of Grades </span><input required name="cogname" class="form-control" type="file" accept="application/pdf"></div>
                                        </div>
                                        <div class="card-body">
                                            <div style="font-size: 20px; font-weight: 900; text-align: left">PERIOD:</div>
                                            <div class="row">
                                                <div class="col-6"> <span>Semester:</span>
                                                    <select required name="semestername" class="form-control mb-3">
                                                        <option>1st</option>
                                                        <option>2nd</option>
                                                        <option>3rd</option>
                                                        <option>Summer</option>
                                                    </select>
                                                </div>
                                                <div class="col-6"> <span>Academic Year: (Startyear)</span>
                                                    <select required class="form-control" id="year" name="yearname">
                                                        <?php
                                                        $startYear = 2020;
                                                        $endYear = 2100;
                                                        for ($year = $startYear; $year <= $endYear; $year++) {
                                                            echo "<option value=\"$year\">$year</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="card">
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            {{-- Jquery Js --}}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="{{ asset('js/all.js') }}"></script>
            <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var $j = jQuery.noConflict();

                });
            </script>
            <script></script>
    </body>

</html>
