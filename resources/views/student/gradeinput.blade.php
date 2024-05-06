@extends('student.layoutsst.app')

@section('content')
    @if (session()->has('success'))
        <script>
            let successmessage = "{{ session('success') }}";
            Swal.fire({
                title: 'Thank You!',
                text: successmessage,
                icon: 'success',
                confirmButtonColor: "#3085d6",
                confirmButtonText: 'Okay',
            })
        </script>
    @endif


    <div class="container-fluid">
        @if (count($cogsdraft) > 0)
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        {{-- @dd($cogsdraft); --}}


                        <div class="table-responsive">
                            <table id="thisdatatable" class="hover table table-bordered compact nowrap align-content-center justify-content-center" style="width:100%;">
                                <thead>
                                    <tr>

                                        <th scope="col">Academic Year</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cogsdraft as $cogsdraft1)
                                        @php
                                            $ids1 = explode(',', $cogsdraft1->id);
                                            $subjects1 = explode(',', $cogsdraft1->Subjectname);
                                            $grades1 = explode(',', $cogsdraft1->Grade);
                                            $units1 = explode(',', $cogsdraft1->Units);
                                            $completed = explode(',', $cogsdraft1->Completed);
                                        @endphp
                                        <div class="mt-3">
                                            <form id="draftForm" action="{{ route('saveDraft') }}" method="POST" enctype="multipart/form-data" class="">
                                                @csrf
                                                <input type="hidden" name="scholar_id" value="{{ $cogsdraft1->scholar_id }}">
                                                <input type="hidden" name="is_delete" id="is_delete" value="0">
                                                <input type="hidden" name="cog_id" value="{{ $cogsdraft1->id1 }}">

                                                <button style="margin-right: 5px;" class="btn btn-pill btn-primary mb-2" type="submit">Submit as Final</button>
                                                <button type="button" class="btn btn-pill btn-danger mb-2" onclick="document.getElementById('is_delete').value = '1'; document.getElementById('draftForm').submit();">Delete Draft</button>
                                            </form>
                                        </div>

                                        @for ($i = 0; $i < count($subjects1); $i++)
                                            <tr>
                                                {{--    <td>{{ $ids[$i] }}</td> --}}
                                                @if ($i == 0)
                                                    <td rowspan="{{ count($subjects1) }}">{{ $cogsdraft1->startyear }}</td>
                                                    <td rowspan="{{ count($subjects1) }}">{{ $cogsdraft1->semester }}</td>
                                                @endif
                                                <td>{{ $subjects1[$i] }}</td>

                                                @if ($completed[$i] == 0)
                                                    <form action="{{ route('studenteditcog') }}" method="POST">
                                                        <td style="max-width: 200px; padding:4px !important; margin:0px;">
                                                            @csrf
                                                            <input type="hidden" name="cog_id" value="{{ explode(',', $cogsdraft1->id)[$i] }}">
                                                            <input style="border: none;" class=" form-control-sm" type="text" name="grade" placeholder="Enter Grade" value="{{ $grades1[$i] }}">
                                                        </td>
                                                        <td style="max-width: 50px;padding:4px !important;">
                                                            <button class="btn btn-pill btn-sm btn-success" type="submit">Update</button>
                                                        </td>
                                                    </form>
                                                @else
                                                @endif

                                                <td>{{ $units1[$i] }}</td>
                                            </tr>
                                        @endfor
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        @endif






        @if (count($cogdisapproved) > 0)
            <script class="">
                Swal.fire({
                    title: 'COG/COR Disapproved!',
                    text: 'Please reupload your COG and COR.',
                    iconHtml: '<img src="/extraicons/upload-file.gif" style="width: 150px; height: 150px;">',
                    width: '500px', // Set the width of the dialog box
                    confirmButtonText: 'Okay',
                })
            </script>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body mt-3">
                            <div class="mb-3" style="font-weight: 700">Disapproved COR/COG. Please reupload If needed</div>

                            <table class="compact table-sm table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="">Date Uploaded</th>
                                        <th class="">Semester</th>
                                        <th class="">Remarks</th>
                                        <th class="">COR</th>
                                        <th class="">COG</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($cogdisapproved as $cogdisapproved1)
                                        <tr class="">
                                            <td class="">
                                                {{ $cogdisapproved1->date_uploaded }}
                                            </td>
                                            <td class="">
                                                {{ $cogdisapproved1->semester }}
                                            </td>
                                            <td class="">
                                                {{ $cogdisapproved1->cogcor_remarks }}
                                            </td>
                                            <td class="">
                                                <a class="btn btn-light rounded-pill btn-sm d-flex p-1 justify-content-center" target="_blank" href="{{ asset($cogdisapproved1->cor_name) }}">
                                                    <box-icon name='show' type='solid' color='black'></box-icon>&nbsp;View
                                                </a>
                                            </td>

                                            <div class="w-100"></div>
                                            <td class="">
                                                <a href="{{ asset($cogdisapproved1->cog_name) }}" class="btn btn-light rounded-pill btn-sm d-flex justify-content-center p-1" target="_blank">
                                                    <box-icon name='show' type='solid' color='black'></box-icon>&nbsp;View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <form action="{{ route('reuploadcogcor') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="text" hidden name="cogiddisapprove" value="{{ $cogdisapproved[0]->id }}">
                                <div class="row">
                                    <div class="col">
                                        <div class="bold mb-1" style="font-weight: 700">Certificate of Registration</div>
                                        <input required type="file" name="reuploadedcor" class="form-control" accept="application/pdf">
                                    </div>
                                    <div class="col">
                                        <div class="bold mb-1" style="font-weight: 700">Certificate of Grades</div>
                                        <input required type="file" name="reuploadedcog" class="form-control" accept="application/pdf">
                                    </div>
                                    <div class="">
                                        <button class="btn btn-success rounded-pill btn-sm mt-2" type="submit">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>




                    </div>
                </div>
            </div>
        @else
            <form id="input-form" method="POST" action="{{ route('submitgrades') }}" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">

                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                {{-- SUBMIT PERIODIC REQUIREMENTS --}}
                                <div class="">
                                    <div style="font-size: 20px; font-weight: 900; text-align: center; margin-bottom: 5px;">SUBMIT PERIODIC REQUIREMENTS</div>
                                    <div class=""><span style="font-size: 15px">Certificate Of Registration: </span><input required name="corname" class="form-control" type="file" accept="application/pdf"></div> {{-- COR --}}

                                    <img class="py-md-3" id="image-preview" src="" alt="Image Preview" style="max-width: 500px; display: none; ">
                                    <div class="mt-2"><span style="font-size: 15px">Certificate Of Grades:</span> <input required type="file" name="imagegrade" id="imagegradeid" class="form-control" accept="image/*, application/pdf"></div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                {{-- PERIOD --}}
                                <div class="mt-3">
                                    <div style="font-size: 20px; font-weight: 900; text-align: left">PERIOD:</div>
                                    <div class="row">
                                        <div class="col-6"> <span>Semester:</span>
                                            <select id="semesterSelect" required name="semester" class="form-control mb-3">
                                                <option value="1">1st</option>
                                                <option value="2">2nd</option>
                                                <option value="3">3rd</option>
                                                <option value="0">Summer</option>
                                            </select>
                                        </div>
                                        <div class="col-6"> <span>Academic Year: (Startyear)</span>
                                            <select required class="form-control" id="year" name="startyear">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="is_draft" id="is_draft" value="0">

                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="d-flex align-items-center mt-3">
                                        <table class="compact  table table-bordered">
                                            <thead>
                                                <th>
                                                    Subject Name:
                                                </th>
                                                <th>
                                                    Grade:
                                                </th>
                                                <th>
                                                    Units:
                                                </th>
                                                <th>
                                                    Action
                                                </th>
                                            </thead>
                                            <tbody id="table">
                                                <tr>
                                                    <td><input name="subjectnames[0][name]" type="text" class="form-control" required></td>
                                                    <td style="width: 10em"> <input id="grade1" type="number" step="0.01" required pattern="[0-9]+" name="grades[0][grade]" class="form-control numeric-input"></td>
                                                    <td style="width: 10em"> <input id="unit1" name="units[0][unit]" required pattern="[0-9]+" type="number" class="form-control numeric-input"></td>
                                                    <td style="text-align: center"> <a name="add" id="add" type="button" class="form-control btn btn-success"><i class="fas fa-plus"></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                {{--  <table id="table"></table> {{-- add row area --}}
                                <label>
                                    <input id="scholaridinput" name="scholarid" style="display: none;" value="{{ $scholarId }}">
                                </label>

                                <div class="mt-3">
                                    <button type="submit" class="btn rounded-pill btn-primary">Submit All</button>
                                    <button type="button" class="btn rounded-pill btn-secondary" onclick="submitAsDraft()">Submit as Draft</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection



@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function submitAsDraft() {
            // Set the hidden input value to indicate it's a draft
            document.getElementById('is_draft').value = '1';
            // Trigger form validation
            if (document.getElementById('input-form').checkValidity()) {
                // Submit the form if all required fields are filled
                document.getElementById('input-form').submit();
            } else {
                // If validation fails, display error messages and prevent form submission
                event.preventDefault();
                event.stopPropagation();
                document.getElementById('input-form').classList.add('was-validated');
            }
        }


        var i = 0;
        $('#add').click(function() {
            ++i;
            $('#table').append(
                '<tr class="row1"  id="row' + i + '">' +
                '<td ><input name="subjectnames[' + i + '][name]" type="text" class="form-control" required></td>' +
                '<td style="width: 10em"><input id="grade' + i + '" type="number" step="0.01" required pattern="[0-9]+" name="grades[' + i + '][grade]" class="form-control numeric-input"></td>' +
                '<td style="width: 10em"><input id="unit' + i + '" name="units[' + i + '][unit]" required pattern="[0-9]+" type="number" class="form-control numeric-input"></td>' +
                '<td style="text-align: center"><button type="button" name="remove' + i + '" class="btn btn-danger form-control remove-table-row"><i class="fas fa-minus"></i></button></td>' +
                '</tr>'
            );
        });

        $(document).on('click', '.remove-table-row', function() {
            // Get the row ID
            var rowId = $(this).closest('.row1').attr('id');

            // Display SweetAlert confirmation modal
            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure you want to delete this row?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, remove the row
                    $('#' + rowId).remove();
                    Swal.fire(
                        '',
                        'Your row has been deleted.',
                        'success'
                    );
                }
            });
        });




        /* $('.numeric-input').keypress(function(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode != 46 || $(this).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57)) {
                event.preventDefault();
                notyf.error({
                    message: 'Numeric input only.',
                    duration: 3000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                });
            }
        }); */
    </script>
@endsection
