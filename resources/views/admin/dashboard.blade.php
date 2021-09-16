@extends('layouts.auth_app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">


@endsection

@section('content')

<body class="c-app">



    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar" >
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



    <div style="padding-left: 23%">
        <div class="card">
            <div class="card-header">
                <h3>USERS</h3>
            </div>
            <div class="card-body">
                <div class="jumbotron" style="padding:10px">
                    <div class="card" style="">

                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Date registered</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Yiorgos Avraamu</td>
                                    <td>2012/01/01</td>
                                    <td>Member</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Avram Tarasios</td>
                                    <td>2012/02/01</td>
                                    <td>Staff</td>
                                    <td><span class="badge badge-danger">Banned</span></td>
                                </tr>

                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>

                <p class="lead"><a class="btn btn-primary btn-lg" href="#" role="button">Go to Users</a></p>
            </div>
        </div>
    </div>


    <div style="padding-left: 40px">
        <div class="card">
            <div class="card-header">
                <h3>ROLES</h3>
            </div>
            <div class="card-body">
                <div class="jumbotron" style="padding:10px">
                    <div class="card" style="">

                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Date registered</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Yiorgos Avraamu</td>
                                    <td>2012/01/01</td>
                                    <td>Member</td>
                                    <td><span class="badge badge-success">Active</span></td>
                                </tr>
                                <tr>
                                    <td>Avram Tarasios</td>
                                    <td>2012/02/01</td>
                                    <td>Staff</td>
                                    <td><span class="badge badge-danger">Banned</span></td>
                                </tr>

                            </tbody>
                        </table>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </div>
                </div>

                <p class="lead"><a class="btn btn-primary btn-lg" href="#" role="button">Go to Roles</a></p>
            </div>
        </div>
    </div>


   






</body>




@endsection