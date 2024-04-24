<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI - SIMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/all.css') }}">
        {{-- Jquery Js --}}

        {{-- Datatables css --}}
        <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">

    </head>

    <body class="toggle-sidebar" style="user-select: none;" oncontextmenu="return false;">
        @include('layouts.headeradmin') {{-- SIDEBAR START --}}

        <main id="main">
            @if (session('errors'))
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
            @endif
            <div class="container-fluid ">
                <div class="justify-content-center">


                    <div class="card">

                        <div class="card-body">

                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered mb-3" id="borderedTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Staff</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Admin</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false"></button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="borderedTabContent">
                                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                                    <table id="usertable" style="width: 100%; table-layout:fixed; " class="table-compact">
                                        <thead class="">
                                            <tr class="">
                                                <th class="">Username</th>
                                                <th class="">Email</th>
                                                <th class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <table id="admintable" style="width: 100%; table-layout:fixed; " class="table-compact">
                                        <thead class="">
                                            <tr class="">
                                                <th class="">Username</th>
                                                <th class="">Email</th>
                                                <th class="">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="bordered-contact" role="tabpanel" aria-labelledby="contact-tab">
                                    Saepe animi et soluta ad odit soluta sunt. Nihil quos omnis animi debitis cumque. Accusantium quibusdam perspiciatis qui qui omnis magnam. Officiis accusamus impedit molestias nostrum veniam. Qui amet ipsum iure. Dignissimos fuga tempore dolor.
                                </div>

                            </div><!-- End Bordered Tabs -->

                            <div class="mt-2">
                                <a href="{{ route('register') }}" class="btn btn-success btn-sm">Add User</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>



        </main>
    </body>
    {{-- SIDEBAR TOGGLING --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            var table = $('#usertable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 20,
                ajax: {
                    url: 'viewstaffs',
                    type: 'get'
                },
                columns: [{
                        data: 'username',

                    },
                    {
                        data: 'email',

                        orderable: false,
                    },
                    {
                        data: 'action',

                        orderable: false,
                    },
                ],
            });
        });
    </script>

</html>
