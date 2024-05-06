@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('approved'))
        <script>
            let successmessage = "{{ session('approved') }}";
            Swal.fire({
                iconHtml: '<img src="/extraicons/approval.gif" style="width: 150px; height: 150px;">',
                title: successmessage,
                text: "",
            });
        </script>
    @elseif (session('success'))
        <script>
            let successmessage = "{{ session('disapproved') }}";
            Swal.fire({
                iconHtml: '<img src="/extraicons/warning.gif" style="width: 150px; height: 150px;">',
                title: successmessage,
                text: "",
            });
        </script>
    @elseif (session('disapproved'))
        <script>
            let successmessage = "{{ session('disapproved') }}";
            Swal.fire({
                iconHtml: '<img src="/extraicons/warning.gif" style="width: 150px; height: 150px;">',
                title: successmessage,
                text: "",
            });
        </script>
    @endif

    {{-- MASYADO MAHABA PREFERABLY LIVEWIRE/VUE --}}
    <div class="card">
        <div class="row ">
            <div class="col-lg-12">
                <div class="">
                    <div class="text-center">
                        <h2 class="mt-5 mb-0">{{ $seisourcerecord->lname }}, {{ $seisourcerecord->fname }}</h2>

                        @php
                            $scholarStatusId = \App\Models\Sei::where('id', $seisourcerecord->id)->value('scholar_status_id');
                        @endphp
                        @switch($scholarStatusId)
                            @case(1)
                                <div class="mb-2 badge bg-secondary  my-2">Pending</div>
                            @break

                            @case(2)
                                <div class="mb-2 badge bg-primary  my-2">Ongoing</div>
                            @break

                            @case(3)
                                <div class="mb-2 badge bg-success  my-2">Enrolled</div>
                            @break

                            @case(4)
                                <div class="mb-2 badge bg-warning  my-2">Deffered</div>
                            @break

                            @case(5)
                                <div class="mb-2 badge bg-warning  my-2">LOA</div>
                            @break

                            @case(6)
                                <div class="mb-2 badge bg-danger  my-2">Terminated</div>
                            @break

                            @default
                                None
                        @endswitch
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body mt-2">
            <div class="row">
                <div class="table-responsive">
                    <div class="col-lg-2">

                        @include('partials.scholar_information.scholar_requirements')

                        @if (session('success'))
                            <script>
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'The scholar now have access to the system!',
                                    icon: 'success',
                                    confirmButtonText: 'Okay'
                                })
                            </script>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @if (count($cogpassed) > 0)
            @include('partials.scholar_information.scholar_cor_cog')
        @endif

        @if (count($thesispassed) > 0)
            @include('partials.scholar_information.scholar_thesis')
        @endif


    </div>
@endsection



{{-- <!-- Modal REQUIREMENTS -->
<div class="modal fade common-modal" id="viewRequirementsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div id="thisdivtitlereq"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed class="modal-iframe" id="ifrmreq" src="#" type="application/pdf" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>

<!-- Modal  COG-->
<div class="modal fade common-modal" id="viewCogsModal" tabindex="-1" aria-labelledby="exampleModalCog" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div id="thisdivtitlecog">COG Details</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed class="modal-iframe" id="ifrmcog" src="#" type="application/pdf" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>


<!-- Modal  COR-->
<div class="modal fade common-modal" id="viewCorModal" tabindex="-1" aria-labelledby="exampleModalCor" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div id="thisdivtitlecor">COR Details</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed class="modal-iframe" id="ifrmcor" src="#" type="application/pdf" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>

<!-- Modal  THESIS-->
<div class="modal fade common-modal" id="viewThesisModal" tabindex="-1" aria-labelledby="exampleModalThesis" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <div id="thisdivtitlecor">Thesis Details</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <embed class="modal-iframe" id="ifrmthesis" src="#" type="application/pdf" width="100%" height="100%">
            </div>
        </div>
    </div>
</div> --}}

</main>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/fontaws.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>



<script>
    function submitFormverify(action) {
        document.getElementById('scholarprocess').value = action;
        document.getElementById('formverify').submit();
    }

    document.querySelectorAll('.thisisbutton').forEach(function(element) {
        element.addEventListener('click', function() {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    });


    // After page reload, check if there's a stored scroll position and scroll to it
    window.addEventListener('load', function() {
        var scrollPosition = sessionStorage.getItem('scrollPosition');
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
            sessionStorage.removeItem('scrollPosition');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {



        $('.common-modal').on('hidden.bs.modal', function() {
            var modal = $(this);
            $('#viewRequirementsModal #thisdivtitlereq').empty();
            $(this).find('embed').attr('src', '');

        });

        //FOR SCHOLARSHIP ICON
        $(document).on('click', '.viewreqsholarship', function() {
            var number = $(this).data('id');

            let modal = new bootstrap.Modal('#viewRequirementsModal');
            modal.show()
            $.ajax({
                url: '{{ url('/requirements_view/') }}' + '/' + number,
                method: 'GET',
                success: function(data) {
                    var filePath = '/' + data.scholarshipagreement;
                    $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Scholarship Agreement</strong></h3');
                    $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath);
                },
                error: function(error) {
                    console.error('Error fetching data for editing:', error);
                }
            });
        });

        //FOR INFORMARTIONSHEET
        $(document).on('click', '.viewreqinformation', function() {
            var number = $(this).data('id');
            let modal = new bootstrap.Modal('#viewRequirementsModal');
            modal.show()
            $.ajax({
                url: '{{ url('/requirements_view/') }}' + '/' + number,
                method: 'GET',

                success: function(data) {
                    /*    console.log(data); */
                    var filePath1 = '/' + data.informationsheet;
                    $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Information Sheet</strong></h1>');
                    $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath1);
                },
                error: function(error) {
                    console.error('Error fetching data for editing:', error);
                }
            });
        });


        //FOR Scholar's Oath
        $(document).on('click', '.viewreqoath', function() {
            var number = $(this).data('id');
            let modal = new bootstrap.Modal('#viewRequirementsModal');
            modal.show()
            $.ajax({
                url: '{{ url('/requirements_view/') }}' + '/' + number,
                method: 'GET',

                success: function(data) {
                    /*    console.log(data); */
                    var filePath2 = '/' + data.scholaroath;
                    $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Scholar Oath</strong></h3>');
                    $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath2);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        $(document).on('click', '.viewreqprospectus', function() {
            var number = $(this).data('id');
            let modal = new bootstrap.Modal('#viewRequirementsModal');
            modal.show()
            $.ajax({
                url: '{{ url('/requirements_view/') }}' + '/' + number,
                method: 'GET',

                success: function(data) {
                    /*    console.log(data); */
                    var filePath3 = '/' + data.scholaroath;
                    $('#viewRequirementsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>');
                    $('#viewRequirementsModal #ifrmreq').attr('src', '{{ url('/') }}' + filePath3);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });


        $(document).on('click', '.viewcog', function() {
            var number = $(this).data('cogid');
            let modal = new bootstrap.Modal('#viewCogsModal');
            modal.show()
            $.ajax({
                url: '{{ url('/scholarcog/') }}' + '/' + number,
                method: 'GET',

                success: function(data) {
                    var filePathcog = '/' + data.cog_name;
                    /*    $('#viewCogsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>'); */
                    $('#viewCogsModal #ifrmcog').attr('src', '{{ url('/') }}' + filePathcog);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }); //END COG MODAL


        $(document).on('click', '.viewcor', function() {
            var number = $(this).data('corid');
            let modal = new bootstrap.Modal('#viewCorModal');
            modal.show()
            $.ajax({
                url: '{{ url('/scholarcog/') }}' + '/' + number,
                method: 'GET',

                success: function(data) {
                    var filePathcog = '/' + data.cor_name;
                    /*    $('#viewCogsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>'); */
                    $('#viewCorModal #ifrmcor').attr('src', '{{ url('/') }}' + filePathcog);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }); //END COR MODAL

        $(document).on('click', '.viewthesis', function() {
            var number = $(this).data('thesisid');
            let modal = new bootstrap.Modal('#viewThesisModal');
            modal.show()
            $.ajax({
                url: '{{ url('/scholarthesis/') }}' + '/' + number,
                method: 'GET',

                success: function(data) {
                    var filePaththesis = '/' + data.thesis_details;

                    /*    $('#viewCogsModal #thisdivtitlereq').append('<h3 class="modal-title" id="exampleModalLabel"><strong>Prospectus</h3>'); */
                    $('#viewThesisModal #ifrmthesis').attr('src', '{{ url('/') }}' + filePaththesis);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }); //END THESIS MODAL

        /*   $(document).on('click', '#cogcorapprove', function() {
              var number = $(this).data('cogid');
              var url = '{{ url('/approvecogcor/') }}' + '/' + number;
              window.location.href = url;
          }); */

    });
</script>

</html>
