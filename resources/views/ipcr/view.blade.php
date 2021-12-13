@extends('layouts.print')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')

<style>
    #review,
    #rev {
        border: 2px solid black;
        border-collapse: collapse;
        margin-left: -2px;
        margin-top: 100px
    }

    #entries,
    #entry {
        border: 2px solid black;
        border-collapse: collapse;

    }
</style>

<html>


<body>


    <div class="card" style="margin:20px; margin-top:-20px; color:black; font-size:12px; font-family:Arial, Helvetica, sans-serif">
        <div class="card-body">
            <div class="row">
                <img src="{{asset('images/logos/dost-logo.png')}}" alt="DOST 11 Logo" style="height:70px; width:400px; margin-left:70px; margin-top:40px">
                <img src="{{asset('images/logos/socotec.jpg')}}" alt="ISO Logo" style="height:70px; width:150px; margin-top:40px">
                <img src="{{asset('images/logos/pqa.png')}}" alt="pqa Logo" style="height:70px; width:100px; margin-top:40px">
            </div>
            <p style="margin-left:58px; margin-top:-2px">
                <strong>SPMS - Annex B</strong>
            </p>
            <p style="margin-left:58px; margin-top:-10px">
                <strong>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR) FORM</strong>
            </p>
        </div>

        <!--start of the table-->
        <div class="card-body" style="border-style:solid; margin:75px; margin-top:-35px; padding:0px">
            <br>
            <p style="text-align:center"><strong>INDIVIDUAL PERFORMANCE COMMITMENT AND REVIEW (IPCR)</strong></p>
            <div>
                <p>I, <u><strong>{{strtoupper($form->first()->first_name)}} {{strtoupper($form->first()->middle_name)}} {{strtoupper($form->first()->last_name)}}</strong></u>, of <u><strong>{{strtoupper($division->first()->name)}} </strong></u> (Division) of the Department of Science and Technology Regional Office XI, commit to deliver and agree to be rated
                    on the attainment of the following targets in accordance with the indicated measures for the period of <u><strong>{{strtoupper($form->first()->duration_1)}} to {{strtoupper($form->first()->duration_2)}}, {{$form->first()->year}}</strong></u>.
                <p style="margin-top:-20px; margin-left:410px;">(month) (month) (year)</p>
                </p>
            </div>

            <!--employee part-->
            <div>
                <table style="float:right; margin-right:100px; margin-top:25px">
                    <tr>
                        <td style="padding-right:10px"><u><strong>{{strtoupper($form->first()->first_name)}} {{strtoupper($form->first()->last_name)}}</strong></u></td>
                        <td><u><strong>{{$form->first()->created_at->format('F d, Y')}}</strong></u></td>
                    </tr>
                    <tr>
                        <td style="text-align:center">Employee</td>
                        <td style="text-align:center">Date</td>
                    </tr>
                </table>
            </div>


            <!--review and approve part-->
            <div>
                <!--review part-->
                <table id="review">
                    <tr>
                        <th id="rev" style="width:200px">Reviewed by:</th>
                        <th id="rev" style="width:130px"></th>
                    </tr>
                    <tr>
                        <td id="rev" style="text-align:center"><br><br><strong>{{strtoupper($sec->first()->first_name)}} {{strtoupper($sec->first()->last_name)}}</strong></td>
                        <td id="rev" style="text-align:center"><br><br><strong>{{$form->first()->date_1}}</strong></td>
                    </tr>
                    <tr>
                        <td id="rev" style="text-align:center">Immediate Supervisor</td>
                        <td id="rev" style="text-align:center">Date</td>
                    </tr>
                </table>

                <!--approve part-->
                <table id="review" style="float:right; margin-top:-95px; margin-right:20px">
                    <tr>
                        <th id="rev" style="width:300px">Approved by:</th>
                        <th id="rev" style="width:130px"></th>
                    </tr>
                    <tr>
                        <td id="rev" style="text-align:center"><br><br><strong>{{strtoupper($rhead->first()->first_name)}} {{strtoupper($rhead->first()->last_name)}}</strong></td>
                        <td id="rev" style="text-align:center"><br><br><strong>{{$form->first()->updated_at->format('m-d-Y')}}</strong></td>
                    </tr>
                    <tr>
                        <td id="rev" style="text-align:center">Regional Director</td>
                        <td id="rev" style="text-align:center">Date</td>
                    </tr>
                </table>

            </div>
            <!--end of review and approve part-->
            <br>

        </div>
        <!--end of the table-->

        <!---->

        <!--Entries start-->
        <div>
            <table id="entries" style="margin:75px; margin-top:-77px; width:88.5%">
                <tr>
                    <th id="entry" rowspan="2" style="text-align:center;"><strong>OUTPUTS</strong></th>
                    <th id="entry" rowspan="2" style="text-align:center;"><strong>SUCCESS INDICATORS</strong> (Targets + Measures)</th>
                    <th id="entry" rowspan="2" style="text-align:center;"><strong>ACTUAL ACCOMPLISHMENTS</strong></th>
                    <th id="entry" colspan="4" style="text-align:center;"><strong>RATING</strong></th>
                    <th id="entry" rowspan="2" style="text-align:center;"><strong>REMARKS</strong></th>
                </tr>
                <tr>
                    <td style="text-align:center;" id="entry"><strong>Q</strong></td>
                    <td style="text-align:center;" id="entry"><strong>E</strong></td>
                    <td style="text-align:center;" id="entry"><strong>T</strong></td>
                    <td style="text-align:center;" id="entry"><strong>A</strong></td>
                </tr>
                <tr>
                    <td id="entry" colspan="8" style="background-color:#A9A9A9"><strong>A. OPERATIONS</strong></td>
                </tr>
                <tr>
                    <td id="entry" colspan="8"><strong>S&T Program for Regional and Countryside Development</strong></td>
                </tr>
                <tr>
                    <td id="entry" colspan="8" style="text-align:center"><strong><i>I. DIFFUSION AND TRANSFER OF KNOWLEDGE AND TECHNOLOGIES; AND OTHER RELATED PROJECTS AND ACTIVITIES</i></strong></td>
                </tr>
                <tr>
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
                </tr>
                <tr>
                    <td id="entry" colspan="8" style="text-align:center"><strong><i>II. ENHANCEMENT OF SCIENCE AND TECHNOLOGY PROJECTS/ACTIVITIES</i></strong></td>
                </tr>
                <tr>
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
                </tr>
                <tr>
                    <td id="entry" colspan="8" style="background-color:#A9A9A9"><strong>B. GENERAL ADMINISTRATIVE SERVICES</strong></td>
                </tr>
                <tr>
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
                </tr>
                <tr>
                    <td id="entry" colspan="8" style="background-color:#A9A9A9"><strong>C. SUPPORT TO OPERATIONS</strong></td>
                </tr>
                <tr>
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
                </tr>
                <tr>
                    <td id="entry" colspan="8" style="background-color:#A9A9A9"><strong>INNOVATION</strong></td>
                </tr>
                <tr>
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
                </tr>


            </table>


            <table style="margin:75px; margin-top:-75px; width:88.5%">
                <tr>
                    <td colspan="5" style="padding:0px"><strong>RATING SCALE</strong></td>
                </tr>
                <tr>
                    <td id="entry" style="text-align:center"><strong>5 - Outstanding</strong><br>130% and above</td>
                    <td id="entry" style="text-align:center"><strong>4 - Very Satisfactory</strong><br>115% - 129%</td>
                    <td id="entry" style="text-align:center"><strong>3 - Satisfactory</strong><br>90% - 114%</td>
                    <td id="entry" style="text-align:center"><strong>2 - Unsatisfactory</strong><br>51% - 89%</td>
                    <td id="entry" style="text-align:center"><strong>1 - Poor</strong><br>51% - 89%</td>
                </tr>
            </table>

            <table style="margin:75px; margin-top:-60px; width:88.5%">
                <tr>
                    <td colspan="5" style="padding:0px"><strong>SUMMARY OF RATINGS</strong></td>
                </tr>
                <tr>
                    <td id="entry" style="text-align:center"><strong>Category</strong></td>
                    <td id="entry" style="text-align:center"><strong>No. of Outputs</strong></td>
                    <td id="entry" style="text-align:center"><strong>Average Rating</strong></td>
                    <td id="entry" style="text-align:center"><strong>Weighted Allocation</strong></td>
                    <td id="entry" style="text-align:center"><strong>Final Rating</strong></td>
                </tr>
                <tr>
                    <td id="entry">A. Operations</td>
                    <td id="entry" style="text-align:center">{{$oc}}</td>
                    <td id="entry" style="text-align:center">{{$oave}}</td>
                    <td id="entry" style="text-align:center">0%</td>
                    <td id="entry" style="text-align:center">{{$of}}</td>
                </tr>
                <tr>
                    <td id="entry">B. General Administrative Services</td>
                    <td id="entry" style="text-align:center">{{$gc}}</td>
                    <td id="entry" style="text-align:center">{{$gave}}</td>
                    <td id="entry" style="text-align:center">60%</td>
                    <td id="entry" style="text-align:center">{{$gf}}</td>
                </tr>
                <tr>
                    <td id="entry">C. Support to Operations</td>
                    <td id="entry" style="text-align:center">{{$sc}}</td>
                    <td id="entry" style="text-align:center">{{$save}}</td>
                    <td id="entry" style="text-align:center">20%</td>
                    <td id="entry" style="text-align:center">{{$sf}}</td>
                </tr>
                <tr>
                    <td id="entry">Innovation</td>
                    <td id="entry" style="text-align:center">{{$ic}}</td>
                    <td id="entry" style="text-align:center">{{$iave}}</td>
                    <td id="entry" style="text-align:center">20%</td>
                    <td id="entry" style="text-align:center">{{$if}}</td>
                </tr>
                <tr>
                    <td id="entry" colspan="4" style="text-align:right; background-color:#A9A9A9"><b>Final Average Rating</b></td>
                    <td id="entry">{{$score}}</td>
                </tr>
                <tr>
                    <td id="entry" colspan="4" style="text-align:right"><b>Adjectival Rating</b></td>
                    <td id="entry">
                    {{$arating}}
                    </td>
                </tr>
                <tr>
                    <td id="entry" colspan="5"><b>Comments and Recommendations for Developmental Purposes</b></td>
                </tr>
                <tr>
                    <td id="entry" colspan="5" style="height:100px">
                    {{$form->first()->comment}}</td>
                </tr>
            </table>

            <table style="margin:75px; margin-top:-60px; width:88.5%">
                <tr>
                    <td id="entry" colspan="2"><b>Discussed with:</b></td>
                    <td id="entry" colspan="2"><b>Assessed by:</b></td>
                    <td id="entry" colspan="2"><b>Final Rating by:</b></td>
                </tr>
                <tr>
                    <td rowspan="2" id="entry" style="vertical-align:bottom; text-align:center"><br><b>{{strtoupper($form->first()->first_name)}} {{strtoupper($form->first()->last_name)}}</b></td>
                    <td rowspan="2" id="entry" style="vertical-align:bottom; text-align:center"><br>{{$form->first()->created_at->format('m-d-Y')}}</td>
                    <td id="entry"> certify that I discussed my assessment of
                        performance with the employee.
                    </td>
                    <td rowspan="2" id="entry" style="vertical-align:bottom; text-align:center"><br>{{$form->first()->date_2}}</td>
                    <td rowspan="2" id="entry" style="vertical-align:bottom; text-align:center"><b><br>{{strtoupper($rhead->first()->first_name)}} {{strtoupper($rhead->first()->last_name)}}</b></td>
                    <td rowspan="2" id="entry" style="vertical-align:bottom; text-align:center"><br>{{$form->first()->updated_at->format('m-d-Y')}}</td>
                </tr>
                <tr>
                    <td id="entry" style="text-align:center"><b><br>{{strtoupper($divhead->first()->first_name)}} {{strtoupper($divhead->first()->last_name)}}</b></td>
                </tr>
                <tr>
                    <td id="entry" style="text-align:center">Employee</td>
                    <td id="entry" style="text-align:center">Date</td>
                    <td id="entry" style="text-align:center">Division Head</td>
                    <td id="entry" style="text-align:center">Date</td>
                    <td id="entry" style="text-align:center">Regional Director</td>
                    <td id="entry" style="text-align:center">Date</td>
                </tr>
            </table>

            <div style="margin-top:-60px">
                <img src="{{asset('images/logos/bottom-part.jpg')}}" alt="pqa Logo" style="height:30px; width:750px; display:block; margin:auto">
            </div>
            <br><br><br><br><br>

        </div>



        <!---->

    </div>

</body>

</html>


@endsection