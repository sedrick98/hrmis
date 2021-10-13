<header class="c-header c-header-light c-header-fixed c-header-with-subheader shadow-sm">
    <div class="c-header-nav ml-auto">
    </div>
    <ul class="c-header-nav ml-left mr-4">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar"><img class="c-avatar-img" src="{{asset('profile/no-user-photo.png')}}" alt="user@email.com"></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
                <a class="dropdown-item" href="{{ route('logout') }}">
                    <svg class="c-icon mr-2">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg> Logout
                </a>
            </div>
        </li>
    </ul>
</header>