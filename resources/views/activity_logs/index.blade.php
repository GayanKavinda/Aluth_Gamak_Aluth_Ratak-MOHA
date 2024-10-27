@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="activity-heading centered-heading">Activity Logs</h1>
    <hr>
    <div class="card" style="border-radius: 15px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped small-font-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Description</th>
                            <th>Subject</th>
                            <th>Causer</th>
                            <th>Properties</th>
                            <th>Created At</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->subject ? $activity->subject->name : 'N/A' }}</td>
                                <td>{{ $activity->causer ? $activity->causer->name : 'System' }}</td>
                                <td>
                                    <div style="max-width: 200px; overflow-x: auto;">
                                        {{ json_encode($activity->properties) }}
                                    </div>
                                </td>
                                <td>{{ $activity->created_at }}</td>
                                <!-- <td><a href="{{ route('activity.logs.show', $activity->id) }}" class="btn btn-primary">View</a></td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <nav class="mt-3" aria-label="...">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $activities->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $activities->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item {{ $activities->nextPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $activities->nextPageUrl() }}">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection

<style>

.activity-heading {
    background: #FFB76B;
    background: linear-gradient(to right, #FFB76B 0%, #FFA73D 30%, #FF7C00 60%, #FF7F04 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.centered-heading {
    text-align: center;
}

.small-font-table {
    font-size: 12px; /* Adjust this value as needed */
}
</style>

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->
