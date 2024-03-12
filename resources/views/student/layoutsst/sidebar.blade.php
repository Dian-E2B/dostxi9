<style>
    li:hover .nav-link box-icon:not(.bi-chevron-down) {
        animation: tada 1s;
        animation-iteration-count: infinite;

    }

    box-icon:hover {
        fill: black;
        color: black;
    }

    .sublist {
        margin-bottom: 0.6rem;
    }

    .sublist_name {
        margin-left: 7px
    }
</style>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <div style="color: rgb(255, 255, 255); font-weight: 900">
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
                <box-icon name="dashboard" type="solid" color="white"></box-icon><span style="margin-left:7px">Main</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item ">
            <a class="nav-link  {{ request()->is('student/gradeinput') ? '' : 'collapsed' }}" data-bs-target="#sei-nav" data-bs-toggle="collapse" href="#">
                <box-icon name='file' color="white"></box-icon><span style="margin-left:7px">Submit Requirements</span>
                <box-icon class="bi-chevron-down ms-auto" style="padding:0px; none;" color="white" name='chevron-down'></box-icon>
            </a>
            <ul id="sei-nav" class="nav-content collapse {{ request()->is('student/gradeinput') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('student/gradeinput') }}' class="{{ request()->is('student/gradeinput') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow' size="xs" class="sublist" color="white"></box-icon><span class="sublist_name">Periodic</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('seilist2') }}' class="{{ request()->is('seilist2') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow'color="white" class="sublist" style="" size="xs"></box-icon>
                        <span class="sublist_name">Thesis</span>
                    </a>
                </li>
            </ul>
        </li><!-- End SEI Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="forms-elements.html">
                        <i class="bi bi-circle"></i><span>Form Elements</span>
                    </a>
                </li>
                <li>
                    <a href="forms-layouts.html">
                        <i class="bi bi-circle"></i><span>Form Layouts</span>
                    </a>
                </li>
                <li>
                    <a href="forms-editors.html">
                        <i class="bi bi-circle"></i><span>Form Editors</span>
                    </a>
                </li>
                <li>
                    <a href="forms-validation.html">
                        <i class="bi bi-circle"></i><span>Form Validation</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="tables-general.html">
                        <i class="bi bi-circle"></i><span>General Tables</span>
                    </a>
                </li>
                <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Data Tables</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="charts-chartjs.html">
                        <i class="bi bi-circle"></i><span>Chart.js</span>
                    </a>
                </li>
                <li>
                    <a href="charts-apexcharts.html">
                        <i class="bi bi-circle"></i><span>ApexCharts</span>
                    </a>
                </li>
                <li>
                    <a href="charts-echarts.html">
                        <i class="bi bi-circle"></i><span>ECharts</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Charts Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="icons-bootstrap.html">
                        <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
                    </a>
                </li>
                <li>
                    <a href="icons-remix.html">
                        <i class="bi bi-circle"></i><span>Remix Icons</span>
                    </a>
                </li>
                <li>
                    <a href="icons-boxicons.html">
                        <i class="bi bi-circle"></i><span>Boxicons</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Icons Nav -->

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

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
