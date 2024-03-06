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
                                        <th>YEAR OF AWARD</th>
                                        <th>NAME</th>
                                        <th>
                                            <span style="display: none;">- SCHOOL -
                                            </span>
                                        </th>
                                        <th>
                                            <span style="display: none;">- COURSE -
                                            </span>
                                        </th>
                                        <th>
                                            <span>SEMESTER & ACADEMIC YEAR LAST REPORTED
                                            </span>
                                        </th>
                                        <th>
                                            <span style="display: none;"> - CONTACTNUMBER -
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rsmsnoncompliance as $rsmsnoncompliance1)
                                        <tr>
                                            <td> {{ $rsmsnoncompliance1->YEAROFAWARD }}</td>
                                            <td style="padding: 0 20px;">{{ $rsmsnoncompliance1->NAME }}</td>
                                            <td>{{ $rsmsnoncompliance1->SCHOOL }}</td>
                                            <td style="padding: 0 20px;">{{ $rsmsnoncompliance1->COURSE }}</td>
                                            <td style="padding: 0 40px;">
                                                {{ $rsmsnoncompliance1->SEMESTERandACADEMICYEARLASTREPORTED }}</td>
                                            <td style="padding: 0 20px">{{ $rsmsnoncompliance1->CONTACTNUMBER }}</td>
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
                    targets: [2, 3, 5],
                    orderable: false,
                    type: "string",

                } // Disable sorting for the first and third columns (columns are zero-based)
            ],
            fixedColumns: {
                leftColumns: 3, // Specify the number of left columns to freeze
                //  rightColumns: 1 // Specify the number of right columns to freeze
            },
            initComplete: function() {
                this.api().columns([2, 3, 5, ]).every(function(d) {
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
