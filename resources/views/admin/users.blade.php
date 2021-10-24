@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')

<body>

    @include('includes/sidebar')

    @if (session('success_registration'))
        <h3 style="margin-left: 30px; color: green;">{{ session('success_registration') }}</h3>
    @endif    

    <div style="padding-left:20px; width: 70%; float:left">
        <div class="card">
            <div class="card-header">
                <h3>USERS LIST</h3>
            </div>
            <div class="card-body">

                <div class="card">

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->middle_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="badge badge-success">{{ strtoupper($user->roleName()) }}</span></td>   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p class="lead"><a class="btn btn-primary btn-lg" href="{{ route('admin-add-user') }}" role="button">Add New User</a></p>
            </div>
        </div>
    </div>


    <div style="padding-left:20px; width: 27%; float:right; margin-right:30px">
        <div class="card">
            <div class="card-header">
                <h3>ROLES</h3>
            </div>
            <div class="card-body">

                <div class="card" >

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>ROLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ strtoupper($role['name']) }}</td>
                                    <td>
                                    @foreach ($role['permissions'] as $permission) 
                                        <span class="badge badge-success">{{ $permission }}</span>
                                    @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- <div style="padding-left:20px; width: 27%; float:right; margin-right:30px">
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
    </div> -->

</body>





@endsection