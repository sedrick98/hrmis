@extends('layouts.app')

@section('content')


<body>

    @include('includes/sidebar')
    <div class="container col-12 p-3">
        <div class="tables-container card p-4">
            <h2>Approved Leaves</h2>
            <table id="approvedTable" class="display">
                <thead>
                    <tr>
                        <th>Leave Type</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Print</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($approved_leave as $leave)
                    <tr>
                        <td>{{ $leave->leave_type }}</td>
                        <td>
                            @foreach ($leave->inclusiveDates as $leave_date)
                                <span class="badge badge-light">
                                    {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                                </span>
                            @endforeach
                        </td>
                        <td><span class="badge badge-success">Approved</span></td>
                        <td>
                            <a href="{{ route('leave-view', ['leave_request' => $leave->id]) }}">
                                <span class="badge badge-info mr-2">View</span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('leave-print', ['leave_request' => $leave]) }}" target="_blank">
                                <span class="badge badge-light mr-2">Print</span>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container col-12 p-3">
        <div class="tables-container card p-4">
            <h2>Pending Leaves</h2>
            <table id="pendingTable" class="display">
                <thead>
                    <tr>
                        <th>Leave Type</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Print</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pending_leave as $leave)
                        <tr>
                            <td>{{ $leave->leave_type }}</td>
                            <td>
                                @foreach ($leave->inclusiveDates as $leave_date)
                                    <span class="badge badge-light">
                                        {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                                    </span>
                                @endforeach
                            </td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <a href="{{ route('leave-view', ['leave_request' => $leave->id]) }}">
                                    <span class="badge badge-info mr-2">View</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('leave-print', ['leave_request' => $leave]) }}" target="_blank">
                                    <span class="badge badge-light mr-2">Print</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container col-12 p-3">
        <div class="tables-container card p-4">
            <h2>Rejected Leaves</h2>
            <table id="pendingTable" class="display">
                <thead>
                    <tr>
                        <th>Leave Type</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Print</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rejected_leave as $leave)
                        <tr>
                            <td>{{ $leave->leave_type }}</td>
                            <td>
                                @foreach ($leave->inclusiveDates as $leave_date)
                                    <span class="badge badge-light">
                                        {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                                    </span>
                                @endforeach
                            </td>
                            <td><span class="badge badge-danger">Rejected</span></td>
                            <td>
                                <a href="{{ route('leave-view', ['leave_request' => $leave->id]) }}">
                                    <span class="badge badge-info mr-2">View</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('leave-print', ['leave_request' => $leave]) }}" target="_blank">
                                    <span class="badge badge-light mr-2">Print</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container pb-5">
        <!-- <div class="row justify-content-center">
            <div class="col-10 pb-2">
                <h2>Approved</h2>
            </div>
            @foreach ($approved_leave as $leave)
            <div class="col-10 card p-3 shadow-sm">
                <h3>{{ $leave->leave_type }}</h3>
                <h5>
                <span class="badge badge-dark">{{ $leave->number_of_days }} days</span>
                    @foreach ($leave->inclusiveDates as $leave_date)
                        <span class="badge badge-light">
                            {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                        </span>
                    @endforeach
                </h5>
                <br>
                <h3>
                    <a href="{{ route('leave-view', ['leave_request' => $leave->id]) }}">
                        <span class="badge badge-info mr-2">View</span>
                    </a>
                    <a href="{{ route('leave-print', ['leave_request' => $leave]) }}">
                        <span class="badge badge-light mr-2">Print</span>
                    </a>
                    <span class="badge badge-success">Approved</span>
                </h3>
            </div>
            @endforeach
        </div> -->

        <!-- <div class="row justify-content-center">
            <div class="col-10 pb-2">
                @if(count($pending_leave) > 0) 
                <h2>Pending</h2> 
                @endif
            </div>
            @foreach ($pending_leave as $leave)
            <div class="col-10 card p-3 shadow-sm">
                <h3>{{ $leave->leave_type }} </h3>
                <h5>
                <span class="badge badge-dark">{{ $leave->number_of_days }} days</span>
                    @foreach ($leave->inclusiveDates as $leave_date)
                        <span class="badge badge-light">
                            {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                        </span>
                    @endforeach
                </h5>
                <br>
                <h3>
                    <a href="{{ route('leave-view', ['leave_request' => $leave->id]) }}">
                        <span class="badge badge-info mr-2">View</span>
                    </a>
                    <a href="{{ route('leave-print', ['leave_request' => $leave]) }}" target="_blank">
                        <span class="badge badge-light mr-2">Print</span>
                    </a>
                    <span class="badge badge-warning">Pending</span>
                </h3>
            </div>
            @endforeach
        </div> -->

        <!-- <div class="row justify-content-center">
            <div class="col-10 pb-2">
                <h2>Rejected</h2>
            </div>
            @foreach ($rejected_leave as $leave)
            <div class="col-10 card p-3 shadow-none">
                <h3>{{ $leave->leave_type }}</h3>
                <h5>
                <span class="badge badge-dark">{{ $leave->number_of_days }} days</span>
                    @foreach ($leave->inclusiveDates as $leave_date)
                        <span class="badge badge-light">
                            {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                        </span>
                    @endforeach
                </h5>
                <br>
                <h5>Rejected by: {{ $leave->rejectionDetails()->first()->approval_type }}</h5>
                <h5>Reason: {{ $leave->rejectionDetails()->first()->reason }}</h5>
                <h3>
                    <span class="badge badge-danger">Rejected</span>
                </h3>
            </div>
            @endforeach
        </div> -->

        <!-- <div class="row justify-content-center">
            <div class="col-10 pb-2">
                <h2>Done</h2>
            </div>
            <ul class="col-10 list-group m-0 bg-white">
                <li class="list-group-item">Cras justo odio</li>
            </ul>
        </div> -->
    </div>

</body>

<script>
    jQuery(document).ready(function() {
        $('#approvedTable, #pendingTable').DataTable();
    });
</script>

@endsection
