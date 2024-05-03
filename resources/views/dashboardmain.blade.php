@extends('layouts.app')
@section('styles')
    <style>

    </style>
@endsection


@section('mainoptions')
    @include('layouts.headernew') {{-- HEADER START --}}
    @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
@endsection

@section('content')
    <div class="row gx-2">
        <div class="col-1">
            <div style="max-width: 55px" class="card">
                {{-- FILTER ALL BUTTON --}}
                <a type="button" style="padding:2px" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-filter"></i>
                </a>
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
                <h5 class="card" style="max-width: 200px; padding:7px;">{{ $startYear }} to {{ $endYear }}</h5>
            @endif
        </div>
    </div>

    {{-- PROGRAM CHART SECTION --}}
    <div class="row gx-2">
        <div class="col-sm-6 programcard">
            <div class="card">
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
    </div>
@endsection


@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontaws.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.min.js" integrity="sha512-2uu1jrAmW1A+SMwih5DAPqzFS2PI+OPw79OVLS4NJ6jGHQ/GmIVDDlWwz4KLO8DnoUmYdU8hTtFcp8je6zxbCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>

    <script type="text/javascript">
        Chart.register(ChartDataLabels);
    </script>
@endsection
