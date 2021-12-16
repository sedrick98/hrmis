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

    <form action="{{ route('ipcr-approve') }}" method="post" autocomplete="false">
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
                        <div class="form-group col-sm-4" style="margin-left:15px;">
                            <table>
                                <tr>
                                    <td style="width:100px">Duration:</td>
                                    <input type="hidden" name="ipcr_id" value="{{$info->id}}" style="width:150px">
                                    <td><u><strong>{{strtoupper($info->duration_1)}} to {{strtoupper($info->duration_2)}} {{$info->year}}</strong></u></td>
                                </tr>
                            </table>
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
                                        <th id="entry" colspan="4"><strong>RATING</strong></th>
                                        <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                    </tr>
                                    <tr>
                                        <td id="entry"><strong>Q</strong></td>
                                        <td id="entry"><strong>E</strong></td>
                                        <td id="entry"><strong>T</strong></td>
                                        <td id="entry"><strong>A</strong></td>
                                    </tr>
                                </thead>

                                <!--fetching data for operations/a-->
                                <tbody>
                                    @foreach($operation as $operations)
                                    @if($operations->o_type=='a')
                                    <tr>
                                        <td id="entry" style="text-align:left;">
                                            {{$operations->o_output}}
                                        </td>
                                        <td id="entry" style="text-align:left">{{$operations->o_success_indicator}}</td>
                                        <td id="entry" style="text-align:left">{{$operations->o_actual_accomplishment}}</td>
                                        <td id="entry">{{$operations->o_quality}}</td>
                                        <td id="entry">{{$operations->o_efficiency}}</td>
                                        <td id="entry">{{$operations->o_timeliness}}</td>
                                        <td id="entry">{{$operations->o_average}}</td>
                                        <td id="entry">{{$operations->o_remarks}}</td>
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
                                        <th id="entry" colspan="4"><strong>RATING</strong></th>
                                        <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                    </tr>
                                    <tr>
                                        <td id="entry"><strong>Q</strong></td>
                                        <td id="entry"><strong>E</strong></td>
                                        <td id="entry"><strong>T</strong></td>
                                        <td id="entry"><strong>A</strong></td>
                                    </tr>
                                </thead>

                                <!--fetching data for operations/b-->
                                <tbody>

                                    @foreach($operation as $operations)
                                    @if($operations->o_type=='b')
                                    <tr>
                                        <td id="entry" style="text-align:left;">
                                            {{$operations->o_output}}
                                        </td>
                                        <td id="entry" style="text-align:left">{{$operations->o_success_indicator}}</td>
                                        <td id="entry" style="text-align:left">{{$operations->o_actual_accomplishment}}</td>
                                        <td id="entry">{{$operations->o_quality}}</td>
                                        <td id="entry">{{$operations->o_efficiency}}</td>
                                        <td id="entry">{{$operations->o_timeliness}}</td>
                                        <td id="entry">{{$operations->o_average}}</td>
                                        <td id="entry">{{$operations->o_remarks}}</td>
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
                                            <th id="entry" colspan="4"><strong>RATING</strong></th>
                                            <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                        </tr>
                                        <tr>
                                            <td id="entry"><strong>Q</strong></td>
                                            <td id="entry"><strong>E</strong></td>
                                            <td id="entry"><strong>T</strong></td>
                                            <td id="entry"><strong>A</strong></td>
                                        </tr>
                                    </thead>

                                    <!--fetching data for admin services-->
                                    <tbody>

                                        @foreach($gen as $gens)
                                        <tr>
                                            <td id="entry" style="text-align:left;">
                                                {{$gens->g_output}}
                                            </td>
                                            <td id="entry" style="text-align:left">{{$gens->g_success_indicator}}</td>
                                            <td id="entry" style="text-align:left">{{$gens->g_actual_accomplishment}}</td>
                                            <td id="entry">{{$gens->g_quality}}</td>
                                            <td id="entry">{{$gens->g_efficiency}}</td>
                                            <td id="entry">{{$gens->g_timeliness}}</td>
                                            <td id="entry">{{$gens->g_average}}</td>
                                            <td id="entry">{{$gens->g_remarks}}</td>
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
                                            <th id="entry" colspan="4"><strong>RATING</strong></th>
                                            <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                        </tr>
                                        <tr>
                                            <td id="entry"><strong>Q</strong></td>
                                            <td id="entry"><strong>E</strong></td>
                                            <td id="entry"><strong>T</strong></td>
                                            <td id="entry"><strong>A</strong></td>
                                        </tr>
                                    </thead>

                                    <!--fetching data for support-->
                                    <tbody>

                                        @foreach($support as $supports)
                                        <tr>
                                            <td id="entry" style="text-align:left;">
                                                {{$supports->s_output}}
                                            </td>
                                            <td id="entry" style="text-align:left">{{$supports->s_success_indicator}}</td>
                                            <td id="entry" style="text-align:left">{{$supports->s_actual_accomplishment}}</td>
                                            <td id="entry">{{$supports->s_quality}}</td>
                                            <td id="entry">{{$supports->s_efficiency}}</td>
                                            <td id="entry">{{$supports->s_timeliness}}</td>
                                            <td id="entry">{{$supports->s_average}}</td>
                                            <td id="entry">{{$supports->s_remarks}}</td>
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
                                            <th id="entry" colspan="4"><strong>RATING</strong></th>
                                            <th id="entry" rowspan="2"><strong>REMARKS</strong></th>
                                        </tr>
                                        <tr>
                                            <td id="entry"><strong>Q</strong></td>
                                            <td id="entry"><strong>E</strong></td>
                                            <td id="entry"><strong>T</strong></td>
                                            <td id="entry"><strong>A</strong></td>
                                        </tr>
                                    </thead>

                                    <!--fetching data for innovation-->
                                    <tbody>

                                        @foreach($innovation as $innovations)
                                        <tr>
                                            <td id="entry" style="text-align:left;">
                                                {{$innovations->i_output}}
                                            </td>
                                            <td id="entry" style="text-align:left">{{$innovations->i_success_indicator}}</td>
                                            <td id="entry" style="text-align:left">{{$innovations->i_actual_accomplishment}}</td>
                                            <td id="entry">{{$innovations->i_quality}}</td>
                                            <td id="entry">{{$innovations->i_efficiency}}</td>
                                            <td id="entry">{{$innovations->i_timeliness}}</td>
                                            <td id="entry">{{$innovations->i_average}}</td>
                                            <td id="entry">{{$innovations->i_remarks}}</td>
                                        </tr>
                                        @endforeach

                                        <!--end of admin innovation-->
                                    </tbody>
                                </table>





                            </div>
                        </div>
                    </div><br>
                </div>





                <hr>
                <div class="jumbotron jumbotron-fluid" style="padding:20px; box-shadow: 5px 10px 8px #888888; background-color:lightblue; border-radius: 10px">
                    <div>
                        <strong>Comments and Recommendations for Developmental Purposes</strong>
                        <hr>
                        <div class="container">
                            @if(strtolower(Auth::user()->roleName()) == 'employee'
                            && $info->status != 'approved:ard - division head')
                            <div class="card-body" style="background-color:#F5F5F5; border-radius:10px; padding:auto; text-align: center;">
                                <textarea class="form-control" id="textarea-input" 
                                name="comment" rows="18" 
                                style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:100%"
                                readonly="readonly">{{$info->comment}}</textarea>
                            </div>
                            @else
                            <div class="card-body" style="background-color:#F5F5F5; border-radius:10px; padding:auto; text-align: center;">
                                <textarea class="form-control" id="textarea-input" 
                                name="comment" rows="18" 
                                style="margin-top: 0px; margin-bottom: 0px; height: 50px; width:100%"
                                >{{$info->comment}}</textarea>
                            </div>
                            @endif
                        </div>
                    </div><br>
                </div>



                @if(strtolower(Auth::user()->roleName()) == 'ard - section head'
                && $info->status != 'approved:ard - division head'
                && $info->status != 'approved:rd')
                <div class="row">
                    <button class="btn btn-outline-success active" name="action" value="approve" onclick="return myFunction();" id="btn" type="submit" aria-pressed="true" style="margin-right:10px">
                        <h5>APPROVE</h5>
                    </button>

                    <button class="btn btn-outline-danger active" name="action" value="return" onclick="return reFunction();" id="btn" type="submit" aria-pressed="true" style="margin-left:10px">
                        <h5>RETURN</h5>
                    </button>
                </div><br>
                @endif

                @if(strtolower(Auth::user()->roleName()) == 'ard - division head'
                && $info->status != 'approved:rd')
                <div class="row">
                    <button class="btn btn-outline-success active" name="action" value="approve" onclick="return myFunction();" id="btn" type="submit" aria-pressed="true" style="margin-right:10px">
                        <h5>APPROVE</h5>
                    </button>

                    <button class="btn btn-outline-danger active" name="action" value="return" onclick="return reFunction();" id="btn" type="submit" aria-pressed="true" style="margin-left:10px">
                        <h5>RETURN</h5>
                    </button>
                </div><br>
                @endif

                @if(strtolower(Auth::user()->roleName()) == 'rd')
                <div class="row">
                    <button class="btn btn-outline-success active" name="action" value="approve" onclick="return myFunction();" id="btn" type="submit" aria-pressed="true" style="margin-right:10px">
                        <h5>APPROVE</h5>
                    </button>

                    <button class="btn btn-outline-danger active" name="action" value="return" onclick="return reFunction();" id="btn" type="submit" aria-pressed="true" style="margin-left:10px">
                        <h5>RETURN</h5>
                    </button>
                </div><br>
                @endif

            </div>
        </div>

    </form>


</body>




</html>


@endsection

@section('after-scripts')
<script>
    function myFunction() {
        if (!confirm("Approve this form?"))
            event.preventDefault();
    }

    function reFunction() {
        if (!confirm("Return this form?"))
            event.preventDefault();
    }
</script>
@endsection