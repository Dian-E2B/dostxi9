<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>{{-- SWEETALERT --}}
    </head>

    <body>
        @if (session('error'))
            <script>
                let errorMessage = "{{ session('error') }}";
                Swal.fire({
                    icon: "error",
                    title: "ERROR!",
                    text: errorMessage,
                });
            </script>
        @elseif (session('success'))
            <script>
                let successmessage = "{{ session('success') }}";
                Swal.fire({
                    icon: "success",
                    title: "",
                    text: successmessage,
                });
            </script>
        @elseif (session('uploaded'))
            <script>
                let successmessage = "{{ session('uploaded') }}";
                Swal.fire({
                    iconHtml: '<img src="/extraicons/upload.gif" style="width: 150px; height: 150px;">',
                    title: "Uploaded",
                    text: successmessage,
                });
            </script>
        @endif

        @include('student.layoutsst.sidebar')
        @include('student.layoutsst.header')
        <main id="main" class="main" style="padding: 1.5rem 0.5rem 0.5rem; !important;">
            <div class="content">
                <div class="main">

                    @if (!empty($thesis))
                        @if ($thesis->thesis_status == 'Approved')
                            <div class="row justify-content-center">

                                <div class="col-6">
                                    <div class="card p-1" style="text-align: center; font-size:1.5em; font-weight: 700">Final Manuscript</div>
                                    <div class="card">
                                        <div class="row p-3">
                                            <div class="">
                                                You can now upload your final manuscript
                                                <input name="fin_manus" required class="form-control" type="file" id="formFile" accept=".pdf">
                                                <button class="btn btn-success mt-2">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @elseif ($thesis->thesis_status == 'pending')
                            <script>
                                Swal.fire({
                                    title: 'Thesis Still Pending',
                                    text: 'Your thesis proposal is still pending, please wait for approval.',
                                    iconHtml: '<img src="/extraicons/filewithtime.gif" style="width: 150px; height: 150px;">',
                                    width: '500px', // Set the width of the dialog box
                                    showCancelButton: false, // There won't be any cancel button
                                    showConfirmButton: false, // There won't be any confirm button
                                    allowOutsideClick: false,
                                    backdrop: false,
                                });
                            </script>
                        @else
                            <div class="row justify-content-center">
                                <div class="card col-6" style="text-align: center; font-size: 1.5em; font-weight: 700">Thesis Proposal</div>
                            </div>
                            <div class="row justify-content-center">

                                <div class="card col-6">
                                    <div class="card-body">
                                        <div class="h5 mt-3">Upload Your Thesis Proposal</div>
                                        <form id="thesisForm" action="{{ route('thesissubmitreupload') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row row-cols-auto mt-4">
                                                <label for="formFile" class=" col-form-label">File Upload</label>
                                                <div class="">
                                                    <input name="thesispdf" required class="form-control" type="file" id="formFile" accept=".pdf">
                                                </div>
                                            </div>
                                            <button id="submitButton" class="btn btn-primary mt-3" type="submit" type="submit">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row justify-content-center">
                            <div class="card col-6" style="text-align: center; font-size: 1.5em; font-weight: 700">Thesis Proposal</div>
                        </div>
                        <div class="row justify-content-center">

                            <div class="card col-6">
                                <div class="card-body">
                                    <div class="h5 mt-3">Upload Your Thesis Proposal</div>
                                    <form id="thesisForm" action="{{ route('thesissubmit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row row-cols-auto mt-4">
                                            <label for="formFile" class=" col-form-label">File Upload</label>
                                            <div class="">
                                                <input name="thesispdf" required class="form-control" type="file" id="formFile" accept=".pdf">
                                            </div>
                                        </div>
                                        <button id="submitButton" class="btn btn-primary mt-3" type="submit" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    @endif

                </div>
            </div>
        </main>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitButton').click(function(e) {
                e.preventDefault(); // Prevent the default form submission

                var formData = new FormData($('#thesisForm')[0]); // Get form data

                // Send AJAX request
                $.ajax({
                    url: $('#thesisForm').attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle successful submission

                        Swal.fire({
                            iconHtml: '<img src="/extraicons/upload.gif" style="width: 150px; height: 150px;">',
                            title: "Uploaded",
                            text: response.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(); // Reload the page
                            }
                        });
                        // Optionally, you can redirect the user to another page or perform other actions
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                        alert('Error submitting thesis. Please try again.');
                    }
                });
            });
        });
    </script>

</html>
