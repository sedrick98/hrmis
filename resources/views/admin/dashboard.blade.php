@extends('layouts.auth_app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">


@endsection

@section('content')

<body class="c-app">

    @include('includes/sidebar')

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