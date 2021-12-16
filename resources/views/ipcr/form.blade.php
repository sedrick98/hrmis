@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha512-hwwdtOTYkQwW2sedIsbuP1h0mWeJe/hFOfsvNKpRB3CkRxq8EW7QMheec1Sgd8prYxGm1OM9OZcGW7/GUud5Fw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js" integrity="sha512-XVz1P4Cymt04puwm5OITPm5gylyyj5vkahvf64T8xlt/ybeTpz4oHqJVIeDtDoF5kSrXMOUmdYewE4JS/4RWAA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')

<style>
    table,
    td,
    th {
        text-align: center;
        padding: 5px;
    }

    #cvv {
        width: 70px;
        margin: auto
    }

    #cv {
        width: 165px;
        margin: auto
    }

    #btn {
        width: 300px;
        display: block;
        margin: auto;
    }
</style>


<html>


<body>


    @include('includes/sidebar')

    <form action="{{ route('ipcr-save') }}" method="post" autocomplete="false">
        @csrf

        @if (Session::has('success'))
        <div class="alert alert-block" style="border-color:#2E8B57; background-color:#98FB98; margin:20px; margin-top:0px; box-shadow: 5px 10px 8px #888888;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
        @endif


        <div class="card" style="margin:15px; margin-top:0px">
            <div class="card-header">
                <h3>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) FORM</h3>
            </div>
            <div class="card-body">
                <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:#E6E6FA; border-radius: 10px; box-shadow: 5px 10px 8px #888888;">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="ccmonth">First Name</label>
                                <input class="form-control" type="text" name="first_name" value="{{strtoupper(Auth::user()->first_name)}}" readonly="readonly">
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="ccyear">Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="{{strtoupper(Auth::user()->last_name)}}" readonly="readonly">

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cvv">Middle Initial</label>
                                    <input class="form-control" type="text" name="middle_name" value="{{strtoupper(Auth::user()->middle_name)}}" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ccnumber">Division</label>
                                    <input class="form-control" name="division" type="text" value="{{strtoupper(Auth::user()->division)}}" readonly="readonly" style="width:400px" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="ccmonth">Duration - From</label>
                                <input class="form-control" type="text" name="d_1" placeholder="month - from" required style="width:150px">
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                            <label for="ccmonth">Duration - To</label>
                                <input class="form-control" type="text" name="d_2" placeholder="month - to" required style="width:150px">

                                </select>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                <label for="ccmonth">Year</label>
                                    <input class="form-control" type="text" name="year" placeholder="year" required style="width:150px">
                                </div>
                            </div>
                        </div>



                    </div>




                </div>


                <div>
                    <h3>A. OPERATIONS</h3>
                    <hr>
                </div>
                <div class="jumbotron jumbotron-fluid" style="padding:20px; box-shadow: 5px 10px 8px #888888; background-color:lightblue; border-radius: 10px">
                    <div class="container">
                        <div>
                            <strong>I. DIFFUSION AND TRANSFER OF KNOWLEDGE AND TECHNOLOGIES;
                                AND OTHER RELATED PROJECTS AND ACTIVITIES</strong>
                            <hr>
                        </div>
                        <div class="card-body" style="background-color:#F5F5F5; border-radius:10px; padding:auto">
                            <table style="border-collapse: collapse">
                                <thead>
                                    <tr>
                                        <th>OUTPUT</th>
                                        <th>SUCCESS INDICATOR</th>
                                        <th>ACTUAL ACCOMPLISHMENTS</th>
                                    </tr>
                                </thead>
                                <tbody id="ops">
                                    <tr>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="i_output[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="i_indicator[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="i_accomplish[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                        </td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-primary" id="add_btn" style="padding:0px; width:30px"><i class="c-icon cil-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <br>
                    <div>
                        <div class="container">
                            <div><strong>II. ENHANCEMENT OF SCIENCE AND TECHNOLOGY PROJECTS/ACTIVITIES</strong>
                                <hr>
                            </div>
                        </div>
                        <div class="card-body" style="background-color:#F5F5F5;  border-radius:10px; padding:auto; margin-left:10px;margin-right:10px;">
                            <table style="border-collapse: collapse">
                                <thead>
                                    <tr>
                                        <th>OUTPUT</th>
                                        <th>SUCCESS INDICATOR</th>
                                        <th>ACTUAL ACCOMPLISHMENTS</th>
                                    </tr>
                                </thead>
                                <tbody id="ii">
                                    <tr>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="ii_output[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="ii_indicator[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="ii_accomplish[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                        </td>
                                        <td>
                                            <div>
                                                <button type="button" class="btn btn-primary" id="add_ii" style="padding:0px; width:30px"><i class="c-icon cil-plus"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><br>
                </div><br>

                <div>
                    <h3>B. GENERAL ADMINISTRATIVE SERVICES</h3>
                    <hr>
                </div>

                <div class="jumbotron jumbotron-fluid" style="padding:20px; box-shadow: 5px 10px 8px #888888; background-color:lightblue; border-radius: 10px">
                    <div>
                        <div class="container">
                            <div class="card-body" style="background-color:#F5F5F5; border-radius:10px; padding:auto">
                                <table style="border-collapse: collapse">
                                    <thead>
                                        <tr>
                                            <th>OUTPUT</th>
                                            <th>SUCCESS INDICATOR</th>
                                            <th>ACTUAL ACCOMPLISHMENTS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bb">
                                        <tr>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="bb_output[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="bb_indicator[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="bb_accomplish[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td>
                                                <div>
                                                    <button type="button" class="btn btn-primary" id="add_bb" style="padding:0px; width:30px"><i class="c-icon cil-plus"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br>
                </div><br>

                <div>
                    <h3>C. SUPPORT TO OPERATIONS</h3>
                    <hr>
                </div>

                <div class="jumbotron jumbotron-fluid" style="padding:20px; box-shadow: 5px 10px 8px #888888; background-color:lightblue; border-radius: 10px">
                    <div>
                        <div class="container">
                            <div class="card-body" style="background-color:#F5F5F5; border-radius:10px; padding:auto">
                                <table style="border-collapse: collapse">
                                    <thead>
                                        <tr>
                                            <th>OUTPUT</th>
                                            <th>SUCCESS INDICATOR</th>
                                            <th>ACTUAL ACCOMPLISHMENTS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ss">
                                        <tr>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="ss_output[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="ss_indicator[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="ss_accomplish[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td>
                                                <div>
                                                    <button type="button" class="btn btn-primary" id="add_ss" style="padding:0px; width:30px"><i class="c-icon cil-plus"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br>
                </div><br>

                <div>
                    <h3>D. INNOVATION</h3>
                    <hr>
                </div>

                <div class="jumbotron jumbotron-fluid" style="padding:20px; box-shadow: 5px 10px 8px #888888; background-color:lightblue; border-radius: 10px">
                    <div>
                        <div class="container">
                            <div class="card-body" style="background-color:#F5F5F5; border-radius:10px; padding:auto">
                                <table style="border-collapse: collapse">
                                    <thead>
                                        <tr>
                                            <th>OUTPUT</th>
                                            <th>SUCCESS INDICATOR</th>
                                            <th>ACTUAL ACCOMPLISHMENTS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="nn">
                                        <tr>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="nn_output[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="nn_indicator[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="nn_accomplish[0]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea>
                                            </td>
                                            <td>
                                                <div style=>
                                                    <button type="button" class="btn btn-primary" id="add_nn" style="padding:0px; width:30px"><i class="c-icon cil-plus"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br>
                </div>


                <div class="row">
                    <button class="btn btn-outline-success active" onclick="return myFunction();" id="btn" type="submit" aria-pressed="true" style="margin-right:10px">
                        <h5>SAVE</h5>
                    </button>

                    <button class="btn btn-outline-danger active" id="btn" type="button" aria-pressed="true" style="margin-left:10px" data-toggle="modal" data-target="#cancelModal">
                        <h5>CANCEL</h5>
                    </button>
                </div><br>
            </div>
        </div>

    </form>


    <!--Cancel Modal-->
    <div class="modal modal-danger" id="cancelModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top:100px">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header" style="height:10px;">
                    <p style="margin:-10px">Cancel</p>
                </div>
                <form action="{{ route('ipcr-submitted') }}" method="get">
                    @csrf
                    <div class="modal-body">

                        <div style="height:90px;"><br>
                            <h3>EXIT FORM?</h3>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm btn-success" type="button" data-dismiss="modal" style="width:70px; font-size: 16px;">NO</button>
                        <button class="btn btn-sm btn-warning" type="submit" style="width:70px; font-size: 16px;">YES</button>
                    </div>
                </form>
            </div>

        </div>
    </div>




</body>




</html>


@endsection

@section('after-scripts')
<script>
    var i = 0;
    $("#add_btn").click(function() {
        ++i;
        $("#ops").append('<tr><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="i_output[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="i_indicator[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="i_accomplish[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td><button type="button" class="btn btn-danger" id="remove_btn" style="padding:0px; width:30px"><i class="c-icon cil-x"></i></button></td></tr>')
    });

    $("#add_ii").click(function() {
        ++i;
        $("#ii").append('<tr><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="ii_output[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="ii_indicator[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="ii_accomplish[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td><button type="button" class="btn btn-danger" id="remove_btn" style="padding:0px; width:30px"><i class="c-icon cil-x"></i></button></td></tr>')
    });

    $(document).on('click', '#remove_btn', function() {
        $(this).closest('tr').remove();
    });
</script>

<script>
    $("#add_bb").click(function() {
        ++i;
        $("#bb").append('<tr><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="bb_output[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="bb_indicator[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="bb_accomplish[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td><button type="button" class="btn btn-danger" id="remove_btn" style="padding:0px; width:30px"><i class="c-icon cil-x"></i></button></td></tr>')

    });

    $(document).on('click', '#remove_btn', function() {
        $(this).closest('tr').remove();
    });

    $("#add_bb").click(function() {
        var count = document.getElementById('bb').rows.length;
        if (count == 10) {
            document.getElementById('add_bb').disabled = true;
        } else {
            document.getElementById('add_bb').disabled = false;
        }
    });

    $(document).on('click', '#remove_btn', function() {
        var count = document.getElementById('bb').rows.length;
        if (count != 5) {
            document.getElementById('add_bb').disabled = false;
        }
    });
</script>

<script>
    $("#add_ss").click(function() {
        ++i;
        $("#ss").append('<tr><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="ss_output[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="ss_indicator[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="ss_accomplish[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td><button type="button" class="btn btn-danger" id="remove_btn" style="padding:0px; width:30px"><i class="c-icon cil-x"></i></button></td></tr>')
    });

    $(document).on('click', '#remove_btn', function() {
        $(this).closest('tr').remove();
    });

    $("#add_ss").click(function() {
        var count = document.getElementById('ss').rows.length;
        if (count == 10) {
            document.getElementById('add_ss').disabled = true;
        } else {
            document.getElementById('add_ss').disabled = false;
        }
    });

    $(document).on('click', '#remove_btn', function() {
        var count = document.getElementById('ss').rows.length;
        if (count != 5) {
            document.getElementById('add_ss').disabled = false;
        }
    });
</script>

<script>
    $("#add_nn").click(function() {
        ++i;
        $("#nn").append('<tr><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="nn_output[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="nn_indicator[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td style="padding-right:20px"><textarea class="form-control" id="textarea-input" name="nn_accomplish[' + i + ']" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required></textarea></td><td><button type="button" class="btn btn-danger" id="remove_btn" style="padding:0px; width:30px"><i class="c-icon cil-x"></i></button></td></tr>')
    });

    $(document).on('click', '#remove_btn', function() {
        $(this).closest('tr').remove();
    });

    $("#add_nn").click(function() {
        var count = document.getElementById('nn').rows.length;
        if (count == 10) {
            document.getElementById('add_nn').disabled = true;
        } else {
            document.getElementById('add_nn').disabled = false;
        }
    });

    $(document).on('click', '#remove_btn', function() {
        var count = document.getElementById('nn').rows.length;
        if (count != 5) {
            document.getElementById('add_nn').disabled = false;
        }
    });
</script>

<script>
    function myFunction() {
        if (!confirm("Submit this file?"))
            event.preventDefault();
    }
</script>

@endsection