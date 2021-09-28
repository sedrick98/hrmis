@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>


    @include('includes/sidebar')
    
    <div style="padding-left:20px; width: 40%; float:right; margin-right:40px">
        <div class="card">
            <div class="card-header">
                <h3>Roles @if (session('success_role_added')) <span style="margin-left: 70px; color: green;"> {{ session('success_role_added') }}</span>@endif</h3>
            </div>
            <div class="card-body">

                <div class="card">

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
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
    
    <form action="{{ route('admin-add-role') }}" method="post">
        @csrf
        <div class="card" style="float: left; margin-left:5%; width:50%">
            <div class="card-header"><strong>ADD NEW ROLE</strong></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nf-email">Role Name</label>
                    <input class="form-control" id="name" name="name" placeholder="enter type of user">
                </div>
                <select multiple class="form-control" name="permissions[]">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ strtoupper($permission->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
                <button class="btn btn-sm btn-danger" type="reset"> Cancel</button>
            </div>
        </div>
    </form>

    <div class="card" style="float: left; margin-left:5%; width:50%">
        <div class="card-header"><strong>UPDATE ROLE</strong></div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="select1">Select Role</label>
                    <div class="col-md-9">
                        <select class="form-control" id="select1" name="select1">
                            <option value="0">Please select</option>
                            <option value="1">Option #1</option>
                            <option value="2">Option #2</option>
                            <option value="3">Option #3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Role Name</label>
                    <div class="col-md-9">
                        <input class="form-control" id="text-input" type="text" name="text-input" placeholder="Enter new role name">
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" type="submit"> Update</button>
            <button class="btn btn-sm btn-danger" type="reset"> Delete</button>
        </div>
    </div>




</body>


@endsection