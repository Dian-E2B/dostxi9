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
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav bx-ul" id="sidebar-nav">

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href='{{ route('dashboard') }}'>
                <box-icon name="dashboard" type="solid" color="white"></box-icon><span style="margin-left:7px">Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('seilist*') ? '' : 'collapsed' }}" data-bs-target="#sei-nav" data-bs-toggle="collapse" href="#">
                <box-icon name='file' color="white"></box-icon><span style="margin-left:7px">SEI</span>
                <box-icon class="bi-chevron-down ms-auto" style="padding:0px; none;" color="white" name='chevron-down'></box-icon>
            </a>
            <ul id="sei-nav" class="nav-content collapse {{ request()->is('seilist*') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('seilist') }}' class="{{ request()->is('seilist') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow' size="xs" class="sublist" color="white"></box-icon><span class="sublist_name">Qualifiers</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('seilist2') }}' class="{{ request()->is('seilist2') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow'color="white" class="sublist" style="" size="xs"></box-icon>
                        <span class="sublist_name">Potential Qualifiers</span>
                    </a>
                </li>
            </ul>
        </li><!-- End SEI Nav -->

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link {{ request()->is('emails') ? '' : 'collapsed' }}" href='{{ route('emails') }}'>
                <box-icon type='solid' name='receipt' color="white"></box-icon><span class="sublist_name">Reply Slips</span>
            </a>
        </li><!-- End Replyslip Status Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('ongoinglist*') || request()->is('rsms2*') ? '' : 'collapsed' }}" data-bs-target="#acad-nav" data-bs-toggle="collapse" href="#">
                <box-icon name='file' color="white"></box-icon><span style="margin-left:7px">Academic Monitoring</span>
                <box-icon class="bi-chevron-down ms-auto" color="white" style="padding:0px; none;" name='chevron-down'></box-icon>
            </a>
            <ul id="acad-nav" class="nav-content collapse {{ request()->is('ongoinglist*') || request()->is('rsms2*') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('ongoinglist') }}' class="{{ request()->is('ongoinglist') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow' size="xs" class="sublist" color="white"></box-icon><span class="sublist_name">Ongoing</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('seilist2') }}' class="{{ request()->is('seilist2') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow'color="white" class="sublist" style="" size="xs"></box-icon>
                        <span class="sublist_name">Potential Qualifiers</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Academic Monitoring -->

        <li class="nav-item text-center justify-content-md-center">
            <a class="nav-link {{ request()->is('emaileditor') ? '' : 'collapsed' }}" href='{{ route('emaileditor') }}'>
                <box-icon name='comment-edit' color="white"></box-icon><span class="sublist_name">Email Edit</span>
            </a>
        </li><!-- End Email Edit Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('accesscontrol*') ? '' : 'collapsed' }}" data-bs-target="#access-nav" data-bs-toggle="collapse" href="#">
                <box-icon name='file' color="white"></box-icon><span style="margin-left:7px">Access Control</span>
                <box-icon class="bi-chevron-down ms-auto" style="padding:0px; none;" color="white" name='chevron-down'></box-icon>
            </a>
            <ul id="access-nav" class="nav-content collapse {{ request()->is('accesscontrol*') ? 'show' : '' }} align-text-center" data-bs-parent="#sidebar-nav">
                <li>
                    <a href='{{ route('accesscontrol') }}' class="{{ request()->is('accesscontrol') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow' size="xs" class="sublist" color="white"></box-icon><span class="sublist_name">All</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('accesscontrolpending') }}' class="{{ request()->is('accesscontrolpending') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow'color="white" class="sublist" style="" size="xs"></box-icon>
                        <span class="sublist_name">Pending</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('accesscontrolongoing') }}' class="{{ request()->is('accesscontrolongoing') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow'color="white" class="sublist" style="" size="xs"></box-icon>
                        <span class="sublist_name">Ongoing</span>
                    </a>
                </li>
                <li class="align-text-center align-items-center">
                    <a href='{{ route('accesscontrolenrolled') }}' class="{{ request()->is('accesscontrolenrolled') ? 'active' : '' }}">
                        <box-icon type='solid' name='right-arrow'color="white" class="sublist" style="" size="xs"></box-icon>
                        <span class="sublist_name">Enrolled</span>
                    </a>
                </li>
            </ul>
        </li><!-- End ACCESSCONTROL Nav -->

    </ul>

</aside><!-- End Sidebar-->
