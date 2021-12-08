@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>

    @include('includes/sidebar')

    @if (session('success_registration'))
        <h3 style="margin-left: 30px; color: green;">{{ session('success_registration') }}</h3>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div style="margin-right:24px; width:45%; float:right">

            <div class="card">
                <div class="card-header"><strong>USER NAME AND PASSWORD</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="company">Username</label>
                        <input class="form-control" name="username" id="username" type="text">
                    </div>
                    <div class="form-group">
                        <label for="vat">Password</label>
                        <input class="form-control" name="password" id="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="street">Confirm Password</label>
                        <input class="form-control" name="confirm_password" id="confirm_password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="street">Role</label>
                        <select class="custom-select custom-select-lg mb-3" name="role">
                            <option selected>Select A Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="street">Division</label>
                        <select class="custom-select custom-select-lg mb-3" name="division">
                            <option selected>Select Division</option>
                            @foreach ($div as $divs)
                                <option value="{{ $divs->abbr }}">{{ strtoupper($divs->abbr) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    <button type="reset" class="btn btn-primary mb-2">Reset</button>
                </div>
            </div>

        </div>

        <div style="padding-left:30px; width:50%">

            <div class="card">
                <div class="card-header"><strong>BASIC INFORMATION</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="company">First Name</label>
                        <input class="form-control" name="first_name" id="first_name" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="vat">Middle Name</label>
                        <input class="form-control" name="middle_name" id="middle_name" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="street">Last Name</label>
                        <input class="form-control" name="last_name" id="last_name" type="text" >
                    </div>
                    <div class="form-group">
                        <label for="street">Email</label>
                        <input class="form-control" name="email" id="email" type="text" >
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="width:30%; float:right; margin-top:-80px; margin-right:10%">
            <button class="btn btn-block btn-success" type="submit">
                <h5>SUBMIT</h5>
            </button>
        </div>

        <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0"style="width:30%; float:right; margin-top:-20px; margin-right:10%">
            <button class="btn btn-block btn-danger active" type="reset" aria-pressed="true">
                <h5>RESET</h5>
            </button>
        </div> -->

    </form>


</body>





@endsection