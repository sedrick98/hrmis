@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<html>



<body>

    @if (Session::has('success'))
    <div class="alert alert-block" style="border-color:#2E8B57; background-color:#98FB98; margin:20px; margin-top:0px; box-shadow: 5px 10px 8px #888888;">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif

    <div class="card" style="margin:20px; margin-top:0px;">
        <div class="card-header">
            <h3>IPCR - Submitted</h3>
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Employee</th>
                        <th>Division</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submitted as $info)
                    <tr>
                        <td>{{ strtoupper($info->title) }}</td>
                        <td>{{ strtoupper($info->last_name) }}, {{ strtoupper($info->first_name) }}</td>
                        <td>{{ strtoupper($info->division) }}</td>
                        <td><span class="badge badge-warning">{{ strtoupper($info->status) }}</span></td>

                        <td>
                            <div class="row">
                                <a class="btn btn-block btn-success active" style="width:60px; padding:2px; height:30px; margin-top:0px; margin-left:10px" href="{{ url('display/'.$info->id) }}">View
                                </a>

                                <a class="btn btn-block btn-info active" style="width:60px; padding:2px; height:30px; margin-top:0px; margin-left:10px" href="{{ url('edit/'.$info->id) }}">Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--<ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>-->
        </div>
    </div><br>

    <div class="card" style="margin:20px;">
        <div class="card-header">
            <h3>IPCR - Approved</h3>
        </div>
        <div class="card-body">
            <table class="table table-responsive-sm table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Employee</th>
                        <th>Division</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submitted as $info)
                    <tr>
                        <td>{{ strtoupper($info->title) }}</td>
                        <td>{{ strtoupper($info->last_name) }}, {{ strtoupper($info->first_name) }}</td>
                        <td>{{ strtoupper($info->division) }}</td>
                        <td><span class="badge badge-warning">{{ strtoupper($info->status) }}</span></td>

                        <td>
                            <div class="row">
                                <a class="btn btn-block btn-success active" 
                                style="width:150px; padding:2px; height:30px; margin-top:0px; margin-left:10px" 
                                href="{{ url('view/'.$info->id) }}">
                                EXPORT TO PDF
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--<ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>-->
        </div>
    </div>


</body>

</html>


@endsection