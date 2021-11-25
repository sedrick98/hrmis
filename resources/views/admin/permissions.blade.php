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
                <h3>PERMISSION LIST @if (session('update_success')) <span style="margin-left: 70px; color: green;"> {{ session('update_success') }}</span>@endif</h3>
            </div>
            <div class="card-body">

                <div class="card">

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ strtoupper($permission->name) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-name="{{ strtoupper($permission['name']) }}" data-id="{{ $permission->id }}" type="edit" onclick="updatePermission(this)" data-toggle="modal" data-target="#exampleModal">Edit
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('admin-add-permission') }}" method="post">
        <div class="card" style="float: left; margin-left:5%; width:50%">
            <div class="card-header"><strong>ADD NEW PERMISSION @if (session('create_success')) <span style="margin-left: 70px; color: green;"> {{ session('create_success') }}</span>@endif</strong></div>
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="nf-email">Permission Name</label>
                    <input class="form-control" id="rolename" name="name">
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
            </div>
        </div>
    </form>


    <!-- <div class="card" style="float: left; margin-left:5%; width:50%">
        <div class="card-header"><strong>UPDATE PERMISSION</strong></div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="select1">Select Permission</label>
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
                    <label class="col-md-3 col-form-label" for="text-input">Permission Name</label>
                    <div class="col-md-9">
                        <input class="form-control" id="text-input" type="text" name="text-input" placeholder="Enter new permission name">
                    </div>
                </div>

            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" type="submit"> Update</button>
            <button class="btn btn-sm btn-danger" type="reset"> Delete</button>
        </div>
    </div> -->



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Permission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('admin-update-permission') }}" method="post">
                        @csrf
                        <input type="hidden" name="permission_id" id="updatePermissionID" value="">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="select1">Permission Name</label>
                            <div class="col-md-9">
                                <input class="form-control" id="updatePermissionName" name="name">
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
    const updatePermission = (role) => {
        $('#updatePermissionID').val(role.dataset.id);
        $('#updatePermissionName').val(role.dataset.name);
    }
</script>
@endsection