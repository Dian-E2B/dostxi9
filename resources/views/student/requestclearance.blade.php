<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/all.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .noborder-bottom {
                border-bottom: none !important;
                border-top: none !important;
                border-right-width: medium !important;

                border-left-width: medium;

            }

            .input-group-textmod {


                color: #495057;
                display: flex;
                font-size: .875rem;
                font-weight: 400;
                line-height: 1.5;
                padding: 0.3rem 0.5rem;
                text-align: left;
                white-space: nowrap;
            }

            .styled-hr {
                border: none;
                height: 2px;
                /* Adjust the line height as needed */
                background-color: #000000;
                /* Use a darker color (e.g., #333) */
                margin: 10px 0;
                /* Adjust the margin for spacing */
            }

            /*.borderright {*/
            /*    border-right-width: medium !important;*/
            /*}*/

            .changebordercolor {
                border-left-width: medium;


                border-bottom-color: black !important;
                border-right-width: medium !important;
            }

            .form-check-input {
                border: solid #4c4c4c !important;
            }

            .noborderinput {
                width: 100%;
                height: 100%;
                border: none;
                /* Remove input border */
                padding: 0;
                /* Remove any padding */
                white-space: pre-line;
                /* Allow text to wrap like in a <textarea> */
                line-height: 1.5;
                /* Adjust line height for better readability */
            }


            .tabletd2 {
                max-width: 200px !important;
            }

            .tabletd2:focus {
                background-color: #fff;
                border-color: #9dbeee !important;
                box-shadow: 0 0 0 .25rem rgba(59, 125, 221, .25);
                color: #495057;
                outline: 0;
            }

            th {
                text-align: center;
                vertical-align: center;
            }

            .btn-a {
                border: 1px solid gray;
            }

            .btn-a:hover {
                background-color: rgb(64, 172, 179);
                color: white;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">


        <div class="wrapper">


            <div class="main">
                {{-- HEADER START --}}
                @include('student.layoutsst.header')
                {{-- HEADER END --}}

                <main class="content">
                    {{-- <a class="mb-3 btn btn-primary">
                        Download File
                    </a> --}}
                    <div class="container-fluid p-0">




                        <div class="row">
                            <div class="col-xl-6">
                                <div class="row">
                                    <div class="col">
                                        <div style="padding-right: 20px; padding-left: 20px;" class="card">
                                            <a href="{{ route('downloadpdfclearance', ['filename' => 'ScholarshipClearance.pdf']) }}" class="btn btn-a mb-3 mt-3">
                                                <i class="fad fa-download" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i> Clearance
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                {{-- <div class="row">
                                    <div class="col">
                                        <div style="padding-right: 20px; padding-left: 20px;" class="card">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Files Uploaded</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div> --}}
                            </div>

                            <div class="col-xl-6 align-items-center">
                                <div style="padding-right: 20px; padding-left: 20px;" class="card">
                                    <div class="mt-3" style="align-self: center; font-size: 18pt; font-weight:bold">Upload Documents</div>
                                    <div class="" style="align-self: center; font-size: 10spt; font-weight:bold">please upload your files here</div>




                                    <form class="" method="POST" action="{{ route('savepdfclearance') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6 offset-md-3">
                                                <select required name="fileuploadedname" required class="form-control mt-3" style="width: 100%">
                                                    <option value="">Document Type</option>
                                                    <option value="Reply Slip Form">Reply Slip Form</option>
                                                    <option value="Scholars' Oath">Scholars' Oath</option>
                                                    <option value="Prospectus">Prospectus</option>
                                                    <option value="Certificate of Registration">Certificate of Registration</option>
                                                    <option value="Certificate of Grades">Certificate of Grades</option>
                                                    <option value="Clearance Request Form">Clearance Request Form</option>
                                                    <option value="Shifting and Transfer Form">Shifting and Transfer Form</option>
                                                    <option value="Scholar Thesis Form">Scholar Thesis Form</option>
                                                    <option value="Scholar Graduate Data File">Scholar Graduate Data File</option>
                                                    <option value="Transcript of Records">Transcript of Records</option>
                                                    <option value="Diploma">Diploma</option>
                                                </select>
                                                <input name="fileupload" required style="width: 100%" class="form-control mt-3" type="file" accept="image/*,.pdf">
                                                <button class="d-grid btn btn-primary col-4 mx-auto" style="margin: 20px auto;" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>



                    </div>
            </div>
            </main>
        </div>
        </div>

        <script src="{{ asset('js/all.js') }}"></script>
    </body>
    {{-- PRINT TOGGLING --}}


</html>
