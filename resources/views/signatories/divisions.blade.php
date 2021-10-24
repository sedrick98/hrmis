@extends('layouts.app')

@section('content')


<body class="p-5">
    @include('includes/sidebar')

    <div class="container col-12 p-3">
        <h2>Divisions</h2>
        <div class="card p-4">
            <table id="divisionsTable" class="display">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ABBR</th>
                        <th>Active</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($divisions as $division)
                        <tr>
                            <td>{{ $division->name }}</td>
                            <td>{{ $division->abbr }}</td>
                            <td>{{ $division->active == '1' ? 'active' : 'inactive' }}</td>
                            <td><a href="#editField" onClick="updateAction(this)"><span class="badge badge-info">Update</span></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container col-12 p-3">
        <h2 id="editField">Create/Update New Division</h2>
        <div class="card p-4">
        <form action="{{ route('signatory-divisions') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>ABBR</label>
                <input class="form-control" name="abbr">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>

</body>

<script>
    const updateAction = () => {
        
    }

    jQuery(document).ready(function() {
        $('#divisionsTable').DataTable();
    });
</script>

@endsection