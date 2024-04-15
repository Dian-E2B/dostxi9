<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


        <style>
            .col {
                width: 33%;
                float: center;

                padding: 0;
                /* Remove padding when printing */
            }

            html,
            body {
                height: auto;
            }

            .semester {
                border-top: 1px solid black;
                border-left: 1px solid black;
                border-right: 1px solid black;
            }

            .gradetable td,
            .gradetable th {
                padding: 0;
                text-align: center;
            }

            .scholarinfotable th {
                width: 125px;
            }

            .scholarinfotable td {
                width: 500px;
            }

            .scholarinfotable th,
            .scholarinfotable td {
                text-align: left;
                /* border-right: 1px solid black; */
            }

            @media print {

                html,
                {
                height: 99%;
            }

            body {
                margin: 12.7mm !important;
                font-size: 7pt;
                padding: 0px !important;
                /* margin: 1mm !important; */

            }

            .removethis {
                display: none;
            }

            @page {

                size: A4;
                margin: 0px !important;
                /* margin: 12.7mm !important; */
                /* Adjust the margin value as needed */
                padding: 0px !important;
            }
            }

            /* body {
                border: 1px solid black;
            } */
        </style>
    </head>


    <body style="padding:50px;">

        <div class="">

            @foreach ($seiresult as $seiresult1)
                {{-- @dd($seiresult1->lname,
                    $seiresult1->fname,
                    $seiresult1->mname,
                    $seiresult1->program_id,
                    $seiresult1->course,
                    $seiresult1->school,
                    $seiresult1->year,
                    $seiresult1->spasno); --}}

                <div class="row ">
                    <img src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="width: 100% !important; max-width: 100%; max-height: 1.2in; object-fit: fill !important; padding:0px; margin: 0px;  ">


                    <div style="text-align: center !important; font-size: 14pt">REGIONAL SCHOLARS' MONITORING SHEET</div>
                    <table class="scholarinfotable display nowrap compact" style="width:100%; border: 1px solid black; text-align: left; ">
                        <tr>
                            <th>Year of Award:</th>
                            <td>{{ $seiresult1->year }}</td>
                            <th>Program:</th>
                            <td>
                                @if ($seiresult1->program_id == 101)
                                    RA 7687
                                @elseif ($seiresult1->program_id == 201)
                                    MERIT
                                @else
                                    RA 10612
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $seiresult1->lname }},{{ $seiresult1->fname }} {{ $seiresult1->mname }} </td>
                            <th>Course/School:</th>
                            <td>
                                {{ $seiresult1->course }} &nbsp;&nbsp;&nbsp;&nbsp;/ {{ $seiresult1->school }}
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
            @foreach ($resultArray as $year => $semesters)
                <div class="row">
                    <div style="text-align: center;font-weight:bold;margin-top:2px;">SCHOOL YEAR {{ $year }} - {{ $year + 1 }}</div>
                    @foreach ($semesters as $semester => $data)
                        @php
                            $sumOfRemarksColumn = 0;
                            $sumOfGrades = 0;
                            $sumOfUnit = 0;
                        @endphp
                        <div class="col">
                            <div class="semester" style="text-align: center">
                                @if ($semester == 1)
                                    1ST SEMESTER
                                @elseif ($semester == 2)
                                    2ND SEMESTER
                                @else
                                    SUMMER
                                @endif
                            </div>
                            <table id="thisdatatable" class="gradetable display nowrap compact table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Unit</th>
                                        <th>Grade</th>
                                        <th colspan="2">Removal</th>
                                        {{-- Add more header cells as needed --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $rowCount = 0;
                                    @endphp
                                    @for ($i = 0; $i <= 12; $i++)
                                        @if (!empty($data[$i]['cogdetails']) && is_array($data[$i]['cogdetails']))
                                            @foreach ($data[$i]['cogdetails'] as $cogDetail)
                                                @if ($rowCount < 12)
                                                    <tr>
                                                        <td>{{ str_replace('&nbsp;', ' ', $cogDetail['subjectname'] ?? '&nbsp;') }}</td>
                                                        <td>{{ str_replace('&nbsp;', ' ', $cogDetail['unit'] ?? '&nbsp;') }}</td>
                                                        <td>{{ !empty($cogDetail['grade']) ? number_format($cogDetail['grade'], 2) : '' }}</td>
                                                        <td>&nbsp;</td>
                                                        <td>{{ !empty($cogDetail['grade']) && !empty($cogDetail['unit']) ? number_format($cogDetail['grade'] * $cogDetail['unit'], 2) : '' }}</td>
                                                        {{-- Add more cells as needed --}}
                                                    </tr>
                                                    @php
                                                        if (!empty($cogDetail['grade']) && !empty($cogDetail['unit'])) {
                                                            $sumOfRemarksColumn += $cogDetail['grade'] * $cogDetail['unit'];
                                                            $sumOfUnit += $cogDetail['unit'];
                                                            $sumOfGrades += $cogDetail['grade'];
                                                        }
                                                        $rowCount++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @else
                                            @if ($rowCount < 12)
                                                <tr>
                                                    <td>{{ str_replace('&nbsp;', ' ', $data[$i]['cogdetails']['subjectname'] ?? '&nbsp;') }}</td>
                                                    <td>{{ str_replace('&nbsp;', ' ', $data[$i]['cogdetails']['unit'] ?? '&nbsp;') }}</td>
                                                    <td>{{ !empty($data[$i]['cogdetails']['grade']) ? number_format($data[$i]['cogdetails']['grade'], 2) : '' }}</td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        @if (!empty($data[$i]['cogdetails']['grade']) && !empty($data[$i]['cogdetails']['unit']))
                                                            {{ number_format($data[$i]['cogdetails']['grade'] * $data[$i]['cogdetails']['unit'], 2) }} {{-- FOR REMARKS? UNIT * GRADE --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $rowCount++;
                                                @endphp
                                            @endif
                                        @endif
                                    @endfor
                                    <tr>
                                        <td style="width: 80px">total</td>
                                        <td style="width: 40px">{{ $sumOfUnit }}</td>
                                        <td style="width: 40px">{{ $sumOfGrades }}</td>
                                        <td style="width: 40px">&nbsp;</td>
                                        <td style="width: 40px">{{ $sumOfRemarksColumn }}</td>
                                        {{-- Add more cells as needed --}}
                                    </tr>
                                    <tr>
                                        <td style="width: 80px">semestral average</td>
                                        <td colspan="4" style="width: 40px">
                                            {{-- {{ $sumOfUnit }} --}}
                                            @if ($sumOfUnit != 0)
                                                {{ $sumOfRemarksColumn / $sumOfUnit }}
                                            @else
                                                N/A
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width: 80px">scholar status</td>
                                        <td colspan="4" style="width: 40px">
                                            @if (isset($data[0]['scholarshipstatus']))
                                                {{ $data[0]['scholarshipstatus'] }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endforeach


                </div>
            @endforeach
            {{-- <div class="d-block offset-sm-4" style="text-align: right; font-size: 7pt">

        </div>
        <div class="row" style="text-align: left; font-size: 10pt; margin-top; -100px !important;">
            <div class="d-block col-4" style="text-align: left;">
                Prepared by:
            </div>

            <div class="d-block col-6" style="text-align: left;">
                 Prepared by:
            </div>
        </div> --}}
            <div class="">
                <div class="row">
                    <div class="col align-self-end" style="font-size: 8pt;">
                        Prepared by:
                    </div>
                    <div class="col align-self-end" style="font-size: 8pt;">
                        Noted by:
                    </div>
                    <div class="col align-self-start" style="font-size: 7pt; text-align: right;">
                        PM-TSSD-08-007-F2
                        <br>
                        Revision No.5
                        <br>
                        26 July 2019
                    </div>
                </div>
            </div>
            <br>

            <div class="text-left">
                <div class="row" style="font-size: 8pt;">
                    <div class="col-4" style="padding: 0">
                        <u>BERNADETTE T. LUGAY</u><br>
                        Project Assistant
                    </div>
                    <div class="col">
                        <u>NEMA FREYA D. CEBRITAS</u><br>
                        Scholarship Section Head
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Add this script to the 'officialrsms' page -->
    <!-- Add this script to the 'officialrsms' page -->
    <script>
        $(document).ready(function() {
            // Function to be called after printing
            function afterPrint() {
                console.log('Printing completed...');
                window.open('', '_self', '');
            }

            // Open the print dialog
            window.print();

            // Check if the print dialog is closed after a short delay
            setTimeout(function() {
                if (!document.hidden) {
                    // If the document is still visible, it means the print dialog is still open
                    console.log('Printing canceled...');
                    window.close(2000);
                } else {
                    // If the document is hidden, assume printing is completed
                    afterPrint();
                }
            }, 2000); // Adjust the delay as needed
        });
    </script>



</html>
