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

    <form action="{{ route('ipcr-update') }}" method="post" autocomplete="false">
        @csrf

        @if (Session::has('success'))
        <div class="alert alert-block" style="border-color:#2E8B57; background-color:#98FB98; margin:20px; margin-top:0px; box-shadow: 5px 10px 8px #888888;">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
        @endif


        <!-- <input type="hidden" name="id" value="{{$info->employee}}"> -->

        <div class="card" style="margin:15px; margin-top:0px">
            <div class="card-header">
                <h3>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) FORM</h3>
            </div>
            <div class="card-body">
                <div class="jumbotron jumbotron-fluid" style="padding:20px; background-color:lightblue; border-radius: 10px; box-shadow: 5px 10px 8px #888888;">
                    <div class="container">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="ccmonth">First Name</label>
                                <input class="form-control" type="text" name="first_name" value="{{$form->first()->first_name}}" readonly="readonly">
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="ccyear">Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="{{$form->first()->last_name}}" readonly="readonly">

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="cvv">Middle Initial</label>
                                    <input class="form-control" type="text" name="middle_name" value="{{$form->first()->middle_name}}" readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="ccnumber">Division</label>
                                    <input class="form-control" name="division" type="text" value="{{$form->first()->division}}" style="width:400px" readonly="readonly">
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
                            <table style="border-collapse: collapse; margin-left:40px;">
                                <thead>
                                    <tr>
                                        <th colspan="2">OUTPUT</th>
                                        <th>SUCCESS INDICATOR</th>
                                        <th>ACTUAL ACCOMPLISHMENTS</th>
                                    </tr>
                                </thead>
                                <tbody id="ops">
                                    @foreach($operation as $operations)
                                    @if($operations->o_type=='a')

                                    <tr>
                                        <td>
                                            <input type="hidden" name="a_id[]" value="{{$operations->o_id}}">
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" name="i_output[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$operations->o_output}}</textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" name="i_indicator[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$operations->o_success_indicator}}</textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" name="i_accomplish[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$operations->o_actual_accomplishment}}</textarea>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach
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
                            <table style="border-collapse: collapse; margin-left:40px;">
                                <thead>
                                    <tr>
                                        <th colspan="2">OUTPUT</th>
                                        <th>SUCCESS INDICATOR</th>
                                        <th>ACTUAL ACCOMPLISHMENTS</th>
                                    </tr>
                                </thead>
                                <tbody id="ii">
                                    @foreach($operation as $operations)
                                    @if($operations->o_type=='b')
                                    <tr>
                                        <td>
                                            <input type="hidden" name="b_id[]" value="{{$operations->o_id}}">
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="ii_output[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$operations->o_output}}</textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="ii_indicator[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$operations->o_success_indicator}}</textarea>
                                        </td>
                                        <td style="padding-right:20px">
                                            <textarea class="form-control" id="textarea-input" name="ii_accomplish[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$operations->o_actual_accomplishment}}</textarea>
                                        </td>

                                    </tr>
                                    @endif
                                    @endforeach
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
                                <table style="border-collapse: collapse; margin-left:40px;">
                                    <thead>
                                        <tr>
                                            <th colspan="2">OUTPUT</th>
                                            <th>SUCCESS INDICATOR</th>
                                            <th>ACTUAL ACCOMPLISHMENTS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bb">
                                        @foreach($gen as $gens)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="g_id[]" value="{{$gens->g_id}}">
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="bb_output[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$gens->g_output}}</textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="bb_indicator[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$gens->g_success_indicator}}</textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="bb_accomplish[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$gens->g_actual_accomplishment}}</textarea>
                                            </td>

                                        </tr>
                                        @endforeach
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
                                <table style="border-collapse: collapse; margin-left:40px;">
                                    <thead>
                                        <tr>
                                            <th colspan="2">OUTPUT</th>
                                            <th>SUCCESS INDICATOR</th>
                                            <th>ACTUAL ACCOMPLISHMENTS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ss">
                                        @foreach($support as $supports)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="s_id[]" value="{{$supports->s_id}}">
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="ss_output[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$supports->s_output}}</textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="ss_indicator[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$supports->s_success_indicator}}</textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="ss_accomplish[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$supports->s_actual_accomplishment}}</textarea>
                                            </td>

                                        </tr>
                                        @endforeach
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
                                <table style="border-collapse: collapse; margin-left:40px;">
                                    <thead>
                                        <tr>
                                            <th colspan="2">OUTPUT</th>
                                            <th>SUCCESS INDICATOR</th>
                                            <th>ACTUAL ACCOMPLISHMENTS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="nn">
                                        @foreach($innovation as $innovations)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="i_id[]" value="{{$innovations->i_id}}">
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="nn_output[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$innovations->i_output}}</textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="nn_indicator[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$innovations->i_success_indicator}}</textarea>
                                            </td>
                                            <td style="padding-right:20px">
                                                <textarea class="form-control" id="textarea-input" name="nn_accomplish[]" rows="9" style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:250px" required>{{$innovations->i_actual_accomplishment}}</textarea>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><br>
                </div>


                <div class="row">
                    <button class="btn btn-outline-success active" id="btn" type="submit" aria-pressed="true" style="margin-right:10px">
                        <h5>UPDATE</h5>
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
                            <h3>DISCARD CHANGES?</h3>
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