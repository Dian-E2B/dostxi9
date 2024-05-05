@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mt-3 ">
                <div class="row">
                    <div class="col">
                        <div class="h4 mb-1" style="">Ongoing Endorsed List</div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3 mt-1">
                                    <div class="col-sm">
                                        <select class="form-control form-control-sm" name="year" id="year" class="" style="width: 100%;">
                                            <option value="">--Year--</option>
                                            <!-- Generate options for the current year to the next 10 years -->
                                            @php
                                                $currentYear = date('Y');
                                                $endYear = $currentYear + 10;
                                            @endphp
                                            @for ($year = $currentYear; $year <= $endYear; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-sm">
                                        <select class="form-control form-control-sm" style="margin:none;" name="semester" id="semester" style="width: 100%;">
                                            <option value="">--Semester--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="0">Summer</option>
                                        </select>
                                    </div>
                                    <div class="col-sm" style="">
                                        <button class="btn btn-light print-button btn-sm" style="padding: 2px 12px; width: 100%;"><i class="bi bi-printer-fill"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="row mb-4">
                    <div class="dropdown" style="user-select: none">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel-fill"></i>
                        </button>
                        <ul class="dropdown-menu" style="padding: 10px">
                            <form id="endorseyearform">
                                <div class="mb-2">
                                    <select id="selectyear" name="selectyear" class="form-control form-control-sm">
                                        <option value="">Year</option>
                                        <?php
                                        $currentYear = date('Y');
                                        for ($i = 0; $i <= 10; $i++) {
                                            $year = $currentYear - $i;
                                            echo "<option value=\"$year\">$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <select name="selectsemester" id="selectsemester" class="form-control form-control-sm">
                                        <option value="">Semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">Summer</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" id="submitfilter" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i></button>
                                </div>
                            </form>
                        </ul>
                    </div>
                </div>

                <div class="row ">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="endorsementsTable" class="table-striped table-compact table-sm" style="table-layout: fixed; width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Semester</th>
                                        <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            var table = $('#endorsementsTable').DataTable({
                ajax: {
                    url: '{{ route('endorsedprogram') }}',
                    type: 'GET'
                },
                columns: [{
                        data: 'NUMBER',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'semester',
                    },
                    {
                        data: 'startyear',
                    },
                ],

                /*  initComplete: function() {
                     var api = this.api();

                     api.columns([1, 2]).every(function(d) {
                         var column = this;
                         // Get the column header name
                         var theadname = $(api.column(d).header()).text();
                         // Create select element
                         var select = document.createElement('select');
                         select.add(new Option(' ' + theadname, ''));

                         // Add styles to the select element
                         select.style.padding = '1px'; // Example padding
                         // Replace the header with the select element
                         column.header().replaceChildren(select);

                         // Apply listener for user change in value
                         select.addEventListener('change', function() {
                             var val = DataTable.util.escapeRegex(select.value);

                             column
                                 .search(val ? '^' + val + '$' : '', true, false)
                                 .draw();
                         });

                         // Add list of options excluding theadname
                         column
                             .data()
                             .unique()
                             .sort()
                             .each(function(d, j) {
                                 // Skip theadname from the dropdown options
                                 if (d !== theadname) {
                                     select.add(new Option(d));
                                 }
                             });
                     });
                 }, */


            });

            $('#endorseyearform').on('submit', function(e) { //DONT DELETE
                e.preventDefault();
                var startyear = $('#selectyear').val();
                var semester = $('#selectsemester').val();
                var url = "endorsedprogram?startyear=" + startyear + "&semester=" + semester;
                table.ajax.url(url).load();
            });

            $(document).on('click', '.print-button', function() {
                var year = $('#year').val();
                var semester = $('#semester').val();
                if (year && semester) {
                    var url = '{{ url('/endorsedongoingprint/') }}' + '/' + year + '/' + semester;
                    var newWindow = window.open(url, '_blank');
                    newWindow.onload = function() {
                        newWindow.print();
                    };
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Please select year and semester!",
                    });

                }
            });
        });
    </script>
@endsection
