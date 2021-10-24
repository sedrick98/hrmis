@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>


    @include('includes/sidebar')


    @if ($message = Session::get('success'))
    <div class="altert-success-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <strong>{{$message}}</strong>
    </div>
    @endif

    <div class="card" style="margin:20px;">
        <div class="card-header">
            <h3>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) FORM</h3>
        </div>
        <div class="card-body">
            <!--autocomplete="off"-->

            <form action="{{route('post-info')}}" method="post">
                @csrf
                <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:lightblue; border-radius: 10px">
                    <div class="container">


                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="ccmonth">First Name</label>
                                <input class="form-control" type="text" name="first-name" placeholder="enter first name" value="{{{ $info->first-name ?? '' }}}">

                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="ccyear">Last Name</label>
                                <input class="form-control" type="text" name="last-name" placeholder="enter last name" value="{{{ $info->last-name ?? '' }}}">

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cvv">Middle Name</label>
                                    <input class="form-control" type="text" name="middle-name" placeholder="enter middle name" value="{{{ $info->middle-name ?? '' }}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="cvv">DIVISION</label>
                                    <input class="form-control" type="text" name="division" placeholder="enter division name" style="width:400px" value="{{{ $info->division ?? '' }}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="width:300px; float:right">
                    <a class="btn btn-primary btn-lg" style="width:250px; float:right" href="{{ route('ipcr-form') }}" role="button">
                        <h5>NEXT</h5>
                    </a>
                    <button type="submit" class="btn btn-primary" style="width:250px; float:right">Next</button>
                </div><br><br>

            </form>


        </div>
    </div>








    @endsection