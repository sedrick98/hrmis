@extends('layouts.app')

@section('content')


<body class="p-5">
    @include('includes/sidebar')

    <div class="container col-12 p-3">
        <h2>Division-Sections</h2>
        <div class="card p-4">
            <table id="divisionsTable" class="display">
                <thead>
                    <tr>
                        <th>Division</th>
                        <th>Name</th>
                        <th>ABBR</th>
                        <th>Office Site</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->division->name }}</td>
                            <td>{{ $section->name }}</td>
                            <td>{{ $section->abbr }}</td>
                            <td>{{ $section->office_site }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container col-12 p-3">
        <h2>Create New Division-Section</h2>
        <div class="card p-4">
        <form action="{{ route('signatory-sections') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Division</label>
                <select class="form-control" name="division">
                    <option>Select a division</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>ABBR</label>
                <input class="form-control" name="abbr">
            </div>
            <div class="form-group">
                <label>Office Site</label>
                <input class="form-control" name="office_site">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>

</body>

<script>
    jQuery(document).ready(function() {
        $('#divisionsTable').DataTable();
    });
</script>

@endsection