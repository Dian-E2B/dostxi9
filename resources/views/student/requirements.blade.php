@extends('student.layoutsst.app')
@section('content')
    @php
        $replyStatusId = \App\Models\Replyslips::where('scholar_id', auth()->user()->scholar_id)->value('replyslip_status_id');
    @endphp

    <div class="row justify-content-center mt-3" style="margin-auto; !important">
        <div class="card col-lg-8 col-12">
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
                                title: 'Hi Scholar!',
                                text: 'Please submit your requirements to continue to your dashboard',
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

                        <div class="h4 b">Please Upload your requirements and wait for confirmation to access your dashboard.</div>

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
                            @include('partials.scholar_information.scholar_requirements')
                        </div>
                        <div class="mt-3" style="font-size: 15pt; font-weight: 900">
                            Upload any missing requirements and wait for confirmation on your dashboard.
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
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script class="">
        document.addEventListener("DOMContentLoaded", function() {
            callcheckrequirements();
        });

        function callcheckrequirements() {
            checkrequirementstatuses();
            checkaccnumber();
            checkcorfirst();
            checkprospectus();
            checkscholaroath();
            checkinfosheet();
            checkscholaragreement();
        };

        function checkrequirementstatuses() {

            axios.get('/checkrequirementstatuses')
                .then(response => {
                    const data = response.data;
                    console.log(response.data);
                    if (data.getallstatuses.ac_status == 2 ||
                        data.getallstatuses.sa_status == 2 ||
                        data.getallstatuses.p_status == 2 ||
                        data.getallstatuses.inf_status == 2 ||
                        data.getallstatuses.cor_status == 2 ||
                        data.getallstatuses.so_status == 2) {
                        document.getElementById('requirementdiv').style.display = 'block'; //NOT FINISH
                    } else {
                        document.getElementById('requirementdiv').style.display = 'none';
                        document.getElementById('requirementdiv').remove();
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }

        function checkaccnumber() { //DONE
            axios.get('/checkaccnumber')
                .then(response => {
                    const data = response.data;
                    if (data.getaccnumber.ac_status == 2) {
                        document.getElementById('accnumbertr').style.display = 'table-row';
                        document.getElementById('getaccremarks').innerText = data.getaccnumber.ac_remarks;
                        document.getElementById('accnumberlink').href = '/' + data.getaccnumber.accnumber_name;
                    } else {
                        document.getElementById('accnumbertr').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }

        function setaccnumber() {
            var accform = document.getElementById('accform');
            var accformData = new FormData(document.getElementById('accform'));
            axios.post('/setaccnumber', accformData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    // console.log('Form submitted successfully:', response.data);
                    checkrequirementstatuses();
                    accform.reset();
                    if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Account Number Uploaded!',
                        });
                        callcheckrequirements();
                    }
                })
                .catch(function(error) {
                    console.error('Error submitting form:', error);

                });
        }


        function checkcorfirst() {
            axios.get('/checkcorfirst')
                .then(response => {
                    const data = response.data;
                    if (data.getcorfirst.cor_status == 2) {
                        document.getElementById('corfirsttr').style.display = 'table-row';
                        document.getElementById('getcorremarks').innerText = data.getcorfirst.cor1_remarks;
                        document.getElementById('corffirstlink').href = '/' + data.getcorfirst.cor_name;
                    } else {
                        document.getElementById('corfirsttr').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }


        function setcorfirst() {
            var corfirstform = document.getElementById('corfirstform');
            var corformData = new FormData(document.getElementById('corfirstform'));
            axios.post('/setcorfirst', corformData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    // console.log('Form submitted successfully:', response.data);

                    corfirstform.reset();
                    if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'COR Uploaded!',
                        });
                        callcheckrequirements();
                    }
                })
                .catch(function(error) {
                    console.error('Error submitting form:', error);

                });
        }


        function checkprospectus() {
            axios.get('/checkprospectus')
                .then(response => {
                    const data = response.data;
                    if (data.getprospectus.p_status == 2) {
                        document.getElementById('prospectustr').style.display = 'table-row';
                        document.getElementById('getprospectusremarks').innerText = data.getprospectus.p_remarks;
                        document.getElementById('prospectuslink').href = '/' + data.getprospectus.prospectus_name;
                    } else {
                        document.getElementById('prospectustr').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }

        function setprospectus() {
            var prospectusform = document.getElementById('prospectusform');
            var prospectusformData = new FormData(document.getElementById('prospectusform'));
            axios.post('/setprospectus', prospectusformData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    // console.log('Form submitted successfully:', response.data);

                    prospectusform.reset();
                    if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Prospectus Uploaded!',
                        });
                        callcheckrequirements();
                    }
                })
                .catch(function(error) {
                    console.error('Error submitting form:', error);

                });
        }

        function checkscholaroath() {
            axios.get('/checkscholaroath')
                .then(response => {
                    const data = response.data;
                    if (data.getscholaroath.so_status == 2) {
                        document.getElementById('scholaroathtr').style.display = 'table-row';
                        document.getElementById('getscholaroathremarks').innerText = data.getscholaroath.so_remarks;
                        document.getElementById('scholaroathlink').href = '/' + data.getscholaroath.scholaroath_name;
                    } else {
                        document.getElementById('scholaroathtr').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }


        function setscholaroath() {
            var scholaroathForm = document.getElementById('scholaroathForm');
            var scholaroathFormData = new FormData(document.getElementById('scholaroathForm'));
            axios.post('/setscholaroath', scholaroathFormData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    // console.log('Form submitted successfully:', response.data);
                    scholaroathForm.reset();
                    if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Scholar\'s Oath Uploaded!',
                        });
                        callcheckrequirements();
                    }
                })
                .catch(function(error) {
                    console.error('Error submitting form:', error);

                });
        }

        function checkinfosheet() {
            axios.get('/checkinfosheet')
                .then(response => {
                    const data = response.data;
                    if (response.data.error) {
                        document.getElementById('infotr').style.display = 'none';
                        document.getElementById('infotr').remove();
                    }
                    if (data.getinfosheet.inf_status == 2) {
                        document.getElementById('infotr').style.display = 'table-row';
                        document.getElementById('inforemarks').innerText = data.getinfosheet.inf_remarks;
                        document.getElementById('infolink').href = '/' + data.getinfosheet.infosheet_name;
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }

        function setinfosheet() {
            var Form = document.getElementById('infosheetForm');
            var thisFormData = new FormData(document.getElementById('infosheetForm'));
            axios.post('/setinfosheet', thisFormData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    // console.log('Form submitted successfully:', response.data);
                    Form.reset();
                    if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Information Sheet Uploaded!',
                        });
                        callcheckrequirements();
                    }
                })
                .catch(function(error) {
                    console.error('Error submitting form:', error);

                });
        }

        function checkscholaragreement() {
            axios.get('/checkscholaragreement')
                .then(response => {
                    const data = response.data;
                    if (data.getscholaragreement.sa_status == 2) {
                        document.getElementById('scholaragreementtr').style.display = 'table-row';
                        document.getElementById('scholaragreementremarks').innerText = data.getscholaragreement.sa_remarks;
                        document.getElementById('scholaragreementLink').href = '/' + data.getscholaragreement.scholarshipagreement_name;
                    } else {
                        document.getElementById('scholaragreementtr').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }

        function setscholaragreement() {
            var Form = document.getElementById('scholaragreementForm');
            var thisFormData = new FormData(document.getElementById('scholaragreementForm'));
            axios.post('/setscholaragreement', thisFormData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    // console.log('Form submitted successfully:', response.data);
                    Form.reset();
                    if (response.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.data.error,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Scholarship Agreement Uploaded!',
                        });
                        callcheckrequirements();
                    }
                })
                .catch(function(error) {
                    console.error('Error submitting form:', error);

                });
        }
    </script>
@endsection
