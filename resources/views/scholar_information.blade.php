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

    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="">
                    <div class="text-center">
                        <h2 class="mt-1 mb-1">{{ $seisourcerecord->lname }}, {{ $seisourcerecord->fname }}</h2>

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
    </div>
    <div class=" mt-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @livewire('scholar-requirements', ['scholarId' => $seisourcerecord->id])
                        {{--  @include('partials.scholar_information.scholar_requirements') --}}

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
    </div>

    @if (count($cogpassed) > 0)
        @include('partials.scholar_information.scholar_cor_cog')
    @endif

    @if (count($thesispassed) > 0)
        @include('partials.scholar_information.scholar_thesis')
    @endif



@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        window.addEventListener('load', function() {
            var scrollPosition = sessionStorage.getItem('scrollPosition');
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                sessionStorage.removeItem('scrollPosition');
            }
        });

        function submityesaccform(decision) {
            const scholarId = document.getElementById('scholar_id').value;
            axios.post('{{ route('verifyaccnumber') }}', {
                    decisionacc: decision,
                    scholar_id: scholarId
                })
                .then((response) => {
                    Swal.fire({
                        title: 'Account number approved!',
                        text: '',
                        icon: 'success',
                        confirmButtonText: 'Okay'
                    })
                })
                .catch((error) => {
                    console.error(error);
                    // Optionally handle error response
                });
        }

        function submitnoaccform(decision) {
            const scholarId = document.getElementById('scholar_id').value;
            const remarks = document.getElementById('remarks').value;

            axios.post('{{ route('verifyaccnumber') }}', {
                    decisionacc: decision,
                    scholar_id: scholarId,
                    remarks: remarks
                })
                .then((response) => {
                    console.log(response.data);

                    // Optionally handle success response
                })
                .catch((error) => {
                    console.error(error);
                    // Optionally handle error response
                });
        }
    </script>
@endsection
