<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">DOST</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <div class="d-flex align-items-center p-2 ms-auto" style="margin-right: 1.5rem">
        <div>
            <button class="btn btn-light d-flex align-items-center" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <box-icon name='log-out'></box-icon>
                <span class="ms-1">Log out</span>
            </button><!-- End Logout Button -->
            <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

</header><!-- End Header -->


<!-- <nav class="navbar navbar-expand navbar-light navbar-bg">
    <a style="margin-left: 5px" class="sidebar-toggle js-sidebar-toggle">
        <i style="font-size: 25px; color: rgb(56, 55, 55)" class="fal fa-bars align-self-center"></i>
    </a>


    <ul class="navbar-nav d-lg-flex">
        <li id="requestscholar" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="requestDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Request/Submit
            </a>
            <div class="dropdown-menu" aria-labelledby="requestDropdown">
                <a class="dropdown-item" href="{{ route('student.requestclearance') }}"><i class="align-middle me-1" data-feather="home"></i>
                    Request/Upload Documents</a>

                <a class="dropdown-item" href="{{ route('student/gradeinput') }}"><i class="align-middle me-1 fas fa-file-certificate"></i> Submit Grades</a>
                <a class="dropdown-item" href="{{ route('student.viewsubmittedgrade') }}"><i class="align-middle me-1 fas fa-stamp"></i> View Grades</a>
            </div>
        </li>
    </ul>REQUEST  DROPDOWN BUTTON


    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                    <div class="text-muted small mt-1">30m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-warning" data-feather="bell"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Lorem ipsum</div>
                                    <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit
                                        et.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-primary" data-feather="home"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Login from 192.186.1.8</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-success" data-feather="user-plus"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">New connection</div>
                                    <div class="text-muted small mt-1">Christina accepted your request.</div>
                                    <div class="text-muted small mt-1">14h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>


            <li style="align-self: center">

                <a class="btn btn-light" href="{{ route('student.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="far fa-power-off"></i><span style="margin-left:8px;">Log out</span></a>
                <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav> -->
