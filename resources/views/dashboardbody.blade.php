<div class="row gx-2">
    <div class="col-1">
        <div style="max-width: 55px" class="card">
            {{-- <div class="" style="display: flex; align-items: start; "> --}} {{-- FILTER ALL BUTTON --}}
            <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-filter"></i>
            </button>
            <div class="dropdown-menu ">
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
                {{--   </div> --}}
            </div>

        </div>

    </div>
    <div class="col-6">
        @if ($startYear)
            <h5 class="card" style="max-width: 200px;">{{ $startYear }} to {{ $endYear }}</h5>
        @endif
    </div>
</div>

{{-- PROGRAM CHART SECTION --}}
<div class="row gx-2">
    <div class="col-sm-6 programcard">
        <div class="card">
            <div class="" style="display: flex; align-items: start; "> {{-- FILTER BUTTON --}}
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-filter"></i>
                </button>
                <div class="dropdown-menu ">
                    <div style="display: flex; max-width: 3.8cm; margin: auto;">
                        <form id="programyearform" action="{{ route('getprogramchartyearfilter') }}">
                            @csrf
                            <div class="row g-2 selectportion">
                                <div class="col">
                                    <select name="startyear" class="form-select">
                                        @foreach ($uniqueYears as $uyear)
                                            <option value="{{ $uyear }}">
                                                {{ $uyear }}-{{ $uyear + 1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <select name="endyear" class="form-select">
                                        @foreach ($uniqueYears as $uyear)
                                            <option value="{{ $uyear }}">
                                                {{ $uyear }}-{{ $uyear + 1 }}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <span style="padding: 10px;">
                                <button class="btn" type="submit">Filter</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mt-2" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                        <h4><strong>
                                Programs
                            </strong></h4>
                        <p>This chart displays the number of scholarships awarded each year for different
                            programs.</p>
                    </div>
                </div>
                <div class="col-6">{{-- Program Portion --}}
                    <div id="programportioncounter-container" class="card programportioncard w-100 p-1" style="">
                        <canvas id="myPieChart" width="" style="height: 90px;"></canvas>
                    </div>
                </div>
            </div>

            {{-- PROGRAM CHART CANVAS --}}
            <div>
                <canvas style="margin-left: 10px;" id="myProgramChart" width="" height="150"></canvas>
            </div>
        </div>
    </div>

    {{-- GENDER CHART SECTION --}}
    <div class="col-sm-6 gendercard">
        <div class="card gendercard">
            <div class="" style="display: flex; align-items: start; "> {{-- FILTER BUTTON --}}
                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-filter"></i>
                </button>
                <div class="dropdown-menu ">
                    <div style="display: flex; max-width: 3.8cm; margin: auto;">
                        <form id="genderyearform" action="{{ route('getgenderchartyearfilter') }}">
                            @csrf
                            <div class="row g-2 selectportion">
                                <div class="col">
                                    <select name="startyeargender" class="form-select">
                                        @foreach ($uniqueYears as $uyear)
                                            <option value="{{ $uyear }}">
                                                {{ $uyear }}-{{ $uyear + 1 }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-100"></div>
                                <div class="col">
                                    <select name="endyeargender" class="form-select">
                                        @foreach ($uniqueYears as $uyear)
                                            <option value="{{ $uyear }}">
                                                {{ $uyear }}-{{ $uyear + 1 }}
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <span style="padding: 10px;">
                                <button class="btn" type="submit">Filter</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
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
            <canvas style="" id="myCoursesChart" width="" height="350"></canvas>
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
