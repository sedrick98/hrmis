@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<html>



<body>

    <div class="card" style="margin:20px; margin-top:0px;">
        <div class="card-header"><h3>IPCR - Submitted</h3></div>
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
                                <button class="btn btn-block btn-success active" type="button" aria-pressed="true" style="width:60px; padding:2px; height:30px;">View</button>
                                <button class="btn btn-block btn-info active" type="button" aria-pressed="true" style="width:60px; padding:2px; height:30px; margin-top:0px; margin-left:10px">Edit</button>
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