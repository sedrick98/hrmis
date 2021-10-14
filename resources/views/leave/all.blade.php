@extends('layouts.app')

@section('content')


<body>

    @include('includes/sidebar')

    <div class="container pb-5">
        <div class="row justify-content-center">
        <div class="col-10 pb-2">
                <h2>Approved</h2>
            </div>
            <div class="col-10 card p-3 shadow-sm">
                <h3>Vacation Leave <span style="color:green">(3 days)</span></h3>
                <p>September 3, 2020 - September 4, 2020</p>
                <h4>
                    <a href="#"><span class="badge badge-light mr-2">View</span></a>
                    <span class="badge badge-success">Approved</span>
                </h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-10 pb-2">
                <h2>Pending</h2>
            </div>
            @foreach ($pending_leave as $leave)
            <div class="col-10 card p-3 shadow-sm">
                <h3>{{ $leave->leave_type }} <span style="color:green">({{ $leave->number_of_days }} day/s)</span></h3>
                <p>{{ Carbon\Carbon::parse($leave->start_date)->toFormattedDateString() }} - {{ Carbon\Carbon::parse($leave->end_date)->toFormattedDateString() }}</p>
                <h4>
                    <a href="#"><span class="badge badge-light mr-2">View</span></a>
                    <span class="badge badge-warning">Pending</span>
                </h4>
            </div>
            @endforeach
        </div>

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

@endsection
