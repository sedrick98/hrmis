@extends('layouts.app')

@section('content')


<body>

    @include('includes/sidebar')

    <div class="container pb-5">
        <form action="{{ route('leave-create') }}" method="post">
        <div class="row justify-content-center">
            @csrf
            <div class="col-10">
                <div class="card p-3 shadow-sm">
                    <h3>Your Info</h3>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Position</label>
                        <input class="form-control" name="position">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Salary</label>
                        <input class="form-control" name="salary">
                    </div>
                </div>
            </div>

            <div class="col-10">
                <div class="card p-3 shadow-sm">
                    <h3>Type of leave to be availed of</h3>
                    <br>
                    <div class="form-group">
                        <select class="form-control" id="vacationTypeOptions" name="leave_type">
                            <option selected>Select Type</option>
                            <option value="Vacation Leave" data-toggle="vacationLeaveDetails">Vacation Leave</option>
                            <option value="Mandatory/Forced Leave">Mandatory/Forced Leave</option>
                            <option value="Sick Leave" data-toggle="sickLeaveDetails">Sick Leave</option>
                            <option value="Maternity Leave">Maternity Leave</option>
                            <option value="Paternity Leave">Paternity Leave</option>
                            <option value="Special Privilege Leave">Special Privilege Leave</option>
                            <option value="Solo Parent Leave">Solo Parent Leave</option>
                            <option value="Study Leave" data-toggle="studyLeaveDetails">Study Leave</option>
                            <option value="10-Day VAWC Leave">10-Day VAWC Leave</option>
                            <option value="Rehabilitation Privilege">Rehabilitation Privilege</option>
                            <option value="Special Leave Benefits for Women" data-toggle="specialLeaveDetails">Special Leave Benefits for Women</option>
                            <option value="Special Emergency (Calamity) Leave">Special Emergency (Calamity) Leave</option>
                            <option value="Adoption Leave">Adoption Leave</option>
                            <option value="Other" data-toggle="otherLeaveDetails">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-10">
                <div class="card p-3 shadow-sm">
                    <h3>Details of Leave</h3>
                    <br>
                    <div id="vacationLeaveDetails" class="addLeaveDetails">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Vacation Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vacation_addl_location" id="exampleRadios1" value="Within the Philippines">
                                <label class="form-check-label" for="">
                                    Within the Philippines
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="vacation_addl_location" id="isOutsideCountry" value="Outside the Country">
                                <label class="form-check-label" for="">
                                    Outside the Country
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="countrySpecification">
                            <label for="exampleFormControlInput1">Specify Country (if outside Philippines)</label>
                            <input class="form-control" id="exampleFormControlInput1" placeholder="Japan" name="vacation_addl_specify_country">
                        </div>
    
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Specify Vacation Reason</label>
                            <input class="form-control" id="exampleFormControlInput1" placeholder="Family Trip" name="vacation_addl_vacation_reason">
                        </div>
                    </div>

                    <div id="specialLeaveDetails" class="addLeaveDetails">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Specify Illness<br><small>(Special Leave Benefits For Women)</small></label>
                            <input class="form-control" id="exampleFormControlInput1" name="special_leave_addl_illness">
                        </div>
                    </div>
                    
                    <div id="sickLeaveDetails" class="addLeaveDetails">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Specify Sick Leave Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sick_leave_addl_type" id="exampleRadios1" value="Hospitalized">
                                <label class="form-check-label" for="">
                                    Hospitalized
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sick_leave_addl_type" id="exampleRadios2" value="Out-patient">
                                <label class="form-check-label" for="">
                                    Out-patient
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"> Reason</label>
                            <input class="form-control" id="exampleFormControlInput1" placeholder="Abdominal Cramps" name="sick_leave_addl_reason">
                        </div>
                    </div>

                    <div id="studyLeaveDetails" class="addLeaveDetails">
                        <div class="form-group" id="countrySpecification">
                            <label for="exampleFormControlInput1">Specify Reason for Study Leave</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="study_leave_addl_reason" id="exampleRadios1" value="Completion of Master's Degree">
                                <label class="form-check-label" for="">
                                    Completion of Master's Degree
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="study_leave_addl_reason" id="exampleRadios2" value="BAR/Board Examination Review">
                                <label class="form-check-label" for="">
                                    BAR/Board Examination Review
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="otherLeaveDetails" class="addLeaveDetails">
                        <div class="form-group" id="countrySpecification">
                            <div class="form-group" id="countrySpecification">
                                <label for="exampleFormControlInput1">Specify (Other) Reason:</label>
                                <input class="form-control" id="exampleFormControlInput1" name="other_leave_addl_reason">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="other_leave_addl_reason_type" id="exampleRadios1" value="Monetization of Leave Credits">
                                <label class="form-check-label" for="">
                                    Monetization of Leave Credits
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="other_leave_addl_reason_type" id="exampleRadios2" value="Terminal Leave">
                                <label class="form-check-label" for="">
                                    Terminal Leave
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-10">
                <div class="card p-3 shadow-sm">
                    <h3>Number of working days applied for</h3>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Dates</label>
                        <input class="form-control" name="dates" id="dateRangePicker">
                        <br>
                        <div class="form-group" id="countrySpecification">
                            <label for="exampleFormControlInput1">Number of Working Days:</label>
                            <input class="form-control" id="exampleFormControlInput1" name="number_of_days">
                        </div>

                        <input type="hidden" id="start_date" name="start_date">
                        <input type="hidden" id="end_date" name="end_date">
                    </div>
                </div>
            </div>
                
            <div class="col-10">
                <div class="card p-3 shadow-sm">
                    <h3>Commutation</h3>
                    <label for="exampleFormControlInput1">Commutation</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="commutation" value="Requested">
                        <label class="form-check-label">
                            Requested
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="commutation" value="Not Requested">
                        <label class="form-check-label">
                            Not Requested
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-10">
                <div class="card p-3 shadow-sm">
                    <input type="submit" class="btn btn-primary"></input>
                </div>
            </div>

        </div>
    </form>
    </div>


</body>

@endsection

@section('before-scripts')
<script>
    $('input[name="dates"]').daterangepicker({
        "locale": {
            "format": "YYYY-MM-DD",
        }
    });

    $('input[name="dates"]').change(function() {
        let dates = $(this).val();
        [startDate, endDate] = dates.split(' - ');
        $('#start_date').val(startDate);
        $('#end_date').val(endDate);
        console.log(startDate, endDate);
    });
</script>
@endsection('before-scripts')

@section('after-scripts')
<script>
    const hideAddtlFields = () => {
        $('#vacationAddtlFields, #sickAddtlFields').hide();
    }

    $(document).ready(() => {
        $('.addLeaveDetails').hide();

        $('#vacationTypeOptions').change(function() {
            let toggleID = $(this).find(':selected').data('toggle');
            $('.addLeaveDetails').hide();
            if (toggleID) {
                $(`#${toggleID}`).show();
            }
        });

        // hideAddtlFields();
        // $('#countrySpecification').hide();

        // $('#vacationTypeOptions').change(function() {
        //     let selected = $(this).val();

        //     if (selected === 'Vacation') {
        //         hideAddtlFields();
        //         $('#vacationAddtlFields').show();
        //     } else if (selected === 'Sick') {
        //         hideAddtlFields();
        //         $('#sickAddtlFields').show();
        //     } else {
        //         hideAddtlFields();
        //     }
        // });

        // $('input[name="is_local"]').change(function() {
        //     console.log($(this).val());
        //     if ($(this).val() == 0) {
        //         $('#countrySpecification').show();
        //     } else {
        //         $('#countrySpecification').hide();
        //     }
        // });
    });
</script>
@endsection('after-scripts')