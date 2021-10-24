<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-size: 11px;
        }

        h1 {
            text-align: center;
        }

        h5 {
            font-size: 14px;
        }

        .row {
            border: 1px solid black;
        }

        .col, .col-6 {
            padding: 10px 20px;
        }

        ul {
            list-style-type: none;
        }

        p {
            font-size: 11px;
        }

        .table td, .table th {
            padding: 2px;
        }

        .header-images {
            max-height: 100px;
        }

        .dates h5 {
            display: inline-block;
        }

    </style>
</head>
<body class="py-5">
    <div class="header-images mx-5">
        <img src="{{asset('images/logos/dost-logo.png')}}" height="60">
        <img src="{{asset('images/logos/iso-logo-accred.png')}}" width="200">
    </div>

    <h1>Application For Leave</h1>
    
    <div class="row mx-5">
        <div class="col">
            <h5>1. OFFICE/DEPARTMENT</h5>
            <p class="data" id=""></p>
        </div>
        <div class="col">
            <h5>2. NAME</h5>
            <p class="data">{{ strtoupper($user->last_name) }}, {{ strtoupper($user->first_name) }} {{ strtoupper($user->middle_name) }}</p>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col">
            <h5>3. DATE OF FILING</h5>
            <p class="data">{{ Carbon\Carbon::parse($leave->created_at)->toFormattedDateString() }}</p>
        </div>
        <div class="col">
            <h5>4. POSITION</h5>
            <p class="data">{{ strtoupper($user->roleName()) }}</p>
        </div>
        <div class="col">
            <h5>5. SALARY</h5>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col">
            <h5 class="text-center"><b> 6. DETAILS OF APPLICATION</b></h5>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col">
            <h5>6.A TYPE OF LEAVE TO BE AVAILED OF</h5>
            <ul>
                <li><input type="checkbox" value="Vacation Leave"> Vacation Leave <small>(Sec. 51, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</small></li>
                <li><input type="checkbox" value="Mandatory/Forced Leave"> Mandatory/Forced Leave <small>(Sec. 25, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</small></li>
                <li><input type="checkbox" value="Sick Leave"> Sick Leave <small>(Sec. 43, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</small></li>
                <li><input type="checkbox" value="Maternity Leave"> Maternity Leave <small>(R.A. No. 11210 / IRR issued by CSC, DOLE and SSS)</small></li>
                <li><input type="checkbox" value="Paternity Leave"> Paternity Leave <small>(R.A. No. 8187 / CSC MC No. 71, s. 1998, as amended)</small></li>
                <li><input type="checkbox" value="Special Privilege Leave"> Special Privilege Leave <small>(Sec. 21, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</small></li>
                <li><input type="checkbox" value="Solo Parent Leave"> Solo Parent Leave <small>(RA No. 8972 / CSC MC No. 8, s. 2004)</small></li>
                <li><input type="checkbox" value="Study Leave"> Study Leave <small>(Sec. 68, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</small></li>
                <li><input type="checkbox" value="10-Day VAWC Leave"> 10-Day VAWC Leave <small>(RA No. 9262 / CSC MC No. 15, s. 2005)</small></li>
                <li><input type="checkbox" value="Rehabilitation Privilege"> Rehabilitation Privilege <small>(Sec. 55, Rule XVI, Omnibus Rules Implementing E.O. No. 292)</small></li>
                <li><input type="checkbox" value="Special Leave Benefits for Women"> Special Leave Benefits for Women <small>(RA No. 9710 / CSC MC No. 25, s. 2010)</small></li>
                <li><input type="checkbox" value="Special Emergency (Calamity) Leave"> Special Emergency (Calamity) Leave <small>(CSC MC No. 2, s. 2012, as amended)</small></li>
                <li><input type="checkbox" value="Adoption Leave"> Adoption Leave <small>(R.A. No. 8552)</small></li>
                <li><input type="checkbox" value="Other"> Other</li>
            </ul>
        </div>
        <div class="col">
            <h5>6.B DETAILS OF LEAVE</h5>
            <p>
                <i>In case of Vacation/Special Privilege Leave:</i><br>
                <input type="checkbox" name="" id="" {{ $leave->vacation_addl_location == 'Within the Philippines' ? 'checked' : ''  }}> Within the Philippines: <br>
                <input type="checkbox" name="" id="" {{ $leave->vacation_addl_location == 'Outside the Country' ? 'checked' : ''  }}> Abroad (Specify): 
                    <span class="data">{{ strtoupper($leave->vacation_addl_specify_country) }}</span>
                <p>Reason: <span class="data">{{ strtoupper($leave->vacation_addl_vacation_reason) }}</span></p>
            </p>

            <p>
                <i>In case of Sick Leave:</i><br>
                <input type="checkbox" name="" id="" {{ $leave->sick_leave_addl_type == 'Hospitalized' ? 'checked' : ''  }}> In Hospital (Specify Illness) <br>
                <input type="checkbox" name="" id="" {{ $leave->sick_leave_addl_type == 'Out-patient' ? 'checked' : ''  }}> Out Patient (Specify Illness) 
                <p>Reason: <span class="data">{{ strtoupper($leave->sick_leave_addl_reason) }}</span></p>
            </p>

            <p>
                <i>In case of Special Leave Benefits for Women:</i><br>
                Specify Illness: <span class="data">{{ strtoupper($leave->special_leave_addl_illness) }}</span>
            </p>

            <p>
                <i>In case of Study Leave:</i><br>
                <input type="checkbox" name="" id="" {{ $leave->study_leave_addl_reason == 'Completion of Master\'s Degree' ? 'checked' : ''  }}> Completion of Master's Degree <br>
                <input type="checkbox" name="" id="" {{ $leave->study_leave_addl_reason == 'BAR/Board Examination Review' ? 'checked' : ''  }}> BAR/Board Examination Review <br>
            </p>

            <p>
                <i>Other purpose:</i><br>
                <input type="checkbox" name="" id="" {{ $leave->study_leave_addl_reason == 'Monetization of Leave Credits' ? 'checked' : ''  }}> Monetization of Leave Credits <br>
                <input type="checkbox" name="" id="" {{ $leave->study_leave_addl_reason == 'Monetization of Leave Credits' ? 'checked' : ''  }}> Terminal Leave
                <p>Other Reason: <span class="data">{{ strtoupper($leave->other_leave_addl_reason) }}</span></p>
            </p>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col">
            <h5>6.C NUMBER OF WORKING DAYS APPLIED FOR</h5>
            <p>Inclusive Dates:</p>
            <div class="dates">
                @foreach ($leave->inclusiveDates as $date)
                        <h5>
                            <span class="badge badge-light">{{ Carbon\Carbon::parse($date->date)->toFormattedDateString() }}</span>
                        </h5>
                @endforeach
            </div>
        </div>
        <div class="col">
            <h5>6.D COMMUTATION</h5>
            <p>
                <input type="checkbox" name="" id="" {{ $leave->commutation == 'Requested' ? 'checked' : ''  }}> Requested <br>
                <input type="checkbox" name="" id="" {{ $leave->commutation == 'Not Requested' ? 'checked' : ''  }}> Not Requested
            </p>
            <p class="text-center">_______________________________________________</p>
            <p class="text-center">Signature of Applicant</p>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col">
            <h5 class="text-center"><b>7. DETAILS OF ACTION ON APPLICATION</b></h5>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col">
            <h5>7.A CERTIFICATION OF LEAVE CREDITS</h5>
            <p >As of ________________________</p>

            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Vacation Leave</th>
                        <th>Sick Leave</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total Earned</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Less this application</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Balance</td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col">
            <h5>7.B RECOMMENDATION</h5>
            <p>
                <input type="checkbox" name="" id="" {{ $leave->status == 'approved' ? 'checked' : ''  }}> For approved <br>
                <input type="checkbox" name="" id="" {{ $leave->status == 'rejected' ? 'checked' : ''  }}> For disapproval due to:
            </p>
        </div>
    </div>
    
    <div class="row mx-5">
        <div class="col-6">
            <h5>7.C APPROVED FOR:</h5>
            <p>_________ Days with pay</p>
            <p>_________ Days without pay</p>
            <p>_________ Others Specify</p>
        </div>
        <div class="col-6">
            <h5>7.D DISAPPROVED DUE TO:</h5>
            
        </div>
        <div class="col-12 text-center mt-2">
            <p>ANTHONY C. SALES, Ph.D, CESO III</p>
            _______________________________________
            <p>Regional Deirector</p>
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    jQuery(document).ready(function() {
        $('input[value="{{ $leave->leave_type }}"]').click();
        window.print();        
    });
</script>
</html>


