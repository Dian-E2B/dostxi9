<style>
    li:hover .nav-link box-icon:not(.bi-chevron-down) {
        animation: tada 1s;
        animation-iteration-count: infinite;
    }


    .sidebar {
        background-color: #ffffff;
    }

    .sidebar-nav .nav-link {
        color: #3c4244;
    }

    .sidebar-nav .nav-content a {
        color: #050505;
    }

    .sidebar-nav .nav-link.collapsed {
        color: #000000;
        background: #b8c0c3;
    }
</style>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <div style="color: rgb(17, 13, 13); font-weight: 900">
                @php
                    $scholarinfo = DB::select('SELECT fname, lname FROM seis WHERE id = ?', [auth()->user()->scholar_id]);
                @endphp
                @if (!empty($scholarinfo))
                    @foreach ($scholarinfo as $info)
                        <div class="d-flex justify-content-center mt-3" style="">
                            <div style="">{{ $info->fname }} {{ $info->lname }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
            @php
                $scholarstatusidresult = DB::select('SELECT scholar_status_id FROM seis WHERE id = ?', [auth()->user()->scholar_id]);
                $statusExists = isset($scholarstatusidresult[0]);
            @endphp
            <div class="sidebar-user-subtitle d-flex justify-content-center mt-3" style="font-size: 20px">
                @if ($statusExists)
                    @switch($scholarstatusidresult[0]->scholar_status_id)
                        @case(2)
                            <span class="badge bg-info">Ongoing</span>
                        @break

                        @case(3)
                            <span class="badge bg-success">Enrolled</span>
                        @break

                        @case(4)
                            <span class="badge bg-warning">Deffered</span>
                        @break

                        @case(5)
                            <span class="badge bg-warning">LOA</span>
                        @break

                        @case(6)
                            <span class="badge bg-danger">Terminated</span>
                        @break
                    @endswitch
                @endif
            </div>
        </li><!-- End Dashboard Nav -->
        <br>
        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link {{ request()->is('student/profile') ? '' : 'collapsed' }}" href='{{ route('student.profile') }}'>
                <span style="padding: 0em 1em 0em 0em;"><i style="font-size:20px;" class="fas animate fa-chart-bar"></i></span>
                <div class="">Main</div>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item ">
            <a class="nav-link  {{ request()->is('student/gradeinput') || request()->is('student/thesis') ? '' : 'collapsed' }}" data-bs-target="#sei-nav" data-bs-toggle="collapse" href="#">
                <span style="padding: 0em 1em 0em 0em;"><i style="font-size:20px;" class="fas animate fa-upload"></i></span>
                <span style="">Submit Requirements</span>
                <i class="fas fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="sei-nav" class="nav-content collapse {{ request()->is('student/gradeinput') || request()->is('student/thesis') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li class="align-text-center align-items-center">
                    <a href='{{ route('student/gradeinput') }}' class="{{ request()->is('student/gradeinput') ? 'active' : '' }}">
                        <span style="padding: 0em 0em 0em 0em;"><i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i><span>&nbsp;Periodic</span></span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('student/thesis') }}' class="{{ request()->is('student/thesis') ? 'active' : '' }}">
                        <span style="padding: 0em 0em 0rem 0rem;"><i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i><span>&nbsp;Thesis</span></span>
                    </a>
                </li>
            </ul>
        </li><!-- End SEI Nav -->


    </ul>

</aside><!-- End Sidebar-->

{{-- <nav id="sidebar" class="sidebar js-sidebar">

    <div class="sidebar-content js-simplebar">


        <div class="row">
            <span style="margin-top:10px;" class="sidebar-brand-text d-flex justify-content-center">
                <img style="max-width: 90px; max-height: 90px;" id="sidebarimagelogo" src="{{ asset('icons/DOST_scholar_logo.svg') }}" alt="Image Description">
            </span>
            @php
                $scholarinfo = DB::select('SELECT fname, lname FROM seis WHERE id = ?', [auth()->user()->scholar_id]);
            @endphp
            @if (!empty($scholarinfo))
                @foreach ($scholarinfo as $info)
                    <div class="d-flex justify-content-center mt-3" style="">
                        <div style="font-weight:600; color: rgb(43, 41, 41)">{{ $info->fname }} {{ $info->lname }}</div>
                    </div>
                @endforeach
            @endif
        </div>




        <div class="d-flex justify-content-center mt-2">

            @php
                $scholarstatusidresult = DB::select('SELECT scholar_status_id FROM seis WHERE id = ?', [auth()->user()->scholar_id]);
                $statusExists = isset($scholarstatusidresult[0]);
            @endphp
            <div class="sidebar-user-subtitle" style="font-size: 20px">
                @if ($statusExists)
                    @switch($scholarstatusidresult[0]->scholar_status_id)
                        @case(2)
                            <span class="badge bg-info">Ongoing</span>
                        @break

                        @case(3)
                            <span class="badge bg-success">Enrolled</span>
                        @break

                        @case(4)
                            <span class="badge bg-warning">Deffered</span>
                        @break

                        @case(5)
                            <span class="badge bg-warning">LOA</span>
                        @break

                        @case(6)
                            <span class="badge bg-danger">Terminated</span>
                        @break
                    @endswitch
                @endif
            </div>


        </div>


        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ request()->is('student/profile') ? 'active' : '' }} ">
                <a class='sidebar-link' href='{{ route('student.profile') }}'>
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('student/dashboard') ? 'active' : '' }}">
                <a class='sidebar-link' href='{{ route('student.dashboard') }}'>
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>


            <li class="sidebar-item {{ request()->is('student/gradeinput') ? 'active' : '' }}">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Submit</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item active"><a class='sidebar-link' href='{{ route('student/gradeinput') }}'>Periodic</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href=''>Thesis</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href=''>PTP </a></li>
                </ul>
            </li>


    </div>
</nav> --}}
