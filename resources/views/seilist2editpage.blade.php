<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .nobordertable {
            border-collapse: collapse !important;
            border: none !important;
            border-color: none;
        }

        tbody {
            border: none;
        }

        tr {
            vertical-align: middle;
        }
    </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}



        <div class="main">
            @include('layouts.header')

            <main style="padding: 0.5rem 0.5rem 0.5rem 0.5rem" class="content">
                <div class="container-fluid p-0">


                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header">

                                <h5 class="card-title mb-0">{{ $scholar->lname }}, {{ $scholar->fname }} </h5>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('sei.saveedit') }}">
                                    @csrf
                                    <table class="table table-sm mt-1 mb-1">
                                        <tbody>
                                            <tr>
                                                <th hidden>ID:</th>
                                                <td hidden> <input class="form-control" type="text" name="sei_id"
                                                        value="{{ $sei->id }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Firstname:</th>
                                                <td> <input class="form-control" type="text" name="schol_fname"
                                                        value="{{ $scholar->fname }}">
                                                </td>
                                                <th>MiddleName:</th>
                                                <td><input class="form-control" type="text" name="schol_mname"
                                                        value="{{ $scholar->mname }}"></td>
                                            </tr>
                                            <tr>
                                                <th>Lastname:</th>
                                                <td><input class="form-control" type="text" name="schol_lname"
                                                        value="{{ $scholar->lname }}">
                                                </td>
                                                <th>Suffix:</th>
                                                <td>
                                                    <input class="form-control" type="text" name="schol_suffix"
                                                        value="{{ $scholar->suffix }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td><input class="form-control" type="text" name="schol_email"
                                                        value="{{ $scholar->email }}"></td>
                                                <th>Mobile:</th>
                                                <td><input class="form-control" type="text" name="schol_mobile"
                                                        value="{{ $scholar->mobile }}"></td>
                                            </tr>
                                            <tr>
                                                <th>Birthdate:</th>
                                                <td><input class="form-control" type="text" name="schol_bday"
                                                        value="{{ $scholar->bday }}"></td>
                                                <th>Strand:</th>
                                                <td><input class="form-control" type="text" name="sei_strand"
                                                        value="{{ $sei->strand }}"></td>
                                            </tr>
                                            <tr>
                                                <th>Status: <span style="color: blue">
                                                        @if ($scholar->scholar_status_id == 0)
                                                            Lacking
                                                        @elseif ($scholar->scholar_status_id == 1)
                                                            Pending
                                                        @elseif ($scholar->scholar_status_id == 2)
                                                            Ongoing
                                                        @elseif ($scholar->scholar_status_id == 3)
                                                            Enrolled
                                                        @elseif ($scholar->scholar_status_id == 4)
                                                            Deferred
                                                        @elseif ($scholar->scholar_status_id == 5)
                                                            LOA
                                                        @else
                                                            Terminated
                                                        @endif
                                                    </span>
                                                </th>
                                                <td style="vertical-align: middle;">
                                                    <select name="scholar_status_id" style="max-width:100px;"
                                                        class="form-control col-md-auto">
                                                        @foreach ($status as $status1)
                                                            <option value="{{ $status1->id }}">
                                                                {{ $status1->status_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th>Gender: <span style="color: blue">
                                                        @if ($scholar->gender_id == 1)
                                                            F
                                                        @else
                                                            M
                                                        @endif
                                                        <span>
                                                </th>
                                                <td style="vertical-align: middle;">
                                                    <select name="sei_gender_id" style="max-width:100px;"
                                                        class="form-control mb-0">
                                                        @foreach ($gender as $gender1)
                                                            <option value="{{ $gender1->id }}">
                                                                {{ $gender1->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Program: <span style="color: blue">
                                                        @if ($sei->program_id == 101)
                                                            RA 7687
                                                        @elseif ($sei->program_id == 201)
                                                            MERIT
                                                        @elseif ($sei->program_id == 301)
                                                            RA 10612
                                                        @endif
                                                        <span></th>

                                                <td style="vertical-align: middle;">
                                                    <select name="sei_program_id" style="max-width:100px;"
                                                        class="form-control mb-0">
                                                        @foreach ($program as $program1)
                                                            <option value="{{ $program1->id }}">
                                                                {{ $program1->progname }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <th>Municipality:</th>
                                                <td><input class="form-control" type="text" name="sei_municipality"
                                                        value="{{ $sei->municipality }}"></td>
                                            </tr>
                                            <tr>
                                                <th>Province:</th>
                                                <td><input class="form-control" type="text" name="sei_province"
                                                        value="{{ $sei->province }}"></td>
                                                <th>Zipcode</th>
                                                <td><input class="form-control" type="text" name="sei_zipcode"
                                                        value="{{ $sei->zipcode }}"></td>
                                            </tr>
                                            <tr>
                                                <th>Barangay:</th>
                                                <td><input class="form-control" type="text" name="sei_barangay"
                                                        value="{{ $sei->barangay }}"></td>
                                                <th>House No:</th>
                                                <td><input class="form-control" type="text" name="sei_houseno"
                                                        value="{{ $sei->houseno }}"></td>
                                            </tr>
                                            <tr>
                                                <th>Street:</th>
                                                <td><input class="form-control" type="text" name="sei_street"
                                                        value="{{ $sei->street }}"></td>
                                                <th>Region:</th>
                                                <td><input class="form-control" type="text" name="sei_region"
                                                        value="{{ $sei->region }}"></td>

                                            </tr>
                                            <tr>
                                                <th>HS Name:</th>
                                                <td colspan="4"><input style="max-width: 1000px !important;"
                                                        class="form-control" type="text" name="sei_hsname"
                                                        value="{{ $sei->hsname }} ">
                                                </td>

                                            </tr>
                                            <tr>
                                                <th>Remarks:</th>
                                                <td colspan="4">
                                                    <textarea class="form-control" type="text" name="sei_remarks">{{ $sei->remarks }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Lacking:</th>
                                                <td colspan="4"><input class="form-control" type="text"
                                                        name="sei_lacking" value="{{ $sei->lacking }}"></td>


                                            </tr>
                                            <tr>
                                                <th>District:</th>
                                                <td><input class="form-control" type="text" name="sei_district"
                                                        value="{{ $sei->district }}"></td>

                                            </tr>

                                        </tbody>
                                    </table>

                                    <button class="btn btn-primary" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </main>
        </div>
    </div>
</body>
{{-- SIDEBAR TOGGLING --}}
<script></script>

</html>
