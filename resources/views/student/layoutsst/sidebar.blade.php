<style>
    li:hover .nav-link .bi:not(.bi-chevron-down) {
        animation: tada 1s;
        animation-iteration-count: infinite;
    }


    .sidebar {
        background-color: #ffffff;
    }

    .sidebar-nav .nav-link {
        color: #000000;
        background: #9b9898;
    }

    .sidebar-nav .nav-content a {
        color: #050505;
    }

    .sidebar-nav .nav-link.collapsed {
        color: #000000;
        background: #ffffff;
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
        <li class="nav-item text-center justify-content-center">
            <a class="nav-link {{ request()->is('student/profile') ? '' : 'collapsed' }}" href='{{ route('student.profile') }}'>
                <span style=""><i class="bi bi-house-door-fill" style="color: black; font-size: 17px;"></i></span>
                <div class="">Main</div>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link  {{ request()->is('student/gradeinput') || request()->is('student/thesis') ? '' : 'collapsed' }}" data-bs-target="#sei-nav" data-bs-toggle="collapse" href="#">
                <span style="padding: 0em 0em 0em 0em;"><i class="bi bi-book-fill" style="color: black; font-size: 17px;"></i></span>
                <span style="">Submit Requirements</span>
                <i class="fas fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="sei-nav" class="nav-content collapse {{ request()->is('student/gradeinput') || request()->is('student/thesis') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('student/gradeinput') }}' class="{{ request()->is('student/gradeinput') ? 'active' : '' }}">
                        <i class="bi bi-forward-fill" style="font-size:15px;"></i>Periodic
                    </a>
                </li>
                <li>
                    <a href='{{ route('student/thesis') }}' class="{{ request()->is('student/thesis') ? 'active' : '' }}">
                        <i class="bi bi-forward-fill" style="font-size:15px;"></i>Thesis
                    </a>
                </li>
            </ul>
        </li><!-- End SEI Nav -->

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link {{ request()->is('student/[]') ? '' : 'collapsed' }}" data-bs-target="#req-nav" data-bs-toggle="collapse" href="#">
                <span style=""><i class="bi bi-card-heading" style="color: black; font-size: 17px;"></i></span>
                <span style="">Request</span>
                <i class="fas fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="req-nav" class="nav-content collapse {{ request()->is('student/[]') || request()->is('student/[]') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('student/gradeinput') }}' class="{{ request()->is('student/[]') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Shift</span>
                    </a>
                </li>
                <li>
                    <a href='{{ route('student/thesis') }}' class="{{ request()->is('student/[]') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Transfer</span>
                    </a>
                </li>
                <li>
                    <a href='{{ route('student/thesis') }}' class="{{ request()->is('student/[]') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">LOA</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#certificate-nav">
                        <i style="font-size:15px;" class="fas fa-chevron-down"></i>
                        <span style="margin-left:.5em">Clearance</span>
                    </a>
                    <ul id="certificate-nav" class="nav-content collapse" data-bs-parent="#req-nav" style="margin-left:0.6cm">
                        <!-- Add options for Certificate submenu -->
                        <li>
                            <a href='#' class="">
                                <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                                <span style="margin-left:.5em">Local</span>
                            </a>
                        </li>
                        <li>
                            <a href='#' class="">
                                <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                                <span style="margin-left:.5em">Final</span>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </li><!-- End Request Nav -->


    </ul>

</aside>
