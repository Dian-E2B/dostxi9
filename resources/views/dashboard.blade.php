@extends('layouts.app')
@section('styles')
    <style>
        #programportioncounter td {
            vertical-align: middle !important;
        }

        .portionicon {
            padding: 1px;
            margin-right: 5px;
            font-size: 12pt;
        }

        #programportioncounter-body {
            font-size: 17px;
        }

        .card {
            padding: 2%;
            margin-top: 6px !important;
            margin-bottom: 6px !important;
        }

        .gendercard,
        .programcard {
            margin-botom: 0% !important;
        }

        .coursecard {
            margin-top: 0% !important;
        }


        .programportioncard,
        .genderportioncard {
            box-shadow: 1px 2px 5px 4px rgb(214, 214, 214);
        }
    </style>
@endsection


@section('mainoptions')
@endsection

@section('content')
    <div class="row gx-2">
        <div class="col-1">
            <div style="max-width: 55px" class="card">
                {{-- FILTER ALL BUTTON --}}
                <a type="button" style="padding:2px" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-funnel-fill"></i>
                </a>
                {{--  <div class="dropdown-menu ">
                    <div style="display: flex; max-width: 3.9cm; margin: auto;">
                        <form id="allfilterform" method="post" action="{{ route('getallyearfilter') }}">
                            @csrf
                            <div class="row g-2 selectportion">
                                <div class="col">
                                    <select name="startyear" class="form-select">
                                        @foreach (range(2020, date('Y')) as $uyear)
                                            <option value="{{ $uyear }}">
                                                {{ $uyear }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <select name="endyear" class="form-select">
                                        @foreach (range(2020, date('Y')) as $uyear)
                                            <option value="{{ $uyear }}">
                                                {{ $uyear }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <span style="padding: 10px;">
                                <button class="btn" type="submit">Filter</button>
                            </span>
                        </form>
                    </div>

                </div> --}}

            </div>

        </div>
        {{--  <div class="col-6">
            @if ($startYear)
                <h5 class="card" style="max-width: 200px; padding:7px;">{{ $startYear }} to {{ $endYear }}</h5>
            @endif
        </div> --}}
    </div>

    {{-- PROGRAM CHART SECTION --}}
    <div class="row gx-2">
        <div class="col-sm-6 programcard">
            <div class="card">

                <div class="mt-2" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                    <h4><strong>
                            Ongoing
                        </strong></h4>
                    <p>This chart illustrates the number of ongoing scholars each program recorded over a five-year period.</p>
                </div>

                {{-- PROGRAM CHART CANVAS --}}
                <div>
                    <canvas style="margin-left: 10px;" id="1" width="" height="150"></canvas>
                </div>
            </div>
        </div>

        {{-- GENDER CHART SECTION --}}
        <div class="col-sm-6 gendercard">
            <div class="card gendercard">
                <div class="row">
                    <div class="col-6">
                        <div class="" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                            <h4 class="mt-2"><strong> Gender</strong> </h4>
                            <p>This chart displays the number of scholarships awarded each year for different
                                genders.</p>
                        </div>
                    </div>
                    <div class="col-6">{{-- Gender Portion --}}
                        <div class="card genderportioncard w-100 p-1" style="">
                            <canvas id="myGenderPie" width=""style="height: 90px;"></canvas>
                        </div>
                    </div>
                </div>
                <div>
                    <canvas style="margin-left: 10px;" id="myGenderChart" width="" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-0">
        <div class="col-lg-12">
            <div class="card" style="margin-top: 0px !important;">
                <h4> <strong>
                        Courses
                    </strong></h4>
                <p>This chart illustrates the number of ongoing scholars each program recorded over a five-year period.</p>
                <canvas id="programschartline" style="height: 250px !important;"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="col">
                    <div class="" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                        <h4> <strong>
                                Provinces
                            </strong></h4>
                        <p>This chart displays the number of scholarships availing for each provinces.</p>
                    </div>
                </div>
                <div class="col">
                    <canvas style="" id="myProvincesChart" width="" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="col">
                    <div class="" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                        <h4> <strong>
                                Enrollees
                            </strong></h4>
                        <p>This chart displays the number of students status for each availing scholars.</p>
                    </div>
                </div>
                <div class="col">
                    <canvas style="" id="myMovementChart" width="500" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="col">
                    <div class=""> {{-- DESCRIPTION --}}
                        <h4><strong>
                                Schools
                            </strong></h4>
                        <p>This chart displays the number of students availing for each schools.</p>
                    </div>
                </div>
                <div class="col">
                    <canvas style="" id="mySchoolChart" width="500" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.min.js" integrity="sha512-2uu1jrAmW1A+SMwih5DAPqzFS2PI+OPw79OVLS4NJ6jGHQ/GmIVDDlWwz4KLO8DnoUmYdU8hTtFcp8je6zxbCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>

    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection
