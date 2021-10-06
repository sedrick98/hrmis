@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>


    @include('includes/sidebar')

    <div class="card" style="margin:20px;">
        <div class="card-header">
            <h3>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) FORM</h3>
        </div>
        <div class="card-body">


            <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:lightblue; border-radius: 10px">
                <div class="container">


                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ccmonth">First Name</label>
                            <input class="form-control" type="text" placeholder="enter first name">

                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="ccyear">Last Name</label>
                            <input class="form-control" type="text" placeholder="enter last name">

                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cvv">Middle Name</label>
                                <input class="form-control" type="text" placeholder="enter middle name">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="ccnumber">Division</label>
                                <select class="form-control" id="select1" name="select1" style="width:400px">
                                    <option value="0">Please select</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                    <option value="3">Option #3</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:lightblue; border-radius: 10px">
                <div class="container">
                    <div><strong>SIGNATORIES</strong>
                        <hr>
                    </div>

                    <table>
                        <tr>
                            <td style="padding-right: 30px">
                                <label for="ccnumber">Immediate Supervisor</label>
                                <select class="form-control" id="select1" name="select1" style="width:450px">
                                    <option value="0">Please select</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                    <option value="3">Option #3</option>
                                </select>
                            </td>
                            <td>
                                <label for="ccnumber">Regional Director</label>
                                <select class="form-control" id="select1" name="select1" style="width:450px">
                                    <option value="0">Please select</option>
                                    <option value="1">Option #1</option>
                                    <option value="2">Option #2</option>
                                    <option value="3">Option #3</option>
                                </select>
                            </td>
                        </tr>

                    </table>
                    <br>

                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="width:300px; float:right">
                        <button class="btn btn-block btn-success" type="button">
                            <h5>NEXT</h5>
                        </button>
                    </div><br><br>

                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="width:200px; float:right">
                <button class="btn btn-block btn-info" type="button" data-toggle="modal" data-target="#adminView"><strong>ADMIN</strong></button>
            </div>

        </div>
    </div>




    <div class="modal fade" style="float: left; margin:50px; margin-left:350px; width:50%;" id="adminView" role="dialog" aria-hidden="true">
        <div class="card-header">
            <h5>ADD NEW</h5>
            <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="float:right; width:100px; margin-top:-30px">
                <button class="btn btn-block btn-danger" type="button">Close</button>
            </div>
            
        </div>
        <div class="card-body" style="background-color:whitesmoke">

            <div class="form-group">
                <label for="nf-email">Division Name</label>
                <input class="form-control" id="rolename" name="name"><br>
                <button class="btn btn-sm btn-primary" type="submit" style="float:right"> ADD</button>
            </div>

            <div class="form-group">
                <label for="nf-email">Immediate Supervisor</label>
                <input class="form-control" id="rolename" name="name"><br>
                <button class="btn btn-sm btn-primary" type="submit" style="float:right"> ADD</button>
            </div>

            <div class="form-group">
                <label for="nf-email">Regional Director</label>
                <input class="form-control" id="rolename" name="name"><br>
                <button class="btn btn-sm btn-primary" type="submit" style="float:right"> ADD</button>
            </div>

        </div>
        <div class="card-footer">
        </div>
    </div>










    @endsection