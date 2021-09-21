@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>

    @include('includes/sidebar')

    <div style="padding-left:20px; width: 70%; float:left">
        <div class="card">
            <div class="card-header">
                <h3>USERS LIST</h3>
            </div>
            <div class="card-body">

                <div class="card" style="">

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>USERNAME</th>
                                <th>DATE REGISTER</th>
                                <th>ROLE</th>
                                <th>PERMISSION</th>
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
                            <tr>
                                <td>Yiorgos Avraamu</td>
                                <td>2012/01/01</td>
                                <td>Member</td>
                                <td><span class="badge badge-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Yiorgos Avraamu</td>
                                <td>2012/01/01</td>
                                <td>Member</td>
                                <td><span class="badge badge-success">Active</span></td>
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


                <p class="lead"><a class="btn btn-primary btn-lg" href="#" role="button">Go to Users</a></p>
            </div>
        </div>
    </div>


    <div style="padding-left:20px; width: 27%; float:right; margin-right:30px">
        <div class="card">
            <div class="card-header">
                <h3>ROLES</h3>
            </div>
            <div class="card-body" style="height:250px">

                <div class="card" >

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>ROLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admin</td>
                            </tr>
                            <tr>
                                <td>User</td>
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
        </div>
    </div>


    <div style="padding-left:20px; width: 27%; float:right; margin-right:30px">
        <div class="card">
            <div class="card-header">
                <h3>PERMISSION</h3>
            </div>
            <div class="card-body" style="height:250px">

                <div class="card" >

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Permissions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admin</td>
                            </tr>
                            <tr>
                                <td>Write</td>
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
        </div>
    </div>




</body>





@endsection