<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img src="{{asset('images/logos/dost-logo.png')}}" alt="DOST 11 Logo" width="80%">
    </div>
    <ul class="c-sidebar-nav ps">

        @if (strtolower(Auth::user()->roleName()) == 'hr'
        || strtolower(Auth::user()->roleName()) == 'ard - fasd'
        || strtolower(Auth::user()->roleName()) == 'ard - section head'
        || strtolower(Auth::user()->roleName()) == 'ard - division head'
        || strtolower(Auth::user()->roleName()) == 'rd')
        <!-- Leave Request - For approval -->
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-briefcase"></i>Leave Approvals</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('leave-approval') }}">
                        <span class="c-sidebar-nav-icon"></span>Pending Approval</a>
                </li>
            </ul>
        </li>
        @endif

        <!-- Dashboard -->
        @if (strtolower(Auth::user()->roleName()) != 'admin')
        <!-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin-dashboard') }}">
                <i class="c-sidebar-nav-icon cib-when-i-work"></i>Dashboard - {{ Auth::user()->roleName() }}
            </a>
        </li> -->

        <!-- Leave Requests -->
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-beach-access"></i>Leave Requests</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('leave-create') }}"><span class="c-sidebar-nav-icon"></span>Create</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('leave-all') }}"><span class="c-sidebar-nav-icon"></span>My requests</a></li>
                <!-- <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span>Pending</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span>Approved</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span>Rejected</a></li> -->
            </ul>
        </li>

        <!-- IPCR -->
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-file"></i>IPCR</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('ipcr-create') }}"><span class="c-sidebar-nav-icon"></span>Create</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('ipcr-submitted') }}"><span class="c-sidebar-nav-icon"></span>Submitted</a></li>
            </ul>
        </li>
        @endif

        @if (strtolower(Auth::user()->roleName()) == 'hr'
        || strtolower(Auth::user()->roleName()) == 'ard - fasd'
        || strtolower(Auth::user()->roleName()) == 'ard - section head'
        || strtolower(Auth::user()->roleName()) == 'ard - division head'
        || strtolower(Auth::user()->roleName()) == 'rd')
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-file"></i>IPCR Approvals</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('ipcr-approval') }}"><span class="c-sidebar-nav-icon"></span>For Approval</a></li>
            </ul>
        </li>
        @endif

        

        @if (strtolower(Auth::user()->roleName()) == 'admin')
        <!-- Accounts -->
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-people"></i>Accounts</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin-users') }}"><span class="c-sidebar-nav-icon"></span>All Users</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin-add-user') }}"><span class="c-sidebar-nav-icon"></span>Add New User</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin-roles') }}"><span class="c-sidebar-nav-icon"></span>Roles</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('admin-permissions') }}"><span class="c-sidebar-nav-icon"></span>Permissions</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span>Activity Log</a></li>
            </ul>
        </li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                <i class="c-sidebar-nav-icon cil-people"></i>Signatories</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('signatory-divisions') }}"><span class="c-sidebar-nav-icon"></span>Divisions</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('signatory-sections') }}"><span class="c-sidebar-nav-icon"></span>Sections</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ route('signatory-assignments') }}"><span class="c-sidebar-nav-icon"></span>Assignments</a></li>
            </ul>
        </li>
        @endif

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>