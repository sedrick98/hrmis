@extends('layouts.app')

@section('content')


<body>

    @include('includes/sidebar')

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-8 pb-2">
                <h2>
                    Leave Request 
                    @switch($leave_request->status)
                        @case('approved')
                            <span class="badge badge-success text-white ml-2">Approved</span>
                            @break
                        @case('pending')
                            <span class="badge badge-warning text-white ml-2">Pending</span>
                            @break
                        @case('rejected')
                            <span class="badge badge-danger text-white ml-2">Rejected</span>
                            @break
                    @endswitch

                    <a href="{{ route('leave-print', ['leave_request' => $leave_request]) }}" target="_blank">
                        <span class="badge badge-warning mr-2">Print</span>
                    </a>
                </h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 card p-3 shadow-sm">
                <h3>Type of Leave:</h3>
                <br>
                <h3><span style="color: var(--dark)">{{ $leave_request->leave_type }}</span> </h3>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 card p-3 shadow-sm">
                <h3>Dates</h3>
                <br>
                <div class="dates">
                    <h3>
                        @foreach ($leave_request->inclusiveDates as $leave_date)
                            <span class="badge badge-light">
                                {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                            </span>
                        @endforeach
                    </h3>
                </div>
                <br>
                <h3>Commutation</h3>
                <p>{{ $leave_request->commutation }}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 card p-3 shadow-sm">
                @switch($leave_request->leave_type)
                    @case('Vacation Leave')
                    <h3>Vacation Leave Details</h3>
                    <br>
                        <h4>Location</h4>
                        <p>{{ $leave_request->vacation_addl_location }}</p>
                        <h4>Country</h4>
                        <p>{{ $leave_request->vacation_addl_specify_country }}</p>
                        <h4>Reason</h4>
                        <p>{{ $leave_request->vacation_addl_vacation_reason }}</p>
                        @break
                    @case('Sick Leave')
                    <h3>Sick Leave Details</h3>
                    <br>
                        <h4>Type</h4>
                        <p>{{ $leave_request->sick_leave_addl_type }}</p>
                        <h4>Reason</h4>
                        <p>{{ $leave_request->sick_leave_addl_reason }}</p>
                        @break
                    @case('Special Leave Benefits for Women')
                    <h3>Special Leave Benefits for Women Details</h3>
                    <br>
                        <h4>Illness</h4>
                        <p>{{ $leave_request->special_leave_addl_illness }}</p>
                        @break
                    @case('Study Leave')
                    <h3>Study Leave Details</h3>
                    <br>
                        <h4>Reason</h4>
                        <p>{{ $leave_request->study_leave_addl_reason }}</p>
                        @break
                    @case('Other')
                    <h3>Leave Details</h3>
                    <br>
                        @if ($leave_request->other_leave_addl_reason_type != '')
                            <h4>Type of Leave</h4>
                            <p>{{ $leave_request->other_leave_addl_reason_type }}</p>
                        @endif
                        <h4>Reason</h4>
                        <p>{{ $leave_request->other_leave_addl_reason }}</p>
                        @break
                    @default
                        <h3>Leave Details</h3>
                        {{ 'No further Details' }}
                @endswitch

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-8 pb-2">
                <h2>Status</h2>
            </div>
            
            @foreach ($leave_request->approvals as $approval)
            <div class="col-8 card p-3 leave-status {{strtolower($leave_request->current_action_role)}}
                        {{ strtolower($approval->designated_role) == strtolower($leave_request->current_action_role) 
                            ? 'shadow-sm' 
                            : 'shadow-none de-elevate-card' }}">
                <h4>
                    @if (strtolower($approval->designated_role) == strtolower($leave_request->current_action_role))
                        <i class="bi bi-pause-circle-fill status-pending-icon"></i>
                    @endif
                    @if ($approval->status == 'approved')
                        <i class="bi bi-check-circle-fill status-success-icon"></i>
                    @endif
                    {{ $approval->approval_type }}
                </h4>

                @if ($approval->status == 'approved')
                    <h5>Approved by: {{ $approval->approver }}</h5>
                    <h5>Reason: {{ $approval->reason }}</h5>
                    <h5>Date Approved: {{ $approval->action_date }}</h5>
                @endif

                @if (strtolower($approval->designated_role) == strtolower($leave_request->current_action_role)
                && strtolower(Auth::user()->roleName()) ==  strtolower($leave_request->current_action_role))
                <br>
                <h5>Approve </h5>
                <form action="{{ route('leave-approval-update', [$approval]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reason</label>
                        <input class="form-control" name="reason" aria-describedby="emailHelp" placeholder="Approval Reason">
                    </div>
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <hr>
                <h5>Reject</h5>
                <form action="{{ route('leave-reject-approval', [$approval]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Reason</label>
                        <input class="form-control" name="reason" aria-describedby="emailHelp" placeholder="State the reason of action either approve/accepted">
                    </div>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
                @endif
            </div>
            @endforeach

            <!-- <div class="col-8 card p-3 shadow-sm leave-status">
                <h4><i class="bi bi-pause-circle-fill status-pending-icon"></i> ARD - FASD (Certification)</h4>
            </div>
            <div class="col-8 card p-3 shadow-sm leave-status">
                <h4><i class="bi bi-pause-circle-fill status-pending-icon"></i> ARD - Division Head (Verification)</h4>
            </div>
            <div class="col-8 card p-3 shadow-sm leave-status">
                <h4><i class="bi bi-pause-circle-fill status-pending-icon"></i> RD (Approval)</h4>
            </div> -->
        </div>
    </div>

</body>

@endsection
