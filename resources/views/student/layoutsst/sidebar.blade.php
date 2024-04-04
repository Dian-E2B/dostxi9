<style>
    li:hover .nav-link box-icon:not(.bi-chevron-down) {
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
                <span style="padding: 0em 1em 0em 0em;"><i style="font-size:20px;" class="fas animate fa-chart-bar"></i></span>
                <div class="">Main</div>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link  {{ request()->is('student/gradeinput') || request()->is('student/thesis') ? '' : 'collapsed' }}" data-bs-target="#sei-nav" data-bs-toggle="collapse" href="#">
                <span style="padding: 0em 1em 0em 0em;"><i style="font-size:20px;" class="fas animate fa-upload"></i></span>
                <span style="">Submit Requirements</span>
                <i class="fas fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="sei-nav" class="nav-content collapse {{ request()->is('student/gradeinput') || request()->is('student/thesis') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('student/gradeinput') }}' class="{{ request()->is('student/gradeinput') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Periodic</span>

                    </a>
                </li>
                <li>
                    <a href='{{ route('student/thesis') }}' class="{{ request()->is('student/thesis') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Thesis</span>
                    </a>
                </li>
            </ul>
        </li><!-- End SEI Nav -->


    </ul>

</aside>
