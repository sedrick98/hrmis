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
                <h3>PERMISSION LIST</h3>
            </div>
            <div class="card-body">

                <div class="card">

                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th>Permission</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Admin</td>
                            </tr>
                            <tr>
                                <td>Write</td>
                            </tr>
                            <tr>
                                <td>View</td>
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


    <div class="card" style="float: left; margin-left:5%; width:50%">
        <div class="card-header"><strong>ADD NEW PERMISSION</strong></div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nf-email">Permission Name</label>
                    <input class="form-control" id="rolename" name="nf-role" placeholder="enter type of user">
                </div>
                <div class="form-group">
                    <label for="nf-password">Description</label>
                    <textarea class="form-control" id="textarea-input" name="textarea-input" rows="9" placeholder="Permission description" style="margin-top: 0px; margin-bottom: 0px; height: 88px;"></textarea>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" type="submit"> Submit</button>
            <button class="btn btn-sm btn-danger" type="reset"> Cancel</button>
        </div>
    </div>

    <div class="card" style="float: left; margin-left:5%; width:50%">
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
    </div>





</body>


@endsection