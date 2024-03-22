<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fontaws.css') }}" rel="stylesheet">
        <style>
            body {

                /*  font-size: 12pt; */
            }
        </style>
    </head>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
        <main id="main" style="padding:1.5rem 0.5rem 0.5rem; !important;">
            <div class="main">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body mt-2">
                            <div class="col-lg-12 col-lg-6">
                                <div class="tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"><a id="thistab1" class="nav-link active d-flex align-items-center" href="#tab-1" data-bs-toggle="tab" role="tab"><box-icon name='bell-ring' type='solid' color='gray'></box-icon>&nbsp;Notified</a></li>
                                        <li class="nav-item"><a class="nav-link d-flex align-items-center" href="#tab-2" data-bs-toggle="tab" role="tab"><box-icon type='solid' name='user-check' color='gray'></box-icon>&nbsp;Availed</a></li>
                                        <li class="nav-item"><a class="nav-link d-flex align-items-center" href="#tab-3" data-bs-toggle="tab" role="tab"><box-icon name='user-x' type='solid' color='gray'></box-icon>&nbsp;Not Availed</a></li>
                                        <li class="nav-item"><a class="nav-link d-flex align-items-center " href="#tab-4" data-bs-toggle="tab" role="tab"><box-icon type='solid' name='calendar-week' color='gray'></box-icon>&nbsp;Deffered</a></li>
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
                    </div>
                </div>
            </div>
        </main>
    </body>
    {{-- TAB TOGGLING --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script></script>

</html>
