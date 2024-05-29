<style>
    li:hover .nav-link .animate:not(.fa-chevron-down) {
        animation: tada 1s;
        animation-iteration-count: infinite;
    }
</style>
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav " id="sidebar-nav">

        <li class="nav-item text-center justify-content-center">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href='{{ route('dashboard') }}'>
                <i class="bi bi-bar-chart-fill"></i>
                <div class="">Dashboard</div>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('seilist*') ? '' : 'collapsed' }}" data-bs-target="#sei-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-lines-fill"></i>
                <span style="">SEI</span>
                <i class="bi bi-chevron-down fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="sei-nav" class="nav-content collapse {{ request()->is('seilist*') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('seilist') }}' class="{{ request()->is('seilist') ? 'active' : '' }}">
                        <i class="bi bi-forward-fill" style="font-size:15px;"></i>Qualifiers
                    </a>
                </li>
                <li class="">
                    <a href='{{ route('seilist2') }}' class="{{ request()->is('seilist2') ? 'active' : '' }}">
                        <i class="bi bi-forward-fill" style="font-size:15px;"></i>Potential Qualifiers
                    </a>
                </li>
                <li class="">
                    <a href='{{ route('endorsedongoing') }}' class="{{ request()->is('endorsedongoing ') ? 'active' : '' }}">
                        <i class="bi bi-forward-fill" style="font-size:15px;"></i>Endorsed
                    </a>
                </li>
            </ul>
        </li><!-- End SEI Nav -->

        <li class="nav-item text-center justify-content-center">
            <a class="nav-link {{ request()->is('emails') ? '' : 'collapsed' }}" href='{{ route('emails') }}'>
                <i class="bi bi-archive-fill"></i>
                <span class="">Reply&nbsp;Slips</span>
            </a>
        </li><!-- End Replyslip Status Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('ongoinglist*') || request()->is('rsms2*') ? '' : 'collapsed' }}" data-bs-target="#acad-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-display-fill"></i>
                <div style="">Academic&nbsp;Monitoring</div>
                <i class="bi bi-chevron-down fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="acad-nav" class="nav-content collapse {{ request()->is('ongoinglist*') || request()->is('rsms2*') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('ongoinglist') }}' class="{{ request()->is('ongoinglist') ? 'active' : '' }}">
                        <span style="padding: 0em 0em 0em 0em;"><i style="font-size:15px;" class="fas fa-long-arrow-alt-right"></i><span style="margin-left:.5em">Ongoing</span></span>
                    </a>
                </li>
            </ul>
        </li><!-- End Academic Monitoring -->

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link {{ request()->is('emaileditor') ? '' : 'collapsed' }}" href='{{ route('emaileditor') }}'>
                <i class="bi bi-envelope-arrow-down-fill animate"></i>
                <span class="" style="">Email&nbsp;Edit</span>
            </a>
        </li><!-- End Email Edit Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('accesscontrol*') ? '' : 'collapsed' }}" data-bs-target="#access-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-universal-access"></i>
                <span style="">Access Control</span>
                <i class="bi bi-chevron-down fa-chevron-down"style="margin-left: auto; padding: 0px;"></i>
            </a>
            <ul id="access-nav" class="nav-content collapse {{ request()->is('accesscontrol*') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('accesscontrol') }}' class="{{ request()->is('accesscontrol') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas  fa-long-arrow-alt-right"></i>
                        <div style="margin-left:.5em">All</div>
                    </a>
                </li>
                <li>
                    <a href='{{ route('accesscontrolpending') }}' class="{{ request()->is('accesscontrolpending') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas  fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Pending</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('accesscontrolongoing') }}' class="{{ request()->is('accesscontrolongoing') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas  fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Ongoing</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('accesscontrolenrolled') }}' class="{{ request()->is('accesscontrolenrolled') ? 'active' : '' }}">
                        <i style="font-size:15px;" class="fas  fa-long-arrow-alt-right"></i>
                        <span style="margin-left:.5em">Enrolled</span>
                    </a>
                </li>
            </ul>
        </li><!-- End ACCESSCONTROL Nav -->

    </ul>

</aside><!-- End Sidebar-->
