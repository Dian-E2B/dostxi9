@extends('layouts.app')

@section('styles')
    <style class="">
        .table> :not(caption)>*>* {
            font-size: 0.9rem;
            padding: 0.2rem 0.2rem !important;
        }

        /*
                                    .btn {
                                        padding: 0.2rem 0.2rem !important;
                                    } */

        input {
            padding: 0.2rem 0.2rem !important;
        }

        .form-select {
            /*   padding: 0.2rem 1rem 0.2rem 1rem; */
        }

        label {
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mt-3 ">
                <div class="row">
                    <div class="col">
                        <div class="h4 mb-1" style="">Ongoing Endorsed List</div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3 mt-1">
                                    <div class="col-sm">
                                        <select class="form-control form-control-sm" name="year" id="year" class="" style="width: 100%;">
                                            <option value="">--Year--</option>
                                            <!-- Generate options for the current year to the next 10 years -->
                                            @php
                                                $currentYear = date('Y');
                                                $endYear = $currentYear + 10;
                                            @endphp
                                            @for ($year = $currentYear; $year <= $endYear; $year++)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-sm">
                                        <select class="form-control form-control-sm" style="margin:none;" name="semester" id="semester" style="width: 100%;">
                                            <option value="">--Semester--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="0">Summer</option>
                                        </select>
                                    </div>
                                    <div class="col-sm" style="">
                                        <button class="btn btn-light print-button btn-sm" style="padding: 2px 12px; width: 100%;"><i class="bi bi-printer-fill"></i></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

                {{--    <div class="row mb-4">
                    <div class="dropdown" style="user-select: none">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-funnel-fill"></i>
                        </button>
                        <ul class="dropdown-menu" style="padding: 10px">
                            <form id="endorseyearform">
                                <div class="mb-2">
                                    <select id="selectyear" name="selectyear" class="form-control form-control-sm">
                                        <option value="">Year</option>
                                        <?php
                                        // $currentYear = date('Y');
                                        // for ($i = 0; $i <= 10; $i++) {
                                        //     $year = $currentYear - $i;
                                        //     echo "<option value=\"$year\">$year</option>";
                                        // }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <select name="selectsemester" id="selectsemester" class="form-control form-control-sm">
                                        <option value="">Semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">Summer</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" id="submitfilter" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i></button>
                                </div>
                            </form>
                        </ul>
                    </div>
                </div> --}}

                <div class="row ">
                    <div class="col" style="user-select: none;">
                        @livewire('all-endorsed-view')
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection



@section('scripts')
@endsection
