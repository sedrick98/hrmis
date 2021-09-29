@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')

<style>
    table,
    td,
    th {
        text-align: center;
        padding: 5px;
    }
</style>


<body>


    @include('includes/sidebar')


    <div class="card" style="margin:15px">
        <div class="card-header">
            <h3>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) FORM</h3>
        </div>
        <div class="card-body">
            <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:lightblue; border-radius: 10px">
                <div class="container">


                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="ccmonth">First Name</label>
                            <input class="form-control" id="cvv" type="text" placeholder="enter first name">

                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="ccyear">Last Name</label>
                            <input class="form-control" id="cvv" type="text" placeholder="enter last name">

                            </select>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cvv">Middle Initial</label>
                                <input class="form-control" id="cvv" type="text" placeholder="please enter middle initial only">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="ccnumber">Division</label>
                                <input class="form-control" id="ccnumber" type="text" placeholder="enter division name" style="width:400px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <h3>A. OPERATIONS</h3>
                <hr>
            </div>

            <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:lightblue; border-radius: 10px">
                <div class="container">

                    <div><strong>I. DIFFUSION AND TRANSFER OF KNOWLEDGE AND TECHNOLOGIES;
                            AND OTHER RELATED PROJECTS AND ACTIVITIES</strong>
                        <hr>
                    </div>


                    <table style="border-collapse: collapse">

                        <tr>

                            <td>
                                <label for="ccmonth"><br>OUTPUT</label>
                                <input class="form-control" id="cvv" type="text" style="width:150px">
                            </td>
                            <td>

                                <label for="ccmonth"><br>SUCCESS INDICATORS</label>
                                <input class="form-control" id="cvv" type="text" style="width:150px">

                            </td>
                            <td>

                                <label for="ccmonth">ACTUAL ACCOMPLISHMENTS</label>
                                <input class="form-control" id="cvv" type="text" style="width:150px">

                            </td>

                            <td>
                                <label for="ccmonth"><br>QUALITY</label>
                                <input class="form-control" id="cvv" type="text" style="width:50px">
                            </td>
                            <td>
                                <label for="ccmonth"><br>EFFICIENCY</label>
                                <input class="form-control" id="cvv" type="text" style="width:50px">
                            </td>
                            <td>
                                <label for="ccmonth"><br>TIMELINESS</label>
                                <input class="form-control" id="cvv" type="text" style="width:50px">
                            </td>
                            <td>
                                <label for="ccmonth"><br>AVERAGE</label>
                                <input class="form-control" id="cvv" type="text" style="width:50px">
                            </td>

                            <td>
                                <label for="ccmonth"><br>REMARKS</label>
                                <input class="form-control" id="cvv" type="text" style="width:150px">
                            </td>

                        </tr>


                    </table>
                    <br>
                    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="width:200px; margin-left:-10px">
                        <button class="btn btn-block btn-info active" type="button" aria-pressed="true">ADD NEW ROW</button>
                    </div>





                </div>
            </div>





</body>


@endsection