<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css"
        rel="stylesheet">
</head>
<style>
    td {
        user-select: none;
        white-space: nowrap;
    }

    th {

        padding-left: 8px;
        padding-right: 8px;
        border-bottom-width: thin;
        border-collapse: separate;
        vertical-align: bottom !Important;

    }

    table td {
        padding-left: 8px;
        padding-right: 8px;
        border-bottom-width: thin;
        border-right-width: thin;
    }
</style>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}



        <div class="main">
            @include('layouts.header')

            <main style="padding: 0.5rem 0.5rem 0.5rem 0.5rem" class="content">
                <div class="container-fluid p-0">

                    <div class="card">
                        <div class="card-body">

                            <table id="thisdatatable" class="table-striped compact display nowrap" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Year Of Award</th>
                                        <th>Name</th>
                                        <th>
                                            <span style="display: none;">- Level/Year -
                                            </span>
                                        </th>
                                        <th>
                                            <span style="display: none;">- School -
                                            </span>
                                        </th>
                                        <th>
                                            <span style="display: none;">- Course -
                                            </span>
                                        </th>
                                        <th>
                                            <span style="display: none;"> - Sem/Tri/Qtr
                                                Started -
                                            </span>
                                        </th>
                                        <th>
                                            <span style="display: none;">- Duration -
                                            </span>
                                        </th>
                                        <th>
                                            Status As Of End Of 2nd Semester 2019 2020
                                        </th>
                                        <th>Remarks</th>
                                        <th>Gender</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rsmsmerit as $rsmsmerit1)
                                        <tr>
                                            <td> {{ $rsmsmerit1->No }}</td>
                                            <td style="padding: 0 20px;">{{ $rsmsmerit1->YearOfAward }}</td>
                                            <td>{{ $rsmsmerit1->Name }}</td>
                                            <td style="padding: 0 20px;">{{ $rsmsmerit1->LevelOrYear }}
                                            </td>
                                            <td>{{ $rsmsmerit1->School }}</td>
                                            <td style="padding: 0 20px">{{ $rsmsmerit1->Course }}</td>
                                            <td style="padding: 0 35px">{{ $rsmsmerit1->SemOrTriOrQtrStarted }}</td>
                                            <td style="padding: 0 25px">{{ $rsmsmerit1->CourseDuration }}</td>
                                            <td>{{ $rsmsmerit1->StatusAsOfEndOf2ndSemester20192020 }}</td>
                                            <td>{{ $rsmsmerit1->Remarks }}</td>
                                            <td>{{ $rsmsmerit1->Gender }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script
    src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js">
</script>
<script>
    jQuery(document).ready(function($) {
        var percentageOfViewport = 65;
        var scrollY = (percentageOfViewport / 100) * $(window).height();
        $('#thisdatatable').DataTable({
            "processing": true,
            "pageLength": 100, // Set the default number of entries
            scrollX: true,
            paging: true,
            scrollY: scrollY + 'px',
            columnDefs: [{
                    width: 100,
                    targets: [3, 5, 4, 6, 7],
                    orderable: false,
                    type: "string",

                } // Disable sorting for the first and third columns (columns are zero-based)
            ],
            fixedColumns: {
                leftColumns: 3, // Specify the number of left columns to freeze
                //  rightColumns: 1 // Specify the number of right columns to freeze
            },
            initComplete: function() {
                this.api().columns([3, 5, 4, 6, 7]).every(function(d) {
                    var column = this;
                    var theadname = $("#thisdatatable th").eq([d])
                        .text(); //used this specify table name and head
                    var select = $(
                            "<select style=\"padding: 1px !important;\" class=\"form-control\"><option value=\"\"> " +
                            theadname + " </option></select>"
                        )
                        .appendTo($(column.header()))
                        .on("change", function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append("<option value=\"" + d + "\">" + d +
                            "</option>")
                    });
                });
            }

        });
    });
</script>

</html>
