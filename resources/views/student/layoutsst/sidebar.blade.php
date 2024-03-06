<style>
    #sidebarimagelogo {
        filter: drop-shadow(-1px -2px 10px rgba(73, 196, 211, 0.9));
    }
</style>
<nav id="sidebar" class="sidebar js-sidebar">

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
</nav>
