<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <style>
            .vertical-line {
                width: 1px;
                /* Adjust the width of the line as needed */
                background-color: #000;
                /* Adjust the color of the line as needed */
                height: 100%;
                /* Make the line span the full height of the column */
            }

            #image-preview {
                width: 100%;
                /* 100% width to fill the magnifier container */
                height: auto;
                /* To maintain the aspect ratio */
                z-index: 999 !important;
            }


            .magnifier {
                width: 100%;
                height: 100%;

                align-items: center;
                z-index: 9999 !important;
            }

            #image-preview.magnify {
                transition: transform 0.5s;
                transform: scale(1.5);
                /* Adjust the scale factor to control the zoom level */
                margin-left: 20%;
                z-index: 9999 !important;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">


            <div class="main">
                {{-- HEADER START --}}



                @include('student.layoutsst.header')
                {{-- HEADER END --}}
                <main style="padding: 0.5rem 0.5rem 0.5rem 0.5rem" class="content">
                    <div class="container-fluid p-0">


                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Grade Input</h5>
                                </div>
                                <div class="card-body">
                                    {{-- BODY --}}
                                    <form id="input-form" method="POST" action="{{ route('submitgrades') }}" enctype="multipart/form-data">
                                        @csrf
                                        {{-- FILE UPLOAD SECTION --}}
                                        <div class="row">
                                            <div class="col-lg-6 text-left">
                                                <div class="py-1 py-md-1 border">


                                                    <div class="card-body">

                                                        <div class="magnifier">

                                                            <img class="py-md-3" id="image-preview" src="" alt="Image Preview" style="max-width: 500px; display: none; ">
                                                            <label class="form-label">COG image/file:</label>

                                                            <input required type="file" name="imagegrade" id="imagegradeid" class="form-control" accept="image/*, application/pdf">

                                                        </div>


                                                        <div class="row mt-3">
                                                            <div class="col-3">
                                                                <button class="form-control" type="button" onclick="viewFile()">View File</button>
                                                            </div>
                                                            <div class="col mt-1">
                                                                <div id="filePreview"></div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                            {{-- GRADING SECTION --}}
                                            <div class="col-lg-6 text-left">
                                                <div class="py-0 py-md-0 border">
                                                    <div class="card-body">


                                                        <label>
                                                            <input id="scholaridinput" name="scholarid" style="display: none;" value="{{ $scholarId }}">
                                                        </label>

                                                        {{-- SCHOOL YEAR --}}
                                                        <div class="row mt-2 row-cols-auto align-text-center">

                                                            <div class="col">
                                                                <label for="inputSchoolyear" class="col-form-label">School Year:</label>
                                                            </div>
                                                            <div class="col">
                                                                <input style="max-width: 80px;" required type="text" name="startyear" placeholder="yyyy" class="form-control">

                                                            </div>
                                                            <div class="col ">
                                                                -
                                                            </div>
                                                            <div class="col">
                                                                <input style="max-width: 80px;" required type="text" name="endyear" placeholder="yyyy" class="form-control">

                                                            </div>

                                                        </div>

                                                        <div class="row mt-3">

                                                            {{-- SEMESTER --}}
                                                            <div class="col-6">
                                                                <label>
                                                                    <select id="semesterSelect" name="semester" class="form-control" required>
                                                                        <option value="">Choose Semester:
                                                                        </option>{{-- 0-Summer | 1-First Sem | 2-Second Sem | 3-Third Sem --}}
                                                                        <option value="1">1st Semester</option>
                                                                        <option value="2">2nd Semester</option>
                                                                        <option value="0">Summer</option>
                                                                    </select>
                                                                </label>
                                                            </div>

                                                        </div>


                                                        <div class="row mt-3">
                                                            <div class="col-md-5">
                                                                <label>Subject Name:</label>
                                                                <input name="subjectnames[0][name]" type="text" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Grade:</label>
                                                                <input id="grade1" type="number" name="grades[0][grade]" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label>Units:</label>
                                                                <input id="unit1" name="units[0][unit]" type="number" class="form-control" required>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <br>
                                                                <button name="add" id="add" type="button" class="btn btn-success">Add Row
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div id="table">

                                                        </div>

                                                        {{--																		<!-- Your dynamic form fields generated using a for loop --> --}}


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="text-align: center; margin-top: 20px;">
                                            <button type="submit" class="btn btn-pill btn-primary">Submit All</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var i = 0;
        $('#add').click(function() {
            ++i;
            $('#table').append(
                '<div style="margin-top: 1.5%" class="row" id="row' + i + '">' +
                '<div class="col-md-5">' +
                ' <label>Subject Name:</label>' +
                '<input id="subjectname1" name="subjectnames[' + i + '][name]"  type="text" class="form-control" required>' +
                ' </div>' +
                '<div class="col-md-2">' +
                ' <label>Grade:</label>' +
                '<input id="grade1" type="number" name="grades[' + i + '][grade]"  class="form-control" required>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<label>Units:</label>' +
                '<input id="unit1" name="units[' + i + '][unit]"type="number" class="form-control" required>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<br>' +
                ' <button name="add" id="add" type="button" class="btn btn-danger remove-table-row">Delete</button>' +
                ' </div>' +
                '</div>'
            );
        });

        $(document).on('click', '.remove-table-row', function() {
            var rowId = $(this).closest('.row').attr('id');
            $('#' + rowId).remove();
        });

        // // Add an event listener to the file input
        // document.getElementById('imagegradeid').addEventListener('change', function() {
        //     var imagePreview = document.getElementById('image-preview');
        //     var fileInput = this;

        //     // Check if a file is selected
        //     if (fileInput.files && fileInput.files[0]) {
        //         var reader = new FileReader();

        //         reader.onload = function(e) {
        //             imagePreview.src = e.target.result;
        //             imagePreview.style.display = 'block'; // Display the image preview
        //         };

        //         reader.readAsDataURL(fileInput.files[0]);
        //     } else {
        //         imagePreview.src = '';
        //         imagePreview.style.display = 'none'; // Hide the image preview
        //     }
        // });

        // const image = document.getElementById('image-preview');

        // image.addEventListener('mouseenter', () => {
        //     image.classList.add('magnify');
        // });

        // image.addEventListener('mouseleave', () => {
        //     image.classList.remove('magnify');
        // });

        function viewFile() {
            var fileInput = document.getElementById('imagegradeid');
            var file = fileInput.files[0];
            var filePreviewElement = document.getElementById('filePreview');

            if (file) {
                // Display the filename or some indication
                filePreviewElement.textContent = 'Selected File: ' + file.name;

                // ... (rest of the code for preview or link based on file type)
            } else {
                filePreviewElement.textContent = 'No file selected.';
            }
        }
    </script>

</html>
