@extends('layouts.app')

@section('content')


<body class="p-5">
    @include('includes/sidebar')

    <div class="container col-12 p-3">
        <h2>Users</h2>
        <div class="card p-4">
            <table id="divisionsTable" class="display">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Division</th>
                        <th>Section</th>
                        <th>Office Site</th>
                        <th>Assign</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ strtoupper($user->last_name) }}, {{ strtoupper($user->first_name) }}</td>
                            <td>{{ $user->signatory->divisionSection->division->name ?? '' }}</td>
                            <td>{{ $user->signatory->divisionSection->name ?? '' }}</td>
                            <td>{{ $user->signatory->divisionSection->office_site ?? '' }}</td>
                            <td>
                                <a href="#selectedName" onclick="assign(this)" data-user-id="{{  $user->id }}"
                                            data-name="{{ strtoupper($user->last_name) }}, {{ strtoupper($user->first_name) }}"
                                            data-division-id="{{ $user->signatory->divisionSection->division->id ?? '' }}"
                                            data-section-id="{{ $user->signatory->divisionSection->id ?? '' }}">
                                    <span class="badge badge-info">Assign</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container col-12 p-3">
        <h2>Assignment</h2>
        <div class="card p-4">
            <form action="{{ route('signatory-assignments') }}" method="post">
                @csrf
                <h3 id="selectedName"></h3>
                <div class="form-group">
                    <label>Division</label>
                    <select class="form-control" name="division" id="selectDivisions">
                        <option>Select a division</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Section</label>
                    <select class="form-control" name="section" id="selectSections">
                        <option>Select a section</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" data-division="{{ $section->division->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="user_id" id="selectedUserId">
                <button type="submit" class="btn btn-primary">Assign</button>
            </form>
        </div>
    </div>

</body>

<script>
    const assign = (user) => {
        $('#selectedName').html(user.dataset.name);
        $('#selectedUserId').val(user.dataset.userId);
        // console.log(user.dataset.divisionId);
        $('#selectDivisions').val(user.dataset.divisionId);
        $('#selectSections').val(user.dataset.sectionId);
    }

    jQuery(document).ready(function() {
        $('#divisionsTable').DataTable();

        $("#selectDivisions").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#selectSections option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[data-division=' + id + ']');
            $('#selectSections').html(options);
        });
    });
</script>

@endsection