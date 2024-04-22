<!-- ======= Header ======= -->
<style>
    .animate__animated.animate__wobble {
        --animate-duration: 1s;
        animation-iteration-count: infinite !important;
    }
</style>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a class="logo d-flex align-items-center">
            <span class="d-none d-lg-block">DOST - ADMIN</span>
        </a>
        <span class="toggle-sidebar-btn mb-1"> <i class="fas fa-bars" style="font-size: 25px"></i></span>
    </div><!-- End Logo -->

    {{-- @php
        $currentTime = now()->format('H'); // Get the current hour in 24-hour format
        $greeting = ''; // Initialize the greeting variable

        // Determine the appropriate greeting based on the current time
        if ($currentTime >= 5 && $currentTime < 12) {
            $greeting = 'Good Morning';
        } elseif ($currentTime >= 12 && $currentTime < 18) {
            $greeting = 'Good Afternoon';
        } else {
            $greeting = 'Good Evening';
        }
    @endphp --}}


    {{--   <span class="col-5 d-flex align-items-center justify-content-end disable-select">
        <h3>{{ $greeting }}!</h3>
    </span> --}}


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">


                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i id="bell1" class="fas fa-bell "></i>
                    <span id="notificationCount" class="badge bg-primary badge-number"></span>
                </a><!-- End Notification Icon -->


                <ul style="user-select: none;" class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        ----- You have <span id="notificationCount2"></span> new notifications -----
                    </li>
                    <div style="margin: 0 ; cursor:pointer;" id="notifications-list"></div>
                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-md-block dropdown-toggle ps-2">
                        {{ Auth::user()->username }}
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow mt-2 align-items-center">
                    <li class="align-items-center">
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i style="font-size: 20px" class="fas fa-sign-out-alt"></i>
                            <div class="d-flex " style="font-size: 15px; font-weight: 600; margin-left: 5px; margin-bottom: 1px; display: inline-block;">Log Out</div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<script></script>
