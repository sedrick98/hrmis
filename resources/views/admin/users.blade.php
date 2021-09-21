@extends('layouts.app')
@section('after-styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.2/Chart.min.js"></script>
@endsection

@section('content')


<body>

    @include('includes/sidebar')

    <div style="margin-right:24px; width:45%; float:right">

        <div class="card">
            <div class="card-header"><strong>USER NAME AND PASSWORD</strong></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="company">Username</label>
                    <input class="form-control" id="firstname" type="text" placeholder="first name">
                </div>
                <div class="form-group">
                    <label for="vat">Password</label>
                    <input class="form-control" id="middlename" type="text" placeholder="middle name">
                </div>
                <div class="form-group">
                    <label for="street">Confirm Password</label>
                    <input class="form-control" id="lastname" type="text" placeholder="last name">
                </div>
            </div>
        </div>

    </div>




    <div style="padding-left:30px; width:50%">

        <div class="card">
            <div class="card-header"><strong>ADD USER</strong></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="company">First Name</label>
                    <input class="form-control" id="firstname" type="text" placeholder="first name">
                </div>
                <div class="form-group">
                    <label for="vat">Middle Name</label>
                    <input class="form-control" id="middlename" type="text" placeholder="middle name">
                </div>
                <div class="form-group">
                    <label for="street">Last Name</label>
                    <input class="form-control" id="lastname" type="text" placeholder="last name">
                </div>
                <div class="form-group">
                    <label for="street">Email</label>
                    <input class="form-control" id="email" type="text" placeholder="Email">
                </div>
            </div>
        </div>

    </div>


    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0" style="width:30%; float:right; margin-top:-80px; margin-right:10%">
        <button class="btn btn-block btn-success" type="button">
            <h5>SUBMIT</h5>
        </button>
    </div>

    <div class="col-6 col-sm-4 col-md-2 col-xl mb-3 mb-xl-0"style="width:30%; float:right; margin-top:-20px; margin-right:10%">
        <button class="btn btn-block btn-danger active" type="button" aria-pressed="true">
            <h5>RESET</h5>
        </button>
    </div>



</body>





@endsection