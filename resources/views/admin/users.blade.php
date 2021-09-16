@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>


    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-lg-down-none">
            <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#signet"></use>
            </svg>
        </div>
        <ul class="c-sidebar-nav ps ps--active-y">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link c-active" href="index.html">
                    <h4>HRMIS - DASHBOARD</h4>
                </a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="colors.html">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                    </svg>
                    <h4>USERS</h4>
                </a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="typography.html">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                    </svg>
                    <h4>ROLES</h4>
                </a></li>
        </ul>
    </div>


    <div style="padding-left:30px">

        <div class="card">
            <div class="card-header"><strong>ADD USER</strong></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" id="company" type="text" placeholder="Enter your username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="vat" type="text" placeholder="email@sample.com">
                </div>
                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input class="form-control" id="street" type="text" placeholder="first name">
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input class="form-control" id="country" type="text" placeholder="last name">
                </div>

                <div class="form-group">
                    <label for="middlename">Middle Name</label>
                    <input class="form-control" id="country" type="text" placeholder="middle name">
                </div>

            </div>
        </div>



    </div>


</body>





@endsection