<!DOCTYPE html>
<html lang="en">

    <head>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            .col-lg-4 {
                width: 33.33%;
                /* Adjust as needed */
                float: left;
                padding: 0;

            }

            main {
                page-break-after: always;
            }


            body {}

            @page {}

            header {
                top: 0px;
                position: fixed;
                background-color: black;
                height: 0px;
            }

            .footer {
                bottom: -50px;
                position: fixed;
            }

            .column-name {
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }

            @page {
                size: landscape !important;
                size: A4;

                /* Adjust the margin-top value for the first page */
            }


            @media print {
                @page {
                    margin-top: 0.2in;
                    margin-left: 1in;
                    margin-right: 1in;
                    padding: 1000px 1000px !important;
                    size: landscape !important;
                    size: A4;
                }

                body {
                    opacity: 100 !important;
                    background-color: white !important;
                }

            }

            body {
                opacity: 0;
                overflow: auto;

            }

            thead {
                display: table-header-group;
            }

            td {
                padding: 0px 10px;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }

            /** Define the footer rules **/
        </style>

    <body>



        <main class="main-content">
            <div class="row">
                <div class="">
                    <table class="">
                        <thead class="">
                            <tr>
                                <th colspan="3" style="text-align: center !important; padding:0px !important; margin:0px !important;" class="TEXT-CENTER">
                                    <img style=" width: 97% !important; height: 2.8cm;" src="{{ asset('icons/DOST_endorsedscholar.png') }}" alt="" class="">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: center !important; padding: 0px; margin:0px;" class="TEXT-CENTER">LIST OF SCHOLARS ENDORSED TO UNIVERSITIES/COLLEGES</th>
                            </tr>
                            <tr>
                                <th colspan="3" style="text-align: center !important; padding-bottom: 15px;margin:0px;" class="TEXT-CENTER">
                                    @if ($endorsements->first()->semester == 1)
                                        1<sup>st</sup> SEMESTER {{ $endorsements->first()->year }}-{{ $endorsements->first()->year + 1 }}
                                    @elseif ($endorsements->first()->semester == 2)
                                        2<sup>nd</sup> SEMESTER {{ $endorsements->first()->year }}-{{ $endorsements->first()->year + 1 }}
                                    @else
                                        Summer {{ $endorsements->first()->year }}-{{ $endorsements->first()->year + 1 }}
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $currentSchool = '';
                                $columnCount = 0;
                            @endphp


                            @if ($columnCount != 0)
                                @for ($i = $columnCount; $i < 3; $i++)
                                    <td></td> <!-- Empty cells to fill up the last row if necessary -->
                                @endfor
                                </tr>
                            @endif
                            @foreach ($endorsements as $endorsement)
                                @if ($endorsement->school != $currentSchool)
                                    @if ($columnCount != 0)
                                        @for ($i = $columnCount; $i < 3; $i++)
                                            <td></td> <!-- Empty cells to fill up the row if necessary -->
                                        @endfor
                                    @endif

                                    <tr style="padding-bottom: 100px">
                                        <th colspan="3" style="padding-bottom:10px !important; padding-top:10px !important;">
                                            <div style="background-color: rgba(135, 207, 235, 0.859); padding: 0px;">
                                                <span style=" margin-left:8px; ">{{ $endorsement->school }}</span>
                                            </div>
                                        </th>
                                    </tr>

                                    @php
                                        $currentSchool = $endorsement->school;
                                        $columnCount = 0;
                                    @endphp
                                @endif
                                @if ($columnCount == 0)
                                    <tr>
                                @endif
                                <td>{{ strtoupper($endorsement->name) }}</td>
                                @php
                                    $columnCount++;
                                @endphp
                                @if ($columnCount == 3)
                                    </tr>
                                    @php
                                        $columnCount = 0;
                                    @endphp
                                @endif
                            @endforeach
                            @if ($columnCount != 0)
                                @for ($i = $columnCount; $i < 3; $i++)
                                    <td></td> <!-- Empty cells to fill up the last row if necessary -->
                                @endfor
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
        </main>

    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
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
