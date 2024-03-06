<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/all.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                background-color: #dddddd;

                /*  font-size: 12pt; */
            }
        </style>
    </head>

    <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}

            <div class="main">
                @include('layouts.header')

                <main class="content" style="padding:1.0rem 1.0rem 1.0rem; !important;">
                    <div class="container-fluid">

                        <div class="col-lg-12 col-lg-6">
                            <div class="tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a id="thistab1" class="nav-link active d-flex align-items-center" href="#tab-1" data-bs-toggle="tab" role="tab"><i class="fas fa-comment-alt-exclamation"></i>&nbsp;Notified</a></li>
                                    <li class="nav-item"><a class="nav-link d-flex align-items-center" href="#tab-2" data-bs-toggle="tab" role="tab"><i class="fas fa-check-square"></i>&nbsp;Availed</a></li>
                                    <li class="nav-item"><a class="nav-link d-flex align-items-center" href="#tab-3" data-bs-toggle="tab" role="tab"><i class="fas fa-times-circle"></i>&nbsp;Not Availed</a></li>
                                    <li class="nav-item"><a class="nav-link d-flex align-items-center " href="#tab-4" data-bs-toggle="tab" role="tab"><i style="margin-bottom: 2px;" class="fas fa-clipboard-user"></i>&nbsp;Attendance</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">

                                        {{-- PENDING TABLE --}}
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:40%;">Name</th>
                                                    <th style="width:20%">Email</th>
                                                    <th class="d-none d-md-table-cell" style="width:25%">Date of Birth
                                                    </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>

                                            @if ($replyslipsandscholarjoinpending->isNotEmpty())
                                                <tbody>
                                                    @foreach ($replyslipsandscholarjoinpending as $replyslipsandscholarjoinpending1)
                                                        <tr>
                                                            <td>{{ $replyslipsandscholarjoinpending1->fname }}
                                                                {{ $replyslipsandscholarjoinpending1->mname }}
                                                                {{ $replyslipsandscholarjoinpending1->lname }}</td>
                                                            <td>{{ $replyslipsandscholarjoinpending1->email }}</td>
                                                            <td class="d-none d-md-table-cell">
                                                                {{ $replyslipsandscholarjoinpending1->bday }}</td>
                                                            <td class="table-action">
                                                                <a href=""><i class="fas fa-user-edit"></i></a>
                                                                <a href=""></a>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>

                                                    </tr>

                                                </tbody>
                                            @endif


                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">
                                        {{-- ACCEPTED TABLE --}}
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:20%;">ID</th>
                                                    <th style="width:40%;">Name</th>
                                                    <th style="width:20%">Email</th>
                                                    <th class="d-none d-md-table-cell" style="width:25%">Date of Birth
                                                    </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($replyslipsandscholarjoinaccepted->isNotEmpty())
                                                    @foreach ($replyslipsandscholarjoinaccepted as $replyslipsandscholarjoinaccepted1)
                                                        <tr>
                                                            <td>{{ $replyslipsandscholarjoinaccepted1->id }}
                                                            <td>{{ $replyslipsandscholarjoinaccepted1->fname }}
                                                                {{ $replyslipsandscholarjoinaccepted1->mname }}
                                                                {{ $replyslipsandscholarjoinaccepted1->lname }}</td>
                                                            <td>{{ $replyslipsandscholarjoinaccepted1->email }}</td>
                                                            <td class="d-none d-md-table-cell">
                                                                {{ $replyslipsandscholarjoinaccepted1->bday }}</td>
                                                            <td class="table-action">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#acceptedmodal">
                                                                    View
                                                                </button>
                                                                <div class="modal fade" id="acceptedmodal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $replyslipsandscholarjoinaccepted1->fname }}
                                                                                    {{ $replyslipsandscholarjoinaccepted1->mname }}
                                                                                    {{ $replyslipsandscholarjoinaccepted1->lname }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body m-1">
                                                                                <strong>
                                                                                    <p class="mb-0">I am AVAILING my
                                                                                        scholarship award.</p>
                                                                                </strong>

                                                                                <div class="row">
                                                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                                                        <p class="mb-0">Qualifier's
                                                                                            Name
                                                                                            and Signature</p>
                                                                                        <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoinaccepted1->signature }}" alt="blank">

                                                                                    </div>
                                                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                                                        <p class="mb-0">
                                                                                            Parent's/Guardian's Name and
                                                                                            Signature</p>
                                                                                        <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoinaccepted1->signatureparents }}" alt="blank">
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>

                                                @endif


                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="tab-3" role="tabpanel">
                                        {{-- REJECTED TABLE --}}
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:40%;">Name</th>
                                                    <th style="width:20%">Email</th>
                                                    <th class="d-none d-md-table-cell" style="width:25%">Date of Birth
                                                    </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($replyslipsandscholarjoinrejected->isNotEmpty())
                                                        @foreach ($replyslipsandscholarjoinrejected as $replyslipsandscholarjoinrejected1)
                                                            <td>{{ $replyslipsandscholarjoinrejected1->fname }}
                                                                {{ $replyslipsandscholarjoinrejected1->mname }}
                                                                {{ $replyslipsandscholarjoinrejected1->lname }}</td>
                                                            <td>{{ $replyslipsandscholarjoinrejected1->email }}</td>
                                                            <td class="d-none d-md-table-cell">
                                                                {{ $replyslipsandscholarjoinrejected1->bday }}</td>
                                                            <td class="table-action">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rejectedmodal">
                                                                    View
                                                                </button>
                                                                <div class="modal fade" id="rejectedmodal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $replyslipsandscholarjoinrejected1->fname }}
                                                                                    {{ $replyslipsandscholarjoinrejected1->mname }}
                                                                                    {{ $replyslipsandscholarjoinrejected1->lname }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body m-1">
                                                                                <strong>class="mb-0">I am NOT AVAILING
                                                                                the
                                                                                scholarship due to… </strong>
                                                                                <p class="mb-0">
                                                                                    {{ $replyslipsandscholarjoinrejected1->reason }}
                                                                                </p>


                                                                                <div class="row">
                                                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                                                        <p class="mb-0">Qualifier's
                                                                                            Name
                                                                                            and Signature</p>
                                                                                        <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoinrejected1->signature }}" alt="blank">
                                                                                    </div>
                                                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                                                        <p class="mb-0">
                                                                                            Parent's/Guardian's Name and
                                                                                            Signature</p>
                                                                                        <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoinrejected1->signatureparents }}" alt="blank">
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        @endforeach
                                                    @else
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>

                                                    @endif

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab-4" role="tabpanel">
                                        {{-- REJECTED TABLE --}}
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:40%;">Name</th>
                                                    <th style="width:20%">Email</th>
                                                    <th class="d-none d-md-table-cell" style="width:25%">Date of Birth
                                                    </th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($replyslipsandscholarjoindeferred->isNotEmpty())
                                                        @foreach ($replyslipsandscholarjoindeferred as $replyslipsandscholarjoindeferred1)
                                                            <td>{{ $replyslipsandscholarjoindeferred1->fname }}
                                                                {{ $replyslipsandscholarjoindeferred1->mname }}
                                                                {{ $replyslipsandscholarjoindeferred1->lname }}</td>
                                                            <td>{{ $replyslipsandscholarjoindeferred1->email }}</td>
                                                            <td class="d-none d-md-table-cell">
                                                                {{ $replyslipsandscholarjoindeferred1->bday }}</td>
                                                            <td class="table-action">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defferedmodal">
                                                                    View
                                                                </button>
                                                                <div class="modal fade" id="defferedmodal" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">
                                                                                    {{ $replyslipsandscholarjoindeferred1->fname }}
                                                                                    {{ $replyslipsandscholarjoindeferred1->mname }}
                                                                                    {{ $replyslipsandscholarjoindeferred1->lname }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body m-1">
                                                                                <strong>I am DEFERRING my scholarship
                                                                                    award
                                                                                    due to … </strong>
                                                                                <p class="mb-0">
                                                                                    {{ $replyslipsandscholarjoindeferred1->reason }}
                                                                                </p>


                                                                                <div class="row">
                                                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                                                        <p class="mb-0">Qualifier's
                                                                                            Name
                                                                                            and Signature</p>
                                                                                        <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoindeferred1->signature }}" alt="blank">
                                                                                    </div>
                                                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                                                        <p class="mb-0">
                                                                                            Parent's/Guardian's Name and
                                                                                            Signature</p>
                                                                                        <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoindeferred1->signatureparents }}" alt="blank">
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                        @endforeach
                                                    @else
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>

                                                    @endif

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </main>
            </div>
        </div>
    </body>
    {{-- TAB TOGGLING --}}
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script></script>

</html>
