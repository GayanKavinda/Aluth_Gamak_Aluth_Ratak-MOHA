@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

<style>
    .small-font-table {
        font-size: 0.8rem; /* Adjust this value as needed */
    }
    .btn-xs {
        padding: .25rem .5rem;
        font-size: .75rem;
        line-height: 1.5;
        border-radius: .2rem;
    }
    .action-buttons {
        display: flex;
        gap: 0.5rem; /* Adjust the gap between buttons as needed */
    }
    .table thead th {
        font-family: 'Roboto', sans-serif; /* Apply Roboto font to table headings */
    }
    .search-bar .form-control, .search-bar .btn {
        font-size: 1rem; /* Adjust to match table font size */
    }
</style>

<!-- 
    //Developed by G.R Gayan Kavinda Gamlath 
    //gayankavinda98v.lk@gmail.com
    //2024 SLIIT Internship 
    //Ministry of Home Affairs (MOHA) 
-->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Search Bar -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('users.index') }}" method="GET" class="search-bar">
                        <div class="input-group mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search users..." value="{{ request()->query('search') }}">
                            <button class="btn btn-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h4>Users
                        @can('create user')
                        <a href="{{ url('users/create')}}" class="btn btn-primary float-end">Add User</a>
                        @endcan
                    </h4>
                </div>
                <div class="card-body">
                    @can('view user')
                    <table class="table table-bordered table-striped table-sm small-font-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>District</th>
                                <th>Telephone</th>
                                <th>GA Email Address</th>
                                <th>Position</th>
                                <th>Workplace</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->district }}</td>
                                <td>{{ $user->telephone }}</td>
                                <td>{{ $user->ga_email }}</td>
                                <td>{{ $user->position }}</td>
                                <td>{{ $user->workplace }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $rolename)
                                    <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @can('update user')
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-success btn-xs">Edit</a>
                                        @endcan
                                        @can('delete user')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">Previous</a>
                        </li>
                        @for ($i = 1; $i <= $users->lastPage(); $i++)
                            <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">Next</a>
                        </li>
                    </ul>
                </nav>
                    <!-- Debug Pagination Data -->
                    <div>
                        <p>Total Users Count: {{ \App\Models\User::count() }}</p>
                        <p>Current Page: {{ $users->currentPage() }}</p>
                        <p>Last Page: {{ $users->lastPage() }}</p>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
