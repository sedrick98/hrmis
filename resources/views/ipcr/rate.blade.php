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
    #entries,
    #entry {
        border: 2px solid black;
        text-align: center;
        vertical-align: middle;
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

    <form action="{{ route('ipcr-rate') }}" method="post" autocomplete="false">
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


                        <!-- employee info-->
                        <div class="row">
                            <div class="form-group col-sm-4" style="margin-left:30px;">
                                <table>
                                    <tr>
                                        <td style="width:100px">First Name:</td>
                                        <td><u><strong>{{strtoupper($form->first()->first_name)}}</strong></u></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="form-group col-sm-4" style="margin-left:-70px;">
                                <table>
                                    <tr>
                                        <td style="width:100px">Middle Name:</td>
                                        <td><u><strong>{{strtoupper($form->first()->middle_name)}}</strong></u></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-4" style="margin-left:-70px;">
                                <table>
                                    <tr>
                                        <td style="width:100px">Last Name:</td>
                                        <td><u><strong>{{strtoupper($form->first()->last_name)}}</strong></u></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="form-group col-sm-4" style="margin-left:30px;">
                                <table>
                                    <tr>
                                        <td style="width:100px">Division:</td>
                                        <td><u><strong>{{strtoupper($form->first()->division)}}</strong></u></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--end of employee info-->

                        <hr>
                        <table class="table table-responsive-sm table-bordered" id="entries">
                            <tr>
                                <td id="entry" colspan="5" style="padding:0px"><strong>RATING SCALE</strong></td>
                            </tr>
                            <tr>
                                <td id="entry"><strong>5 - Outstanding</strong><br>130% and above</td>
                                <td id="entry"><strong>4 - Very Satisfactory</strong><br>115% - 129%</td>
                                <td id="entry"><strong>3 - Satisfactory</strong><br>90% - 114%</td>
                                <td id="entry"><strong>2 - Unsatisfactory</strong><br>51% - 89%</td>
                                <td id="entry"><strong>1 - Poor</strong><br>51% - 89%</td>
                            </tr>
                        </table>


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

                            <table class="table table-responsive-sm table-bordered" id="entries">
                                <thead>
                                    <tr>
                                        <th id="entry" rowspan="2"><strong>OUTPUTS</strong></th>
                                        <th id="entry" rowspan="2"><strong>SUCCESS INDICATORS</strong> (Targets + Measures)</th>
                                        <th id="entry" rowspan="2"><strong>ACTUAL ACCOMPLISHMENTS</strong></th>
                                        <th id="entry" colspan="3"><strong>RATING</strong></th>
                                        <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                    </tr>
                                    <tr>
                                        <td id="entry"><strong>Q</strong></td>
                                        <td id="entry"><strong>E</strong></td>
                                        <td id="entry"><strong>T</strong></td>
                                    </tr>
                                </thead>

                                <!--fetching data for operations/a-->
                                <tbody>

                                    @foreach($operation as $operations)
                                    @if($operations->o_type=='a')
                                    <tr>
                                        <td id="entry" style="text-align:left;">
                                            <input type="hidden" name="a_id[]" value="{{$operations->o_id}}">
                                            {{$operations->o_output}}
                                        </td>
                                        <td id="entry" style="text-align:left">{{$operations->o_success_indicator}}</td>
                                        <td id="entry" style="text-align:left">{{$operations->o_actual_accomplishment}}</td>
                                        <td id="entry"><input type="number" name="i_q[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                        <td id="entry"><input type="number" name="i_e[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                        <td id="entry"><input type="number" name="i_t[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                        <td id="entry">
                                            <textarea class="form-control" name="i_remarks[]" id="textarea-input" rows="2"></textarea>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    <!--end of operations/a-->
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


                            <table class="table table-responsive-sm table-bordered" id="entries">
                                <thead>
                                    <tr>
                                        <th id="entry" rowspan="2"><strong>OUTPUTS</strong></th>
                                        <th id="entry" rowspan="2"><strong>SUCCESS INDICATORS</strong> (Targets + Measures)</th>
                                        <th id="entry" rowspan="2"><strong>ACTUAL ACCOMPLISHMENTS</strong></th>
                                        <th id="entry" colspan="3"><strong>RATING</strong></th>
                                        <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                    </tr>
                                    <tr>
                                        <td id="entry"><strong>Q</strong></td>
                                        <td id="entry"><strong>E</strong></td>
                                        <td id="entry"><strong>T</strong></td>
                                    </tr>
                                </thead>

                                <!--fetching data for operations/b-->
                                <tbody>

                                    @foreach($operation as $operations)
                                    @if($operations->o_type=='b')
                                    <tr>
                                        <td id="entry" style="text-align:left;">
                                            <input type="hidden" name="b_id[]" value="{{$operations->o_id}}">
                                            {{$operations->o_output}}
                                        </td>
                                        <td id="entry" style="text-align:left">{{$operations->o_success_indicator}}</td>
                                        <td id="entry" style="text-align:left">{{$operations->o_actual_accomplishment}}</td>
                                        <td id="entry"><input type="number" name="ii_q[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                        <td id="entry"><input type="number" name="ii_e[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                        <td id="entry"><input type="number" name="ii_t[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                        <td id="entry">
                                            <textarea class="form-control" name="ii_remarks[]" id="textarea-input" rows="2"></textarea>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    <!--end of operations/b-->
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


                                <table class="table table-responsive-sm table-bordered" id="entries">
                                    <thead>
                                        <tr>
                                            <th id="entry" rowspan="2"><strong>OUTPUTS</strong></th>
                                            <th id="entry" rowspan="2"><strong>SUCCESS INDICATORS</strong> (Targets + Measures)</th>
                                            <th id="entry" rowspan="2"><strong>ACTUAL ACCOMPLISHMENTS</strong></th>
                                            <th id="entry" colspan="3"><strong>RATING</strong></th>
                                            <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                        </tr>
                                        <tr>
                                            <td id="entry"><strong>Q</strong></td>
                                            <td id="entry"><strong>E</strong></td>
                                            <td id="entry"><strong>T</strong></td>
                                        </tr>
                                    </thead>

                                    <!--fetching data for admin services-->
                                    <tbody>

                                        @foreach($gen as $gens)
                                        <tr>
                                            <td id="entry" style="text-align:left;">
                                                <input type="hidden" name="g_id[]" value="{{$gens->g_id}}">
                                                {{$gens->g_output}}
                                            </td>
                                            <td id="entry" style="text-align:left">{{$gens->g_success_indicator}}</td>
                                            <td id="entry" style="text-align:left">{{$gens->g_actual_accomplishment}}</td>
                                            <td id="entry"><input type="number" name="g_q[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry"><input type="number" name="g_e[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry"><input type="number" name="g_t[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry">
                                                <textarea class="form-control" name="g_remarks[]" id="textarea-input" rows="2"></textarea>
                                            </td>
                                        </tr>
                                        @endforeach

                                        <!--end of admin services-->
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


                                <table class="table table-responsive-sm table-bordered" id="entries">
                                    <thead>
                                        <tr>
                                            <th id="entry" rowspan="2"><strong>OUTPUTS</strong></th>
                                            <th id="entry" rowspan="2"><strong>SUCCESS INDICATORS</strong> (Targets + Measures)</th>
                                            <th id="entry" rowspan="2"><strong>ACTUAL ACCOMPLISHMENTS</strong></th>
                                            <th id="entry" colspan="3"><strong>RATING</strong></th>
                                            <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                        </tr>
                                        <tr>
                                            <td id="entry"><strong>Q</strong></td>
                                            <td id="entry"><strong>E</strong></td>
                                            <td id="entry"><strong>T</strong></td>
                                        </tr>
                                    </thead>

                                    <!--fetching data for support-->
                                    <tbody>

                                        @foreach($support as $supports)
                                        <tr>
                                            <td id="entry" style="text-align:left;">
                                                <input type="hidden" name="s_id[]" value="{{$supports->s_id}}">
                                                {{$supports->s_output}}
                                            </td>
                                            <td id="entry" style="text-align:left">{{$supports->s_success_indicator}}</td>
                                            <td id="entry" style="text-align:left">{{$supports->s_actual_accomplishment}}</td>
                                            <td id="entry"><input type="number" name="s_q[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry"><input type="number" name="s_e[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry"><input type="number" name="s_t[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry">
                                                <textarea class="form-control" name="s_remarks[]" id="textarea-input" rows="2"></textarea>
                                            </td>
                                        </tr>
                                        @endforeach

                                        <!--end of admin support-->
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


                                <table class="table table-responsive-sm table-bordered" id="entries">
                                    <thead>
                                        <tr>
                                            <th id="entry" rowspan="2"><strong>OUTPUTS</strong></th>
                                            <th id="entry" rowspan="2"><strong>SUCCESS INDICATORS</strong> (Targets + Measures)</th>
                                            <th id="entry" rowspan="2"><strong>ACTUAL ACCOMPLISHMENTS</strong></th>
                                            <th id="entry" colspan="3"><strong>RATING</strong></th>
                                            <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                        </tr>
                                        <tr>
                                            <td id="entry"><strong>Q</strong></td>
                                            <td id="entry"><strong>E</strong></td>
                                            <td id="entry"><strong>T</strong></td>
                                        </tr>
                                    </thead>

                                    <!--fetching data for innovation-->
                                    <tbody>

                                        @foreach($innovation as $innovations)
                                        <tr>
                                            <td id="entry" style="text-align:left;">
                                                <input type="hidden" name="i_id[]" value="{{$innovations->i_id}}">
                                                {{$innovations->i_output}}
                                            </td>
                                            <td id="entry" style="text-align:left">{{$innovations->i_success_indicator}}</td>
                                            <td id="entry" style="text-align:left">{{$innovations->i_actual_accomplishment}}</td>
                                            <td id="entry"><input type="number" name="nn_q[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry"><input type="number" name="nn_e[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry"><input type="number" name="nn_t[]" min="1" max="5" style="width:35px; height: 40px" required></td>
                                            <td id="entry">
                                                <textarea class="form-control" name="nn_remarks[]" id="textarea-input" rows="2"></textarea>
                                            </td>
                                        </tr>
                                        @endforeach

                                        <!--end of admin innovation-->
                                    </tbody>
                                </table>





                            </div>
                        </div>
                    </div><br>
                </div>


                <div class="row">
                    <button class="btn btn-outline-success active" id="btn" type="submit" aria-pressed="true" style="margin-right:10px">
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