<!-- ======= Header ======= -->
<style>
    .animate__animated.animate__wobble {
        --animate-duration: 1s;
        animation-iteration-count: infinite !important;
    }
</style>
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">DOST</span>
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
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        {{ Auth::user()->username }}
                    </span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow mt-2">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <box-icon name='log-out-circle'></box-icon>&nbsp;
                            <span style="font-size: 15px"> Sign Out</span>
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
<script>
    function updateNotificationCount() {
        fetch('/notifications/count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('notificationCount').textContent = data.count;
                const notificationCount = data.count;
                const bellIcon = document.getElementById('bell1');
                if (notificationCount > 0) {
                    bellIcon.classList.add('animate__animated');
                    bellIcon.classList.add('animate__wobble');
                }
                document.getElementById('notificationCount2').textContent = data.count;
            });
    }

    updateNotificationCount();
    setInterval(updateNotificationCount, 20000);


    function getNotifications() {
        fetch('/notifications')
            .then(response => response.json())
            .then(data => {
                const notificationsList = document.getElementById('notifications-list');
                // Clear existing notifications
                notificationsList.innerHTML = '';
                data.notifications.forEach(notification => {
                    const li = document.createElement('li');
                    li.className = 'notification-item';
                    li.innerHTML = `
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <i class="fas fa-exclamation-triangle" style="font-size:20px; margin-right: 1rem;  margin-left: 1rem; color: #11bfeb"  ></i>
                        <div>
                            <p style="font-size:1em; font-weight: 700; color: black">${notification.type}</p>
                            <p>${notification.message}</p>
                        </div>
                    `;
                    li.setAttribute('contenteditable', 'false');
                    li.addEventListener('click', (function(scholarId) {
                        return function() {
                            handleNotificationClick(scholarId);
                        };
                    })(notification.scholar_id));

                    notificationsList.appendChild(li);
                });

            })
            .catch(error => console.error('Error fetching notifications:', error));
    }

    getNotifications();
    setInterval(getNotifications, 20000);


    function handleNotificationClick(scholarId) {
        // Construct the URL using the named route and scholar_id
        var url = '{{ url('/scholar_information/') }}' + '/' + scholarId;
        // Redirect the user to the new URL
        window.location.href = url;
    }
</script>
