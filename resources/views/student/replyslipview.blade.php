<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('css/notyf.min.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .sidebar-toggle {
                display: none;
            }

            body #requestscholar {
                display: none;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="light">
        <div class="wrapper">

            <div class="main">
                {{-- HEADER START --}}
                @include('student.layoutsst.header')
                {{-- HEADER END --}}

                <main class="content">
                    <div class="container-fluid p-0">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Reply Slip</h5>
                                    </div>
                                    <div class="card-body">

                                        @if ($replyslipstatusid != 1)
                                            @foreach ($replyslips as $replyslip)
                                                <p>As one of those who qualified for the {{ now()->year }} DOST-SEI S&T Undergraduate Scholarships under {{ $programname }}, I wish to inform you that:</p>
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
                                                        <input name="defferedcheckbox" class="form-check-input option-checkbox" type="checkbox" value="">
                                                        <span class="form-check-label">
                                                            I am DEFERRING my scholarship award due to … (Please indicate reason on the field below.)
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
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        Submit
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <i style="font-size: 30px; color: #f8d404" class="fas fa-exclamation-triangle"></i>
                                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><span style="margin-bottom: 15px; margin-left: 5px; font-size: 20px;"> Warning</span></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5>Confirm? Please note that the submission is final and non-editable.</h5>
                                                                </div>
                                                                <div style="margin-right: 5px; margin-bottom:5px; text-align: right;">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Understood</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <button onclick="return confirm('Confirm? Please note that submission is final and non-editable.')" style="margin-top: 15px;" type="submit" class="btn btn-success"><i data-feather="check"></i> Save</button> --}}
                                                @endforeach
                                            </form>

                                        @endif




                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/notyf.min.js') }}"></script>
    <script>
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
            const form = document.querySelector('#replyslipform'); // Replace 'yourFormId' with your form's ID
            form.addEventListener('submit', function(event) {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

                // Check if at least one checkbox is checked
                if (checkboxes.length === 0) {
                    notyf.error({
                        message: 'Please select at least one option before submitting',
                        duration: 5000,
                        position: {
                            x: 'center',
                            y: 'top',
                        },
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
