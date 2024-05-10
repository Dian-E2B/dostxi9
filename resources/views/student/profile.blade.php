@extends('student.layoutsst.app')

@section('styles')
    <style>
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        button {
            border: none;
            padding: none !important;
        }
    </style>
@endsection
@section('content')

    {{-- VERIFIED/ACCEPTED REQUIREMENTS --}}


    @include('student.layoutsst.sidebar')
    @include('student.layoutsst.header')
    <div class="card">
        <div class="card-body">
            <div class="container-fluid p-0">
                <label>
                    <input style="display: none;" value="{{ $scholarId }}">
                </label>
                @if ($scholarstatusid == 3 || $scholarstatusid == 2)
                    <div class="col-md-6 col-lg-12">
                        <div class="">
                            <div class="card-body">
                                <h1 style="margin: auto; text-align: center">
                                    <p style="font-weight:900 ">{{ $scholarfullinfo->fname }} {{ $scholarfullinfo->mname }} {{ $scholarfullinfo->lname }}</p>
                                </h1>
                                <div class="row">

                                    <div class="col-12">
                                        <table class="table table-bordered table-striped">

                                            <tr>
                                                <th>
                                                    <span style="color: rgb(92, 92, 92)">Program:</span>
                                                </th>

                                                <td>
                                                    <span style="font-weight:900 "> @switch($scholarfullinfo->program_id)
                                                            @case(101)
                                                                RA 7687
                                                            @break

                                                            @case(201)
                                                                MERIT
                                                            @break

                                                            @case(301)
                                                                RA 106
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <span style="color: rgb(92, 92, 92)">Address:</span>
                                                </th>
                                                <td>
                                                    <span style="font-weight:900 "> {{ $scholarfullinfo->barangay }}, {{ $scholarfullinfo->province }}, {{ $scholarfullinfo->municipality }}, {{ $scholarfullinfo->zipcode }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <span style="color: rgb(92, 92, 92)">Gender:</span>
                                                </th>
                                                <td>
                                                    <span style="color: rgb(92, 92, 92); font-weight: 900">
                                                        @if ($scholarfullinfo->gender_id == 1)
                                                            Female
                                                        @else
                                                            Male
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>

                                            <form action="{{ route('editschoolcourse') }}" method="POST">
                                                @csrf
                                                <tr>
                                                    <th>
                                                        <span style="color: rgb(92, 92, 92)">Mobile:</span>
                                                    </th>
                                                    <td>
                                                        <input type="text" name="mobile" class="editable-input form-control" disabled value=" {{ $scholarfullinfo->mobile }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <span style="color: rgb(92, 92, 92)">Email:</span>
                                                    </th>
                                                    <td>
                                                        <input type="text" name="email" class="editable-input form-control" disabled value=" {{ $scholarfullinfo->email }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style=>
                                                        <span style="color: rgb(92, 92, 92)">School:</span>
                                                    </th>
                                                    <td>
                                                        <span style="color: rgb(92, 92, 92); font-weight: 900">
                                                            <input type="text" name="school" class="editable-input form-control" disabled value=" {{ $scholarfullinfo->school }}">
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <span style="color: rgb(92, 92, 92)">Course:</span>
                                                    </th>
                                                    <td>
                                                        <span style="color: rgb(92, 92, 92); font-weight: 900">
                                                            <input type="text" name="course" class="editable-input form-control" disabled value="{{ $scholarfullinfo->course }}">
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">
                                                        <button type="button" id="editscholarcourseButton" data-bs-toggle="tooltip" data-bs-title="Edit" class="btn btn-sm" style="background-color: #c0c0c0"><i class="fas fa-edit fa-lg" style="color: #2e2e2e;"></i></button>
                                                        <button type="button" id="canceleditscholarcourseButton" data-bs-toggle="tooltip" data-bs-title="Cancel" class=" btn btn-sm d-none" style="background-color: #ec9107"><i class="fas fa-lg fa-window-close" style="color: #2e2e2e;"></i></button>
                                                        <button type="submit" id="submitscholarcourseButton" data-bs-toggle="tooltip" data-bs-title="Submit" class="btn btn-sm d-none btn-success"><i class="fad fa-lg fa-save"></i></button>
                                                    </th>
                                                </tr>
                                            </form>
                                        </table>
                                    </div>
                                    <div class="col-6">

                                        {{--  @dd($scholarfullname) --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        document.getElementById('editscholarcourseButton').addEventListener('click', function() {
            document.querySelectorAll('.editable-input').forEach(function(input) {
                input.removeAttribute('disabled');
            });
            document.getElementById('canceleditscholarcourseButton').classList.remove('d-none');
            document.getElementById('submitscholarcourseButton').classList.remove('d-none');
        });

        document.getElementById('canceleditscholarcourseButton').addEventListener('click', function() {

            document.querySelectorAll('.editable-input').forEach(function(input) {
                input.setAttribute('disabled', 'disabled');
            });
            document.getElementById('canceleditscholarcourseButton').classList.add('d-none');
            document.getElementById('submitscholarcourseButton').classList.add('d-none');
        });
    </script>
@endsection
