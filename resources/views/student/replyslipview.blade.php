<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Jquery Js --}}
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            .sidebar-toggle {
                display: none;
            }

            body #requestscholar {
                display: none;
            }

            .swal2-confirm {}
        </style>
    </head>

    <body class="toggle-sidebar">
        @include('student.layoutsst.header')
        <main id="main" class="main">
            <div class="main">
                <div class="">
                    <div class="container-fluid ">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-4">
                                <div class="card" style="top: 1cm">
                                    <div class="card-body mt-1" style="">
                                        <div class="" style="margin-top: 0.5cm;">
                                            @if ($replyslipstatusid != 1)
                                                @foreach ($replyslips as $replyslip)
                                                    <strong>As one of those who qualified for the {{ now()->year }} DOST-SEI S&T Undergraduate Scholarships under {{ $programname }}, I wish to inform you that: </strong>
                                                    @if ($replyslipstatusid == 2 || $replyslipstatusid == 5)
                                                        <div>
                                                            <strong> I am AVAILING my scholarship award.</strong>
                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <div>
                                                                Qualifier's Signature:
                                                            </div>
                                                            <img style="max-height: 300px; max-width: 300px" src="{{ asset($replyslipsignature) }}" alt="none">

                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <div>
                                                                Parents/Guardian's Signature:
                                                            </div>

                                                            <img style="max-height: 300px; max-width: 300px" src="{{ asset($replyslipparentsignature) }}" alt="none ">
                                                        </div>
                                                    @endif
                                                    @if ($replyslipstatusid == 3)
                                                        <div>
                                                            I am NOT AVAILING the scholarship due to… (Please indicate reason on the field below.)
                                                            <p>{{ $reason1 }}</p>
                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <div>
                                                                Qualifier's Signature:
                                                            </div>
                                                            <img style="max-height: 300px; max-width: 300px" src="{{ asset('public/' . $replyslipsignature) }}" alt="none">

                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <div>
                                                                Parents/Guardian's Signature:
                                                            </div>
                                                            <img style="max-height: 300px; max-width: 300px" src="{{ asset($replyslipparentsignature) }}" alt="none ">
                                                        </div>
                                                    @endif

                                                    @if ($replyslipstatusid == 4)
                                                        <div>
                                                            I am DEFERRING my scholarship award due to … (Please indicate reason on the field below.)
                                                            <p>{{ $reason1 }}</p>
                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <div>
                                                                Qualifier's Signature:
                                                            </div>
                                                            <img style="max-height: 300px; max-width: 300px" src="{{ asset($replyslipsignature) }}" alt="none ">
                                                        </div>
                                                        <div style="margin-top: 10px">
                                                            <div>
                                                                Parents/Guardian's Signature:
                                                            </div>
                                                            <img style="max-height: 300px; max-width: 300px" src="{{ asset($replyslipparentsignature) }}" alt="none ">
                                                        </div>
                                                    @endif
                                                    <label>
                                                        <input name="scholarid" style="display: none;" value="{{ $replyslip->scholar_id }}">
                                                    </label>
                                                @endforeach
                                            @else
                                                <form id="replyslipform" action="{{ route('replyslipsubmit') }}" method="POST" enctype="multipart/form-data">

                                                    @csrf <!-- Include CSRF token for form security -->
                                                    @foreach ($replyslips as $replyslip)
                                                        <p>As one of those who qualified for the {{ now()->year }} DOST-SEI S&T Undergraduate Scholarships under {{ $programname }}, I wish to inform you that: (Please check)</p>
                                                        <label class="form-check">
                                                            <input id="checkbox1" name="acceptcheckbox" class="form-check-input option-checkbox" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                I am AVAILING my scholarship award.
                                                            </span>
                                                        </label>

                                                        <label class="form-check">
                                                            <input name="rejectcheckbox" class="form-check-input option-checkbox" type="checkbox" value="">
                                                            <span class="form-check-label">
                                                                I am NOT AVAILING the scholarship due to… (Please indicate reason on the field below.)
                                                            </span>
                                                        </label>
                                                        <label>
                                                            <input name="scholarid" style="display: none;" value="{{ $replyslip->scholar_id }}">
                                                        </label>


                                                        <textarea style="width: 100% !important;" id="textarea1" class="form-control" rows="2" placeholder="Reasons:" name="reason" required></textarea>


                                                        <strong><label>Qualifier Printed Name with Signature:</label></strong>
                                                        <input style="margin-top: 10px;" required type="file" name="signaturestudent" id="signature" accept="image/png, image/jpeg">
                                                        <div id="previewLink" style="display: none;">
                                                            <a href="#" target="_blank" id="filePreviewLinkImage">Review Signature</a>
                                                        </div>

                                                        <strong><label style="">Parent/Legal Guardian Name with Signature:</label></strong>
                                                        <input style="margin-top: 15px;" class="form-group" required type="file" name="signatureparent" id="signatures" accept="image/*">
                                                        <div id="previewLink2" style="display: none;">
                                                            <a href="#" target="_blank" id="filePreviewLink2">Review Signature</a>
                                                        </div>


                                                        <!-- Button trigger modal -->
                                                        <br>
                                                        <button type="button" class="btn btn-primary mt-2" id="submitBtn">
                                                            Submit
                                                        </button>
                                                    @endforeach
                                                </form>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        const submitButton = document.getElementById('submitBtn');

        //START SWEETALERT
        submitButton.addEventListener('click', () => {
            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Submit Reply Slip?',
                text: 'Please note that this submission is final and non-editable.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: false,
                confirmButtonColor: '#0d6efd',
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('replyslipform');
                    if (form.checkValidity()) {
                        form.submit();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please fill out all required fields before submitting!',
                            confirmButtonColor: 'red',
                        });
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User clicked cancel, do nothing or provide feedback
                    //console.log('Submission cancelled!');
                }
            });
        });


        function setupFilePreview(inputId, previewLinkId, filePreviewLinkId) {
            var fileInput = document.getElementById(inputId);

            fileInput.addEventListener('change', function() {
                var selectedFile = fileInput.files[0];

                if (selectedFile) {
                    document.getElementById(previewLinkId).style.display = 'block';

                    var fileURL = URL.createObjectURL(selectedFile);
                    document.getElementById(filePreviewLinkId).href = fileURL;
                }
            });
        }

        // Set up file preview for the first file input
        setupFilePreview('signature', 'previewLink', 'filePreviewLinkImage');

        // Set up file preview for the second file input
        setupFilePreview('signatures', 'previewLink2', 'filePreviewLink2');

        const checkbox1 = document.getElementById('checkbox1');
        const checkboxes = document.querySelectorAll('.option-checkbox');
        const textarea1 = document.getElementById('textarea1');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                if (checkbox1.checked) {
                    // If checked, disable the textarea
                    if (checkbox.checked) {
                        // Disable other checkboxes
                        checkboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.disabled = true;
                            }
                        });
                    } else {
                        // Enable all checkboxes
                        checkboxes.forEach(otherCheckbox => {
                            otherCheckbox.disabled = false;
                        });
                    }
                    textarea1.disabled = true;
                } else {
                    if (checkbox.checked) {
                        // Disable other checkboxes
                        checkboxes.forEach(otherCheckbox => {
                            if (otherCheckbox !== checkbox) {
                                otherCheckbox.disabled = true;
                            }
                        });
                    } else {
                        // Enable all checkboxes
                        checkboxes.forEach(otherCheckbox => {
                            otherCheckbox.disabled = false;
                        });
                    }
                    // If not checked, enable the textarea
                    textarea1.disabled = false;
                }

            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('#replyslipform');
            form.addEventListener('submit', function(event) {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

                // Check if at least one checkbox is checked
                if (checkboxes.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Please select at least one option before submitting',
                        title: 'ERROR!',
                    })
                    event.preventDefault(); // Prevent form submission
                }
            });
        });


        function clicked(e) {
            if (!confirm()) {
                e.preventDefault();
            }
        }
    </script>

</html>
