@extends('layouts.app')

@section('content')


<body>

    @include('includes/sidebar')

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-10 pb-2">
                <h2>Pending</h2>
            </div>
            @foreach ($for_approvals as $for_approval)
            <div class="col-10 card p-3 shadow-sm">
                <h3>{{ $for_approval->leave_type }} </h3>
                <h4>{{'@'}}{{ \App\Models\User::find($for_approval->user_id)->username }} <span class="badge badge-dark">{{ $for_approval->number_of_days }} days</span></h4>
                <h5>
                    Dates:
                    @foreach ($for_approval->inclusiveDates as $leave_date)
                        <span class="badge badge-light">
                            {{ Carbon\Carbon::parse($leave_date->date)->toFormattedDateString() }}
                        </span>
                    @endforeach
                </h5>
                <br>
                <h3>
                    <a href="{{ route('leave-view', ['leave_request' => $for_approval->id]) }}">
                        <span class="badge badge-info mr-2">View</span>
                    </a>
                </h3>
            </div>
            @endforeach
        </div>

    </div>

</body>

@endsection
