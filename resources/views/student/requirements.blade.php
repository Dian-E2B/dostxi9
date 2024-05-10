@extends('student.layoutsst.app')

@section('content')
    @php
        $replyStatusId = \App\Models\Replyslips::where('scholar_id', auth()->user()->scholar_id)->value('replyslip_status_id');
    @endphp

    <div class="row justify-content-center mt-3" style="margin-auto; !important">
        <div class="card col-lg-5 col-12">
            @if ($scholar_endorsed_status_id == 0)
                <div class="card-body">
                    @if ($replyStatusId == 1)
                        <div>
                            Details Of Orientation:
                        </div>
                        <hr>
                        <span style="font-size: 1.5rem">
                            @php
                                $emailcontent = DB::table('emailcontent')->first();
                                $dateValue = $emailcontent->thisdate;
                                $venueValue = $emailcontent->venue;
                                $timeValue = $emailcontent->time;
                            @endphp
                            Venue : {{ $venueValue }}
                            <br>
                            Date : {{ $dateValue }}
                            <br>
                            Time : {{ $timeValue }}
                        </span>
                        <hr>
                        <div class="">
                            <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">Answer ReplySlip <i class="align-middle me-2" data-feather="edit-3"></i></a>
                        </div>
                    @elseif ($replyStatusId == 2)
                        <script>
                            Swal.fire({
                                title: 'Hello Scholar!',
                                text: 'Please submit your requirements to continue to your portal',
                                icon: 'info',
                                width: '500px',
                                confirmButtonText: 'Okay',
                            })
                        </script>
                        <div class="d-flex ">
                            <div class=" ms-auto ">
                                <a class="btn btn-light d-flex align-items-center" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <box-icon name='log-out'></box-icon>
                                    <span style="margin-left: 8px;">Log out</span>
                                </a>
                            </div>
                        </div>

                        <hr>

                        Please Upload your requirements and wait for confirmation to access your dashboard.

                        <form method="POST" id="submit-form" action="{{ route('savefirstrequirements') }}" enctype="multipart/form-data">
                            <div class="row row-cols-md-2 row-cols-xs-1 mt-3">
                                @csrf
                                <input hidden name="scholarid" value="{{ auth()->user()->scholar_id }}">
                                <div class="col mt-2">
                                    <span class="">Scholarship Agreement</span>
                                    <br>
                                    <span class=""><input class="form-control form-control-lg" accept="application/pdf" type="file" name="scholarshipagreement" required></span>
                                </div>
                                <div class="col mt-2">
                                    <span class="">Information Sheet</span>
                                    <br>
                                    <span class=""><input class="form-control form-control-lg " accept="application/pdf" type="file" name="informationsheet" required></span>
                                </div>
                                <div class="col mt-2">
                                    <span class="">Scholar's Oath</span>
                                    <br>
                                    <span class=""><input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="scholaroath" required></span>
                                </div>
                                <div class="col  mt-2">
                                    <div class="">Prospectus</div>
                                    <div class=""><input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="prospectus" required></div>
                                </div>
                                <div class="col col-12 mt-2 d-block">
                                    <div class="">COR</div>
                                    <div class=""><input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="corfirst" required></div>
                                </div>
                                <div class="col mt-2">
                                    <span class="">Account Number</span>
                                    <br>
                                    <span class=""><input class="form-control form-control-lg" accept="application/pdf" type="file" id="formFile" name="accnumber" required></span>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <button id="submitBtn" type="submit" class="btn btn-primary d-flex"><span style="">Submit </span></button>
                                </div>
                            </div>
                        </form>
                    @elseif($replyStatusId == 7)
                        <div class="">
                            @livewire('scholar.thisscholarrequirement', ['scholar_id' => auth()->user()->scholar_id])
                        </div>
                        <div class="mt-3">
                            Please wait for confirmation to your dashboard.
                        </div>
                        <br>
                        <div class="d-flex">
                            <div class=" ms-auto ">
                                <form id="logout-form" action="{{ route('student.logout') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-light d-flex align-items-center" type="submit">
                                        <i style="margin-right: 5px;" class="bi bi-box-arrow-left"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                    @endif
                </div>
            @endif
        </div>
    @endsection
