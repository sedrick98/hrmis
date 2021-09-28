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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ strtoupper($role->name) }}</td>
                                    <td>
                                    @foreach ($role->permissions as $permission) 
                                        <span class="badge badge-success">{{ $role->getPermissionRecord($permission->permission_id)->name }}</span>
                                    @endforeach
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-primary"
                                        data-roleid="{{ strtoupper($role->id) }}"
                                        data-name="{{ strtoupper($role['name']) }}"
                                        data-permissions='[@foreach ($role->permissions as $permission){{ $permission->permission_id }},@endforeach]'
                                        type="edit" onclick="updateRole(this)"
                                        data-toggle="modal" data-target="#exampleModal"
                                        >Edit</button>
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

    <!-- <div class="card" style="float: left; margin-left:5%; width:50%">
        <div class="card-header"><strong>UPDATE ROLE</strong></div>
        <div class="card-body">
            <form action="{{ route('admin-update-role') }}" method="post">
                @csrf
                <input type="hidden" name="role_id" id="updateRoleID" value="">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="select1">Role Selected</label>
                    <div class="col-md-9">
                    <input class="form-control" id="updateRoleName" name="name" value="SOMETHING">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Role Name</label>
                    <div class="col-md-9">
                    <select multiple class="form-control" name="permissions[]" id="updateSelectedPermissions">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ strtoupper($permission->name) }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit"> Update</button>
            </div>
        </form>
    </div> -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('admin-update-role') }}" method="post">
                @csrf
                <input type="hidden" name="role_id" id="updateRoleID" value="">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="select1">Role Selected</label>
                    <div class="col-md-9">
                    <input class="form-control" id="updateRoleName" name="name" value="SOMETHING">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="text-input">Role Name</label>
                    <div class="col-md-9">
                    <select multiple class="form-control" name="permissions[]" id="updateSelectedPermissions">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ strtoupper($permission->name) }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" type="submit"> Update</button>
            </div>
            </div>
            </form>
        </div>
    </div>

</body>


@endsection

@section('after-scripts')
<script>
    const updateRole = (role) => {
        $('#updateRoleID').val(role.dataset.roleid);
        $('#updateRoleName').val(role.dataset.name);
        $('#updateSelectedPermissions').val(eval(role.dataset.permissions));
    }
</script>
@endsection